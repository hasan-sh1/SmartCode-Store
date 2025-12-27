<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->get();
        $query = Product::query()->where('is_active', true);

        if ($request->filled('category')) {
            $cat = Category::where('slug', $request->string('category'))->first();
            if ($cat) {
                $query->where('category_id', $cat->id);
            }
        }

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

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
        return view('products.index', [
            'categories' => $categories,
            'products' => $products,
            'selectedSort' => $sort,
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['category','subcategory']);
        $rating = null; // يمكن لاحقًا ربطه بجدول تقييمات
        return view('products.show', compact('product', 'rating'));
    }
}