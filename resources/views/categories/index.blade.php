@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-gradient-to-b from-indigo-50 via-pink-50 to-white py-10">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-indigo-700">الفئات</h1>
                <p class="text-gray-600">تصفح الفئات المتاحة للوصول السريع لمنتجات المتجر</p>
            </div>
            <a href="{{ route('store.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">الذهاب للمتجر</a>
        </div>

        @if(isset($categories) && $categories->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $cat)
                    <a href="{{ route('store.index', ['category' => $cat->slug]) }}" class="block rounded-lg border border-gray-200 bg-white shadow hover:shadow-lg transition overflow-hidden">
                        <div class="h-32 bg-gray-100 flex items-center justify-center">
                            <span class="text-3xl font-bold text-indigo-600">{{ mb_substr($cat->name, 0, 1) }}</span>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold">{{ $cat->name }}</h3>
                                @if(property_exists($cat, 'products_count'))
                                    <span class="text-sm text-gray-600">{{ $cat->products_count }} منتج</span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ \Illuminate\Support\Str::limit($cat->description, 120) }}</p>
                            <div class="mt-3">
                                <span class="inline-block text-xs px-2 py-1 rounded-full bg-indigo-50 text-indigo-700">مشاهدة منتجات هذه الفئة</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-6 text-yellow-900">
                لا توجد فئات متاحة حالياً.
            </div>
        @endif
    </div>
</section>
@endsection