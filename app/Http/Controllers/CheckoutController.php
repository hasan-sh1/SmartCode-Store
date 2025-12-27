<?php

namespace App\Http\Controllers;

use App\Models\{Order, OrderItem, Product};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('store.index')->with('error', 'السلة فارغة');
        }
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => ['required','string','max:1000'],
        ]);

        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('store.index')->with('error', 'السلة فارغة');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total' => $total,
            'payment_status' => 'unpaid',
            'payment_intent_id' => null,
            'stripe_session_id' => null,
            'shipping_address' => $request->input('shipping_address'),
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        $stripeKey = config('services.stripe.key');
        $stripeSecret = config('services.stripe.secret');

        if ($stripeSecret) {
            \Stripe\Stripe::setApiKey($stripeSecret);
            $lineItems = [];
            foreach ($cart as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                        'unit_amount' => (int) round($item['price'] * 100),
                    ],
                    'quantity' => $item['quantity'],
                ];
            }

            $session = \Stripe\Checkout\Session::create([
                'mode' => 'payment',
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
            ]);

            $order->update([
                'stripe_session_id' => $session->id,
            ]);

            $request->session()->put('pending_order_id', $order->id);
            return redirect($session->url);
        }

        // Fallback: simulate payment success
        $order->update([
            'status' => 'paid',
            'payment_status' => 'paid',
        ]);
        $request->session()->forget('cart');
        return redirect()->route('checkout.success')->with('success', 'تمت عملية الدفع بنجاح (وضع تجريبي)');
    }

    public function success(Request $request)
    {
        if ($orderId = $request->session()->pull('pending_order_id')) {
            $order = Order::find($orderId);
            if ($order) {
                $order->update(['status' => 'paid', 'payment_status' => 'paid']);
            }
        }
        return view('checkout.success');
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}