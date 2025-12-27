@extends('layouts.app')

@section('title', 'السلة')

@section('content')
<x-alert />
<h1 class="text-xl font-semibold mb-4">سلة التسوق</h1>
@if(empty($cart))
    <p class="text-gray-600">السلة فارغة. <a href="{{ route('store.index') }}" class="text-blue-600">اذهب للمتجر</a></p>
@else
    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="text-left p-3">المنتج</th>
                    <th class="text-left p-3">السعر</th>
                    <th class="text-left p-3">الكمية</th>
                    <th class="text-left p-3">الإجمالي</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr class="border-t">
                        <td class="p-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item['image_path'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                                <div>
                                    <div class="font-medium">{{ $item['name'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-3">${{ number_format($item['price'], 2) }}</td>
                        <td class="p-3">
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" min="1" name="quantity" value="{{ $item['quantity'] }}" class="w-20 border rounded px-2 py-1">
                                <button class="px-2 py-1 bg-gray-200 rounded">تحديث</button>
                            </form>
                        </td>
                        <td class="p-3">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td class="p-3 text-right">
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST" onsubmit="return confirm('إزالة المنتج من السلة؟');">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-2 bg-red-600 text-white rounded">إزالة</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-4">
        <div class="text-lg">الإجمالي: <span class="font-semibold">${{ number_format($total, 2) }}</span></div>
        <div class="flex gap-2">
            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('تفريغ السلة؟');">
                @csrf
                @method('DELETE')
                <button class="px-3 py-2 bg-gray-200 rounded">تفريغ</button>
            </form>
            <a href="{{ route('checkout.index') }}" class="px-4 py-2 bg-green-600 text-white rounded">إتمام الشراء</a>
        </div>
    </div>
@endif
@endsection