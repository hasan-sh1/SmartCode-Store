@extends('layouts.app')@section('content')
<section class="text-center py-10">
    <h1 class="text-2xl font-bold mb-4">متجر ذكي مع خدمات وسورس كود</h1>
    <p class="mb-6">منصة متكاملة لبيع المنتجات الرقمية والخدمات، مع إدارة كاملة للفئات والمنتجات والخدمات، ودفع
        إلكتروني وتسجيل اجتماعي وواجهات API.</p>
    <div class="flex justify-center gap-4"><a href="{{ route('store.index') }}"
            class="px-5 py-3 bg-blue-600 text-white rounded">اذهب إلى المتجر</a><a href="{{ route('source.code') }}"
            class="px-5 py-3 bg-gray-800 text-white rounded">اذهب إلى السورس كود</a></div>
</section>
@endsection
