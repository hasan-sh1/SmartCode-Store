@extends('admin.layout')

@section('content')
<h1 class="text-lg font-semibold mb-4">تعديل التصنيف</h1>
<form action="{{ route('admin.categories.update', $category) }}" method="POST" class="bg-white rounded shadow p-6 space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm text-slate-600 mb-1">اسم التصنيف</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm text-slate-600 mb-1">الوصف</label>
        <textarea name="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description', $category->description) }}</textarea>
    </div>
    <div>
        <label class="flex items-center space-x-2 space-x-reverse">
            <input type="checkbox" name="is_active" value="1" class="mr-2" {{ $category->is_active ? 'checked' : '' }}>
            <span>نشط</span>
        </label>
    </div>
    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-slate-200 rounded">إلغاء</a>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded">حفظ</button>
    </div>
</form>
@endsection