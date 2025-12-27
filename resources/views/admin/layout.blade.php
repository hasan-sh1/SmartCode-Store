<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة السوبر أدمن</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen">
    <div class="flex">
        <aside class="w-64 min-h-screen bg-gradient-to-b from-indigo-600 to-violet-600 text-white">
            <div class="px-6 py-4 font-bold text-xl">
                <a href="{{ route('store.index') }}" class="hover:underline">{{ config('app.name', 'Smartcode Store') }}</a>
                <span class="text-xs font-normal opacity-80">/ لوحة الإدارة</span>
            </div>
            <nav class="px-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-white/10">الإحصائيات</a>
                <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded hover:bg-white/10">المستخدمون</a>
                <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 rounded hover:bg-white/10">التصنيفات</a>
                <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded hover:bg-white/10">المنتجات</a>
                <a href="{{ route('admin.services.index') }}" class="block px-3 py-2 rounded hover:bg-white/10">السورس كود/الخدمات</a>
            </nav>
        </aside>
        <main class="flex-1">
            <header class="bg-white border-b px-6 py-4 flex items-center justify-between">
                <div class="font-semibold text-slate-700">مرحبا، {{ auth()->user()->name ?? 'مشرف' }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-3 py-2 bg-rose-500 text-white rounded hover:bg-rose-600">تسجيل الخروج</button>
                </form>
            </header>
            <section class="p-6">
                @if(session('status'))
                    <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-700 rounded">{{ session('status') }}</div>
                @endif
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>