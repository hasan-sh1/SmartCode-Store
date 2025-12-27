<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceAdminController extends Controller
{
    public function index()
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }
        $services = Service::latest()->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'code_url' => 'nullable|url',
            'is_active' => 'boolean',
            'attachment' => 'nullable|file|max:4096',
        ]);
        $data['slug'] = Str::slug($data['title']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('services', 'public');
            $data['attachment_path'] = $path;
        }

        Service::create($data);
        return redirect()->route('admin.services.index')->with('status', 'تم إضافة السورس/الخدمة');
    }

    public function edit(Service $service)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'code_url' => 'nullable|url',
            'is_active' => 'boolean',
            'attachment' => 'nullable|file|max:4096',
        ]);
        $data['slug'] = Str::slug($data['title']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('attachment')) {
            if ($service->attachment_path) {
                Storage::disk('public')->delete($service->attachment_path);
            }
            $path = $request->file('attachment')->store('services', 'public');
            $data['attachment_path'] = $path;
        }

        $service->update($data);
        return redirect()->route('admin.services.index')->with('status', 'تم تعديل السورس/الخدمة');
    }

    public function destroy(Service $service)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }
        if ($service->attachment_path) {
            Storage::disk('public')->delete($service->attachment_path);
        }
        $service->delete();
        return redirect()->route('admin.services.index')->with('status', 'تم حذف السورس/الخدمة');
    }
}