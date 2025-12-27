@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-gradient-to-b from-indigo-50 via-fuchsia-50 to-white py-10">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-indigo-700">المتجر</h1>
                <p class="text-gray-600">تصفح المنتجات، وابحث وفرّز بسهولة</p>
            </div>
            <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">عرض الفئات</a>
        </div>

        <form method="GET" action="{{ route('store.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-6">
            <div class="md:col-span-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="ابحث باسم المنتج أو الوصف" class="w-full px-4 py-3 rounded border border-gray-300 focus:ring-2 focus:ring-indigo-400" />
            </div>
            <div>
                <select name="sort" class="w-full px-4 py-3 rounded border border-gray-300 focus:ring-2 focus:ring-indigo-400">
                    <option value="latest" {{ (request('sort','latest') === 'latest') ? 'selected' : '' }}>الأحدث</option>
                    <option value="price_asc" {{ (request('sort') === 'price_asc') ? 'selected' : '' }}>السعر (تصاعدي)</option>
                    <option value="price_desc" {{ (request('sort') === 'price_desc') ? 'selected' : '' }}>السعر (تنازلي)</option>
                </select>
            </div>
            <div class="md:col-span-1 flex gap-3">
                <button class="px-4 py-2 bg-violet-600 text-white rounded hover:bg-violet-700">تطبيق</button>
                <a href="{{ route('store.index') }}" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200">إعادة ضبط</a>
            </div>
        </form>

        @if(isset($categories) && $categories->count())
            <div class="mb-6">
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('store.index', ['q' => request('q'), 'sort' => request('sort')]) }}" class="px-3 py-1.5 rounded-full text-sm {{ request()->filled('category') ? 'bg-white text-slate-700 border' : 'bg-indigo-600 text-white' }}">الكل</a>
                    @foreach($categories as $cat)
                        <a href="{{ route('store.index', ['category' => $cat->slug, 'q' => request('q'), 'sort' => request('sort')]) }}" class="px-3 py-1.5 rounded-full text-sm {{ request('category') === $cat->slug ? 'bg-indigo-600 text-white' : 'bg-white text-slate-700 border' }}">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </div>
        @endif

        @if($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $p)
                    <div class="group rounded-xl overflow-hidden shadow-sm border border-gray-200 bg-white hover:shadow-md transition">
<div class="h-48 bg-gray-100 overflow-hidden">
    <img src="{{ $p->image_url }}"
         alt="صورة {{ $p->name }}"
         class="w-full h-full object-cover group-hover:scale-[1.02] transition"
         onerror="this.src='https://via.placeholder.com/600x400?text=صورة+المنتج'" />
</div>                        <div class="p-4">
                            <div class="flex items-start justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-700">{{ $p->name }}</h3>
                                <span class="text-sm font-bold text-indigo-700">{{ number_format($p->price, 2) }} ر.س</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-2">{{ \Illuminate\Support\Str::limit($p->description, 100) }}</p>
                            <div class="mt-3 flex items-center gap-2">
                                @if($p->stock > 0)
                                    <span class="text-xs px-2 py-1 rounded-full bg-emerald-50 text-emerald-700">متوفر</span>
                                @else
                                    <span class="text-xs px-2 py-1 rounded-full bg-rose-50 text-rose-700">غير متوفر</span>
                                @endif
                                <span class="text-xs px-2 py-1 rounded-full bg-indigo-50 text-indigo-700">{{ optional($p->category)->name }}</span>
                            </div>
                            <div class="mt-4 flex items-center gap-3">
                                <a href="{{ route('products.show', $p) }}" class="px-3 py-2 bg-white text-indigo-700 border border-indigo-200 rounded hover:bg-indigo-50 text-sm">التفاصيل</a>
                                <form method="POST" action="{{ route('cart.add', $p) }}" class="inline-block">
                                    @csrf
                                    <button class="px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm" {{ $p->stock <= 0 ? 'disabled' : '' }}>أضف للسلة</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-6 text-yellow-900">
                لا توجد منتجات مطابقة لبحثك حالياً.
            </div>
        @endif
    </div>
</section>
@endsection