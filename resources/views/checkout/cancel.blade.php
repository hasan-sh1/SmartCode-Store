@extends('layouts.app')

@section('title', 'تم إلغاء الدفع')

@section('content')
<x-alert />
<div class="bg-white shadow rounded p-6 text-center">
    <h1 class="text-2xl font-semibold mb-2">تم إلغاء العملية</h1>
    <p class="text-gray-600 mb-4">لم يتم إتمام الدفع. يمكنك المحاولة مرة أخرى.</p>
    <a href="{{ route('cart.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">العودة للسلة</a>
</div>
@endsection