<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->get();

        $query = Product::query()->where('is_active', true);

        // فلترة بالفئة عبر slug
        if ($request->filled('category')) {
            $cat = Category::where('slug', $request->string('category'))->first();
            if ($cat) {
                $query->where('category_id', $cat->id);
            }
        }

        // بحث بالاسم/الوصف
        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // فرز
        $sort = $request->string('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        return view('store.index', [
            'categories' => $categories,
            'products' => $products,
            'selectedSort' => $sort,
        ]);
    }
}
