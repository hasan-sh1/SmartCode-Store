<nav class="sticky top-0 z-40 bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-600 text-white shadow">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('landing') }}" class="flex items-center gap-2 font-semibold">
                    <!-- Simple logo mark -->
                    <span class="inline-flex items-center justify-center w-8 h-8 bg-white/20 rounded">SC</span>
                    <span>{{ config('app.name','Smartcode Store') }}</span>
                </a>
            </div>
            <!-- Mobile toggle -->
            <button class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded bg-white/10" onclick="document.getElementById('mainNav').classList.toggle('hidden')">
                <!-- hamburger -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2"/>
                </svg>
            </button>
            <div class="hidden lg:flex items-center gap-6">
                <a href="{{ route('landing') }}" class="hover:text-yellow-200 {{ request()->routeIs('landing') ? 'underline decoration-2' : '' }}">الصفحة الرئيسية</a>
                <a href="{{ route('store.index') }}" class="hover:text-yellow-200 {{ request()->routeIs('store.*') ? 'underline decoration-2' : '' }}">المتجر</a>
                <a href="{{ route('source.code') }}" class="hover:text-yellow-200 {{ request()->routeIs('source.code') ? 'underline decoration-2' : '' }}">السورس كود</a>
                <a href="{{ route('categories.index') }}" class="hover:text-yellow-200 {{ request()->routeIs('categories.*') ? 'underline decoration-2' : '' }}">الفئات</a>
                <a href="{{ route('store.index') }}" class="hover:text-yellow-200 {{ request()->routeIs('store.*') ? 'underline decoration-2' : '' }}">المنتجات</a>
                <a href="{{ route('services.index') }}" class="hover:text-yellow-200 {{ request()->routeIs('services.*') ? 'underline decoration-2' : '' }}">الخدمات</a>
                <a href="{{ route('cart.index') }}" class="relative hover:text-yellow-200 {{ request()->routeIs('cart.*') ? 'underline decoration-2' : '' }}">
                    <!-- cart icon -->
                    <span class="inline-flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5"><path d="M3 3h2l.4 2M7 13h10l3-8H6.4" stroke-width="2"/><circle cx="9" cy="21" r="1"/><circle cx="19" cy="21" r="1"/></svg>
                        السلة
                    </span>
                    @php
                        $cartCount = collect(session('cart', []))->sum(fn($i) => $i['quantity']);
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-3 text-xs bg-red-500 text-white rounded-full px-1">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
            <div class="hidden lg:flex items-center gap-3">
                @auth
    @php $isAdmin = auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'); @endphp
    @if($isAdmin)
        <a href="{{ route('admin.dashboard') }}" class="text-sm underline decoration-2">مرحباً، {{ auth()->user()->name }}</a>
        <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 bg-white text-indigo-700 rounded hover:bg-yellow-200">لوحة الإدارة</a>
    @else
        <span class="text-sm">مرحباً، {{ auth()->user()->name }}</span>
    @endif
    <a href="{{ route('profile.index') }}" class="px-3 py-2 bg-white/10 rounded hover:bg-white/20">الملف الشخصي</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="px-3 py-2 bg-white/10 rounded hover:bg-white/20">خروج</button>
    </form>
    @else
        <a href="{{ route('login') }}" class="px-3 py-2 bg-white/10 rounded hover:bg-white/20">دخول</a>
        <a href="{{ route('register') }}" class="px-3 py-2 bg-white text-indigo-700 rounded hover:bg-yellow-200">إنشاء حساب</a>
    @endauth
            </div>
        </div>
        <!-- Collapsible nav -->
        <div id="mainNav" class="mt-3 hidden lg:hidden">
            <div class="grid gap-2">
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('landing') }}" class="px-3 py-2 rounded bg-white/10 hover:bg-white/20 {{ request()->routeIs('landing') ? 'ring-2 ring-yellow-200' : '' }}">الصفحة الرئيسية</a>
                    <a href="{{ route('store.index') }}" class="px-3 py-2 rounded bg-white/10 hover:bg-white/20 {{ request()->routeIs('store.*') ? 'ring-2 ring-yellow-200' : '' }}">المتجر</a>
                    <a href="{{ route('source.code') }}" class="px-3 py-2 rounded bg-white/10 hover:bg-white/20 {{ request()->routeIs('source.code') ? 'ring-2 ring-yellow-200' : '' }}">السورس كود</a>
                    <a href="{{ route('categories.index') }}" class="px-3 py-2 rounded bg-white/10 hover:bg-white/20 {{ request()->routeIs('categories.*') ? 'ring-2 ring-yellow-200' : '' }}">الفئات</a>
                    <a href="{{ route('products.index') }}" class="px-3 py-2 rounded bg-white/10 hover:bg-white/20 {{ request()->routeIs('products.*') ? 'ring-2 ring-yellow-200' : '' }}">المنتجات</a>
                    <a href="{{ route('services.index') }}" class="px-3 py-2 rounded bg-white/10 hover:bg-white/20 {{ request()->routeIs('services.*') ? 'ring-2 ring-yellow-200' : '' }}">الخدمات</a>
                    <a href="{{ route('cart.index') }}" class="px-3 py-2 rounded bg-white/10 hover:bg-white/20 {{ request()->routeIs('cart.*') ? 'ring-2 ring-yellow-200' : '' }}">السلة</a>
                </div>
                <div class="flex items-center gap-3">
                    @auth
    @php $isAdmin = auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'); @endphp
    @if($isAdmin)
        <a href="{{ route('admin.dashboard') }}" class="text-sm underline decoration-2">مرحباً، {{ auth()->user()->name }}</a>
        <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 bg-white text-indigo-700 rounded hover:bg-yellow-200">لوحة الإدارة</a>
    @else
        <span class="text-sm">مرحباً، {{ auth()->user()->name }}</span>
    @endif
    <a href="{{ route('profile.index') }}" class="px-3 py-2 bg-white/10 rounded hover:bg-white/20">الملف الشخصي</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="px-3 py-2 bg-white/10 rounded hover:bg-white/20">خروج</button>
    </form>
    @else
        <a href="{{ route('login') }}" class="px-3 py-2 bg-white/10 rounded hover:bg-white/20">دخول</a>
        <a href="{{ route('register') }}" class="px-3 py-2 bg-white text-indigo-700 rounded hover:bg-yellow-200">إنشاء حساب</a>
    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>