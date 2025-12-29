@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
<x-alert />
<div class="max-w-md mx-auto bg-white shadow rounded p-6">
    <h1 class="text-xl font-semibold mb-4">تسجيل الدخول</h1>
    <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1">البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block mb-1">كلمة المرور</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="remember" id="remember" class="border rounded">
            <label for="remember">تذكرني</label>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">دخول</button>
        <a href="{{ route('register') }}" class="inline-block ml-2 text-blue-600">إنشاء حساب</a>
    </form>
    <div class="mt-6 border-t pt-4">
        <a href="{{ route('auth.provider.redirect', ['provider' => 'google']) }}" class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-5 h-5"><path fill="#EA4335" d="M24 9.5c3.15 0 5.98 1.08 8.2 2.87l6.15-6.15C34.86 2.49 29.69.5 24 .5 14.8.5 6.68 5.88 2.96 13.5l7.25 5.63C12.02 14.08 17.64 9.5 24 9.5z"/><path fill="#4285F4" d="M46.5 24.5c0-1.57-.14-3.08-.4-4.53H24v9.06h12.7c-.55 2.96-2.2 5.46-4.68 7.14l7.17 5.56C43.38 38.35 46.5 31.87 46.5 24.5z"/><path fill="#FBBC05" d="M10.21 28.29c-.48-1.45-.75-2.99-.75-4.59s.27-3.14.75-4.59L2.96 13.5C1.54 16.31.75 19.55.75 23.7c0 4.16.78 7.39 2.21 10.2l7.25-5.61z"/><path fill="#34A853" d="M24 46.9c6.42 0 11.81-2.16 15.74-5.86l-7.17-5.56c-2 1.38-4.56 2.19-7.57 2.19-6.36 0-12-4.58-14.06-10.83l-7.25 5.61C9.07 42.12 16.59 46.9 24 46.9z"/><path fill="none" d="M0 0h48v48H0z"/></svg>
            دخول عبر Google
        </a>
    </div>
</div>
@endsection