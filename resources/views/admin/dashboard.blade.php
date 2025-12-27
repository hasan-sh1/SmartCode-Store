@extends('admin.layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded shadow p-6">
        <div class="text-slate-500">المستخدمون</div>
        <div class="text-3xl font-bold">{{ $metrics['users'] }}</div>
    </div>
    <div class="bg-white rounded shadow p-6">
        <div class="text-slate-500">المنتجات</div>
        <div class="text-3xl font-bold">{{ $metrics['products'] }}</div>
    </div>
    <div class="bg-white rounded shadow p-6">
        <div class="text-slate-500">الطلبات</div>
        <div class="text-3xl font-bold">{{ $metrics['orders'] }}</div>
    </div>
    <div class="bg-white rounded shadow p-6">
        <div class="text-slate-500">الإيرادات</div>
        <div class="text-3xl font-bold">$ {{ number_format($metrics['revenue'], 2) }}</div>
    </div>
</div>

<div class="mt-8 bg-white rounded shadow">
    <div class="px-6 py-4 border-b font-semibold">أحدث الطلبات</div>
    <div class="p-6 overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left text-slate-500">
                    <th class="px-3 py-2">#</th>
                    <th class="px-3 py-2">المستخدم</th>
                    <th class="px-3 py-2">الحالة</th>
                    <th class="px-3 py-2">الدفع</th>
                    <th class="px-3 py-2">الإجمالي</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr class="border-t">
                    <td class="px-3 py-2">{{ $order->id }}</td>
                    <td class="px-3 py-2">{{ $order->user->name ?? '-' }}</td>
                    <td class="px-3 py-2">{{ $order->status }}</td>
                    <td class="px-3 py-2">{{ $order->payment_status }}</td>
                    <td class="px-3 py-2">$ {{ number_format($order->total, 2) }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-3 py-4 text-center text-slate-400">لا توجد طلبات بعد</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection