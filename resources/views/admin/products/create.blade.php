@extends('admin.layout')

@section('content')
<h1 class="text-lg font-semibold mb-4">إضافة منتج جديد</h1>
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded shadow p-6 space-y-4">
    @csrf
    <div>
        <label class="block text-sm text-slate-600 mb-1">اسم المنتج</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm text-slate-600 mb-1">الوصف</label>
        <textarea name="description" class="w-full border rounded px-3 py-2" rows="4"></textarea>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm text-slate-600 mb-1">السعر</label>
            <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-sm text-slate-600 mb-1">المخزون</label>
            <input type="number" name="stock" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="flex items-center mt-6">
            <label class="flex items-center space-x-2 space-x-reverse">
                <input type="checkbox" name="is_active" value="1" class="mr-2">
                <span>نشط</span>
            </label>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-slate-600 mb-1">التصنيف</label>
            <select name="category_id" class="w-full border rounded px-3 py-2">
                <option value="">بدون</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm text-slate-600 mb-1">التصنيف الفرعي</label>
            <select name="subcategory_id" class="w-full border rounded px-3 py-2">
                <option value="">بدون</option>
                @foreach($subcategories as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label class="block text-sm text-slate-600 mb-1">صورة المنتج</label>
        <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-slate-200 rounded">إلغاء</a>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded">حفظ</button>
    </div>
</form>
@endsection