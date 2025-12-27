@extends('admin.layout')

@section('content')
<h1 class="text-lg font-semibold mb-4">المستخدمون</h1>
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead>
        <tr class="text-left text-slate-500">
            <th class="px-3 py-2">#</th>
            <th class="px-3 py-2">الاسم</th>
            <th class="px-3 py-2">البريد</th>
            <th class="px-3 py-2">الدور</th>
            <th class="px-3 py-2">إجراءات</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr class="border-t">
                <td class="px-3 py-2">{{ $user->id }}</td>
                <td class="px-3 py-2">{{ $user->name }}</td>
                <td class="px-3 py-2">{{ $user->email }}</td>
                <td class="px-3 py-2">{{ method_exists($user,'getRoleNames') ? $user->getRoleNames()->implode(', ') : '-' }}</td>
                <td class="px-3 py-2 space-x-2 space-x-reverse">
                    <a href="{{ route('admin.users.show', $user) }}" class="px-3 py-1 bg-amber-500 text-white rounded">تحرير</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 bg-rose-500 text-white rounded" onclick="return confirm('تأكيد حذف المستخدم؟')">حذف</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="px-3 py-4 text-center text-slate-400">لا يوجد مستخدمون</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $users->links() }}</div>
@endsection