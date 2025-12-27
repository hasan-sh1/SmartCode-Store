@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-lg font-semibold">السورس كود/الخدمات</h1>
    <a href="{{ route('admin.services.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">إضافة عنصر</a>
</div>
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead>
        <tr class="text-left text-slate-500">
            <th class="px-3 py-2">العنوان</th>
            <th class="px-3 py-2">السعر</th>
            <th class="px-3 py-2">رابط الكود</th>
            <th class="px-3 py-2">ملف مرفق</th>
            <th class="px-3 py-2">الحالة</th>
            <th class="px-3 py-2">إجراءات</th>
        </tr>
        </thead>
        <tbody>
        @forelse($services as $service)
            <tr class="border-t">
                <td class="px-3 py-2">{{ $service->title }}</td>
                <td class="px-3 py-2">{{ $service->price ? '$ '.number_format($service->price, 2) : '-' }}</td>
                <td class="px-3 py-2">
                    @if($service->code_url)
                        <a href="{{ $service->code_url }}" target="_blank" class="text-indigo-600 underline">رابط</a>
                    @else
                        <span class="text-slate-400">لا يوجد</span>
                    @endif
                </td>
                <td class="px-3 py-2">
                    @if($service->attachment_path)
                        <a href="{{ asset('storage/'.$service->attachment_path) }}" class="text-indigo-600 underline">تحميل</a>
                    @else
                        <span class="text-slate-400">لا يوجد</span>
                    @endif
                </td>
                <td class="px-3 py-2">{{ $service->is_active ? 'نشط' : 'موقوف' }}</td>
                <td class="px-3 py-2 space-x-2 space-x-reverse">
                    <a href="{{ route('admin.services.edit', $service) }}" class="px-3 py-1 bg-amber-500 text-white rounded">تعديل</a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 bg-rose-500 text-white rounded" onclick="return confirm('تأكيد الحذف؟')">حذف</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="px-3 py-4 text-center text-slate-400">لا توجد عناصر</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $services->links() }}</div>
@endsection