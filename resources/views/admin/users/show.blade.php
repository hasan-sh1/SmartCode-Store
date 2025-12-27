@extends('admin.layout')

@section('content')
<h1 class="text-lg font-semibold mb-4">تحرير المستخدم</h1>
<form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white rounded shadow p-6 space-y-4">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            @php($roles = ['super-admin' => 'Super Admin', 'admin' => 'Admin', 'staff' => 'Staff'])
            <label class="block text-sm text-slate-600 mb-1">الاسم</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-sm text-slate-600 mb-1">البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2" required>
        </div>
    </div>
    <div>
        <label class="block text-sm text-slate-600 mb-1">الدور</label>
        <select name="role" class="w-full border rounded px-3 py-2">
            <option value="">بدون</option>
            @foreach($roles as $key => $label)
                <option value="{{ $key }}" @selected(method_exists($user,'hasRole') && $user->hasRole($key))>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-slate-200 rounded">رجوع</a>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded">حفظ</button>
    </div>
</form>
@endsection