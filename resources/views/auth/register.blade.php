@extends('layouts.app')

@section('title', 'إنشاء حساب')

@section('content')
<x-alert />
<div class="max-w-md mx-auto bg-white shadow rounded p-6">
    <h1 class="text-xl font-semibold mb-4">إنشاء حساب</h1>
    <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1">الاسم</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block mb-1">البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block mb-1">كلمة المرور</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block mb-1">تأكيد كلمة المرور</label>
            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded">إنشاء</button>
        <a href="{{ route('login') }}" class="inline-block ml-2 text-blue-600">لديك حساب؟ تسجيل الدخول</a>
    </form>
</div>
@endsection