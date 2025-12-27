@extends('layouts.app')

@section('content')
<section class="py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-2">سورس كود وخدمات مستقلة</h1>
        <p class="mb-6 text-gray-700">تصفح الأكواد الجاهزة والخدمات القابلة للشراء أو التحميل.</p>

        @if(isset($items) && $items->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($items as $item)
                    <div class="rounded-lg border border-gray-200 shadow hover:shadow-lg transition bg-white overflow-hidden">
                        <div class="h-40 bg-gray-100 overflow-hidden">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/600x400?text=صورة+الخدمة'">
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-1">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-600 mb-3">
                                {{ \Illuminate\Support\Str::limit($item->description, 120) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-indigo-600 font-bold">
                                    {{ $item->price ? number_format($item->price, 2) . ' ر.س' : 'مجاني' }}
                                </span>
                                @if($item->code_url)
                                    <a href="{{ $item->code_url }}" target="_blank" class="text-sm text-indigo-700 underline">رابط الكود</a>
                                @endif
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 flex items-center gap-3">
                            <a href="{{ $item->code_url ?? '#' }}" target="{{ $item->code_url ? '_blank' : '_self' }}" class="px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 {{ $item->code_url ? '' : 'opacity-50 cursor-not-allowed' }}">
                                التفاصيل
                            </a>
                            <a href="{{ route('services.index') }}" class="px-3 py-2 bg-white text-indigo-700 rounded hover:bg-indigo-100">
                                كل الخدمات
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-6 rounded bg-yellow-50 border border-yellow-200 text-yellow-800">
                لا توجد عناصر سورس كود حالياً. يرجى العودة لاحقاً أو تصفح
                <a class="underline text-indigo-700" href="{{ route('services.index') }}">صفحة الخدمات</a>.
            </div>
        @endif
    </div>
</section>
@endsection