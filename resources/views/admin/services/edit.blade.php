@extends('admin.layout')

@section('content')
<h1 class="text-lg font-semibold mb-4">تعديل عنصر سورس/خدمة</h1>
<form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded shadow p-6 space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm text-slate-600 mb-1">العنوان</label>
        <input type="text" name="title" value="{{ old('title', $service->title) }}" class="w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm text-slate-600 mb-1">الوصف</label>
        <textarea name="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description', $service->description) }}</textarea>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm text-slate-600 mb-1">السعر (اختياري)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $service->price) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm text-slate-600 mb-1">رابط الكود (اختياري)</label>
            <input type="url" name="code_url" value="{{ old('code_url', $service->code_url) }}" class="w-full border rounded px-3 py-2" placeholder="https://...">
        </div>
        <div class="flex items-center mt-6">
            <label class="flex items-center space-x-2 space-x-reverse">
                <input type="checkbox" name="is_active" value="1" class="mr-2" {{ $service->is_active ? 'checked' : '' }}>
                <span>نشط</span>
            </label>
        </div>
    </div>
    <div>
        <label class="block text-sm text-slate-600 mb-1">ملف مرفق جديد (اختياري)</label>
        <input type="file" name="attachment" class="w-full border rounded px-3 py-2">
        @if($service->attachment_path)
            <div class="mt-2">
                <a href="{{ asset('storage/'.$service->attachment_path) }}" class="text-indigo-600 underline">الملف الحالي</a>
            </div>
        @endif
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.services.index') }}" class="px-4 py-2 bg-slate-200 rounded">إلغاء</a>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded">حفظ</button>
    </div>
</form>
@endsection