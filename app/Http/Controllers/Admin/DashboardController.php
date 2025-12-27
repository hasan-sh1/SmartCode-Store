<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Optional: enforce role check when Spatie migrations are ready
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }

        $metrics = [
            'users' => User::count(),
            'products' => Product::count(),
            'orders' => Order::count(),
            'revenue' => (float) Order::where('payment_status', 'paid')->sum('total'),
        ];

        $recentOrders = Order::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('metrics', 'recentOrders'));
    }
}