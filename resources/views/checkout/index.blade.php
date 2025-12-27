@extends('layouts.app')

@section('title', 'الدفع')

@section('content')
<x-alert />
<h1 class="text-xl font-semibold mb-4">الدفع</h1>
<div class="bg-white shadow rounded p-6">
    <h2 class="font-medium mb-3">ملخص الطلب</h2>
    <ul class="list-disc pl-5 mb-4">
        @foreach($cart as $item)
            <li>{{ $item['name'] }} × {{ $item['quantity'] }} — ${{ number_format($item['price'] * $item['quantity'], 2) }}</li>
        @endforeach
    </ul>
    <div class="mb-4">الإجمالي: <span class="font-semibold">${{ number_format($total, 2) }}</span></div>

    <form method="POST" action="{{ route('checkout.process') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1">عنوان الشحن</label>
            <textarea name="shipping_address" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('shipping_address') }}</textarea>
        </div>
        <div>
            <label class="block mb-2 font-medium">طريقة الدفع</label>
            <div class="grid sm:grid-cols-3 gap-3">
                <label class="block border rounded p-3 cursor-pointer {{ old('payment_method','card')==='bank' ? 'ring-2 ring-indigo-400' : '' }}">
                    <input type="radio" name="payment_method" value="bank" class="mr-2" {{ old('payment_method')==='bank' ? 'checked' : '' }}> تحويل بنكي
                    <p class="text-sm text-gray-600 mt-1">تحويل مباشر بحساب بنكي محلي</p>
                </label>
                <label class="block border rounded p-3 cursor-pointer {{ old('payment_method','card')==='card' ? 'ring-2 ring-indigo-400' : '' }}">
                    <input type="radio" name="payment_method" value="card" class="mr-2" {{ old('payment_method','card')==='card' ? 'checked' : '' }}> فيزا / ماستركارد (Stripe)
                    <p class="text-sm text-gray-600 mt-1">دفع آمن عبر Stripe</p>
                </label>
                <label class="block border rounded p-3 cursor-pointer {{ old('payment_method','card')==='paypal' ? 'ring-2 ring-indigo-400' : '' }}">
                    <input type="radio" name="payment_method" value="paypal" class="mr-2" {{ old('payment_method')==='paypal' ? 'checked' : '' }}> PayPal
                    <p class="text-sm text-gray-600 mt-1">ادفع عبر حساب باي بال</p>
                </label>
            </div>
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded">متابعة الدفع</button>
    </form>
</div>
@endsection