@extends('layouts.app')

@section('title', 'تحويل بنكي')

@section('content')
<x-alert />
<div class="bg-white shadow rounded p-6">
    <h1 class="text-2xl font-semibold mb-2">تفاصيل التحويل البنكي</h1>
    <p class="text-gray-600 mb-4">يرجى إجراء التحويل البنكي وفق المعلومات التالية ثم تزويدنا بإيصال التحويل.</p>

    <div class="grid sm:grid-cols-2 gap-4 mb-6">
        <div class="border rounded p-4">
            <h2 class="font-medium mb-2">الحساب البنكي</h2>
            <ul class="space-y-1 text-gray-700">
                <li>اسم البنك: بنك المثال</li>
                <li>اسم المستفيد: شركة سمارت كود</li>
                <li>رقم الحساب: 1234567890</li>
                <li>IBAN: SA00 0000 0000 0000 0000 0000</li>
            </ul>
        </div>
        <div class="border rounded p-4">
            <h2 class="font-medium mb-2">ملاحظات</h2>
            <ul class="list-disc pl-5 text-gray-700">
                <li>أدخل رقم الطلب في وصف التحويل.</li>
                <li>يتم تفعيل الطلب خلال 24-48 ساعة بعد التأكيد.</li>
                <li>أرسل الإيصال إلى البريد: billing@smartcode.example</li>
            </ul>
        </div>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('store.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">متابعة التسوق</a>
        <a href="{{ route('cart.index') }}" class="px-4 py-2 bg-gray-200 rounded">العودة للسلة</a>
    </div>
</div>
@endsection