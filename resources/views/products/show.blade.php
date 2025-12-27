@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-gradient-to-b from-indigo-50 via-fuchsia-50 to-white py-10">
    <div class="container mx-auto px-4">
        <div class="mb-6">
            <a href="{{ route('products.index') }}" class="text-indigo-700 hover:underline">← عودة لقائمة المنتجات</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="rounded-xl overflow-hidden border bg-white">
                <div class="bg-gray-100 h-80 overflow-hidden">
                    <img src="{{ $product->image_url }}" alt="صورة {{ $product->name }}" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/800x600?text=صورة+المنتج'" />
                </div>
            </div>
            <div class="rounded-xl border bg-white p-6">
                <h1 class="text-2xl font-bold text-indigo-700">{{ $product->name }}</h1>
                <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-sm font-bold text-indigo-700">السعر: {{ number_format($product->price,2) }} ر.س</span>
                    @if($product->stock > 0)
                        <span class="text-xs px-2 py-1 rounded-full bg-emerald-50 text-emerald-700">متوفر</span>
                    @else
                        <span class="text-xs px-2 py-1 rounded-full bg-rose-50 text-rose-700">غير متوفر</span>
                    @endif
                </div>
                <div class="mt-2 text-sm text-gray-700">الفئة: {{ optional($product->category)->name }}</div>

                <div class="mt-6">
                    <div class="flex items-center gap-1">
                        @php $rating = $rating ?? null; @endphp
                        @for($i = 1; $i <= 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ ($rating && $i <= round($rating)) ? '#f59e0b' : 'none' }}" viewBox="0 0 24 24" stroke="#f59e0b" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11.049 2.927l1.902 3.853 4.253.618-3.077 2.999.726 4.234-3.804-2-3.804 2 .726-4.234-3.077-2.999 4.253-.618 1.902-3.853z"/>
                            </svg>
                        @endfor
                        <span class="text-sm text-gray-600 ml-2">
                            {{ $rating ? number_format($rating,1) . ' / 5' : 'لا توجد تقييمات بعد' }}
                        </span>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-3">
                    <form method="POST" action="{{ route('cart.add', $product) }}" class="inline-block">
                        @csrf
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700" {{ $product->stock <= 0 ? 'disabled' : '' }}>أضف للسلة</button>
                    </form>
                    <a href="{{ route('store.index') }}" class="px-4 py-2 bg-white text-indigo-700 border border-indigo-200 rounded hover:bg-indigo-50">الذهاب للمتجر</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection