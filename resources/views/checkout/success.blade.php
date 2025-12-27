@extends('layouts.app')

@section('title', 'نجاح الدفع')

@section('content')
<x-alert />
<div class="bg-white shadow rounded p-6 text-center">
    <h1 class="text-2xl font-semibold mb-2">تم الدفع بنجاح</h1>
    <p class="text-gray-600 mb-4">شكراً لشرائك. تم تأكيد طلبك.</p>
    <a href="{{ route('store.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">العودة للمتجر</a>
</div>
@endsection