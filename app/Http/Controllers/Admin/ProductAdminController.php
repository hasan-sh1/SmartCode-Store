<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductAdminController extends Controller
{
    public function index()
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        $products = Product::with(['category','subcategory'])->latest()->paginate(12);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        $categories = Category::orderBy('name')->get();
        $subcategories = Subcategory::orderBy('name')->get();
        return view('admin.products.create', compact('categories','subcategories'));
    }

    public function store(Request $request)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['sku'] = strtoupper(Str::random(8));
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = $path;
        }

        $product = Product::create($data);

        return redirect()->route('admin.products.index')->with('status', 'تم إضافة المنتج بنجاح');
    }

    public function edit(Product $product)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        $categories = Category::orderBy('name')->get();
        $subcategories = Subcategory::orderBy('name')->get();
        return view('admin.products.edit', compact('product','categories','subcategories'));
    }

    public function update(Request $request, Product $product)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = $path;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('status', 'تم تعديل المنتج بنجاح');
    }

    public function destroy(Product $product)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('status', 'تم حذف المنتج');
    }

    public function destroyAll(Request $request)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        $request->validate([ 'confirm' => 'required|in:yes' ]);

        Product::query()->chunkById(100, function ($products) {
            foreach ($products as $product) {
                if ($product->image_path) {
                    Storage::disk('public')->delete($product->image_path);
                }
                $product->delete();
            }
        });

        return redirect()->route('admin.products.index')->with('status', 'تم حذف جميع المنتجات');
    }
}