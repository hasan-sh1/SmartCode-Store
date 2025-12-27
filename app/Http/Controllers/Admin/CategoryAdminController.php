<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryAdminController extends Controller
{
    public function index()
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }
        $categories = Category::latest()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        Category::create($data);
        return redirect()->route('admin.categories.index')->with('status', 'تم إضافة التصنيف');
    }

    public function edit(Category $category)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        $category->update($data);
        return redirect()->route('admin.categories.index')->with('status', 'تم تعديل التصنيف');
    }

    public function destroy(Category $category)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('status', 'تم حذف التصنيف');
    }
}