@extends('layouts.app')

@section('title', 'الدفع عبر PayPal')

@section('content')
<x-alert />
<div class="bg-white shadow rounded p-6">
    <h1 class="text-2xl font-semibold mb-2">الدفع عبر PayPal</h1>
    <p class="text-gray-600 mb-4">هذه الصفحة تمهيدية. لتمكين الدفع عبر باي بال بشكل كامل، يرجى إعداد مفاتيح API.</p>

    <div class="border rounded p-4 mb-4">
        <h2 class="font-medium mb-2">الخطوات المطلوبة</h2>
        <ol class="list-decimal pl-5 text-gray-700 space-y-1">
            <li>أضف المتغيرات التالية إلى ملف <code>.env</code>:
                <pre class="bg-gray-100 rounded p-3 mt-2"><code>PAYPAL_CLIENT_ID=your-client-id
PAYPAL_SECRET=your-secret
PAYPAL_MODE=sandbox # أو live</code></pre>
            </li>
            <li>أضف اعدادات في <code>config/services.php</code> تحت مفتاح <code>paypal</code>.</li>
            <li>ادمج SDK الرسمي أو API لإنشاء طلب دفع وتأكيده.</li>
        </ol>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('store.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">متابعة التسوق</a>
        <a href="{{ route('cart.index') }}" class="px-4 py-2 bg-gray-200 rounded">العودة للسلة</a>
    </div>
</div>
@endsection