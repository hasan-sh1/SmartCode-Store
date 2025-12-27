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
</div>
@endsection