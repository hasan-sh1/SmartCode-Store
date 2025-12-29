<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\{Product, Category, Subcategory, Service};

Route::get('/products', function () {
    return Product::query()->where('is_active', true)->latest()->paginate(12);
});

Route::get('/products/{product}', function (Product $product) {
    return $product;
});

Route::get('/categories', function () {
    return Category::query()->where('is_active', true)->withCount(['products','subcategories'])->get();
});

Route::get('/categories/{category}', function (Category $category) {
    return $category->load(['subcategories','products']);
});

Route::get('/subcategories', function () {
    return Subcategory::query()->with('category')->get();
});

Route::get('/services', function () {
    return Service::query()->where('is_active', true)->latest()->paginate(12);
});