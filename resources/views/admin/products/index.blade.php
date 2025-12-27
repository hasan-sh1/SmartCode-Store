@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-lg font-semibold">المنتجات</h1>
    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">إضافة منتج</a>
</div>
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead>
        <tr class="text-left text-slate-500">
            <th class="px-3 py-2">الصورة</th>
            <th class="px-3 py-2">الاسم</th>
            <th class="px-3 py-2">السعر</th>
            <th class="px-3 py-2">الفئة</th>
            <th class="px-3 py-2">المخزون</th>
            <th class="px-3 py-2">الحالة</th>
            <th class="px-3 py-2">إجراءات</th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $p)
            <tr class="border-t">
                <td class="px-3 py-2">
                    <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-16 h-16 object-cover rounded" onerror="this.src='https://via.placeholder.com/64x64?text=No+Image'">
                </td>
                <td class="px-3 py-2">{{ $p->name }}</td>
                <td class="px-3 py-2">{{ number_format($p->price, 2) }} ر.س</td>
                <td class="px-3 py-2">{{ optional($p->category)->name }}</td>
                <td class="px-3 py-2">{{ $p->stock }}</td>
                <td class="px-3 py-2">{{ $p->is_active ? 'نشط' : 'موقوف' }}</td>
                <td class="px-3 py-2 space-x-2 space-x-reverse">
                    <a href="{{ route('admin.products.edit', $p) }}" class="px-3 py-1 bg-amber-500 text-white rounded">تعديل</a>
                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 bg-rose-500 text-white rounded" onclick="return confirm('تأكيد الحذف؟')">حذف</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="px-3 py-4 text-center text-slate-400">لا توجد منتجات</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection