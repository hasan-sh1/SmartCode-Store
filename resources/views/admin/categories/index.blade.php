@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-lg font-semibold">التصنيفات</h1>
    <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">إضافة تصنيف</a>
</div>
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead>
        <tr class="text-left text-slate-500">
            <th class="px-3 py-2">الاسم</th>
            <th class="px-3 py-2">الوصف</th>
            <th class="px-3 py-2">الحالة</th>
            <th class="px-3 py-2">إجراءات</th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $cat)
            <tr class="border-t">
                <td class="px-3 py-2">{{ $cat->name }}</td>
                <td class="px-3 py-2">{{ Str::limit($cat->description, 60) }}</td>
                <td class="px-3 py-2">{{ $cat->is_active ? 'نشط' : 'موقوف' }}</td>
                <td class="px-3 py-2 space-x-2 space-x-reverse">
                    <a href="{{ route('admin.categories.edit', $cat) }}" class="px-3 py-1 bg-amber-500 text-white rounded">تعديل</a>
                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 bg-rose-500 text-white rounded" onclick="return confirm('تأكيد حذف التصنيف؟')">حذف</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="px-3 py-4 text-center text-slate-400">لا توجد تصنيفات</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $categories->links() }}</div>
@endsection