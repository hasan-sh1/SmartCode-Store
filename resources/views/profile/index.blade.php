@extends('layouts.app')

@section('content')
<section class="py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">الملف الشخصي</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded shadow p-6">
                <div class="flex flex-col items-center">
                    <img src="{{ $user->avatar_url }}" class="w-24 h-24 rounded-full object-cover mb-3" alt="Avatar">
                    <div class="text-lg font-semibold">{{ $user->name }}</div>
                    <div class="text-sm text-gray-600">{{ $user->email }}</div>
                    <div class="mt-2 text-sm text-gray-700">{{ $user->bio ?? 'لا توجد معلومات' }}</div>
                </div>
                <div class="mt-4 p-3 bg-indigo-50 rounded">
                    <div class="text-sm">عدد المنتجات التي تم شراؤها: <span class="font-bold">{{ $purchasedCount }}</span></div>
                </div>
            </div>

            <div class="md:col-span-2 bg-white rounded shadow p-6">
                <h2 class="text-lg font-semibold mb-3">تعديل المعلومات</h2>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm text-slate-600 mb-1">الاسم</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-sm text-slate-600 mb-1">الصورة الشخصية</label>
                        <input type="file" name="avatar" accept="image/*" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm text-slate-600 mb-1">نبذة</label>
                        <textarea name="bio" class="w-full border rounded px-3 py-2" rows="4">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection