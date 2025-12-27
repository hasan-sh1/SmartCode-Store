<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $paidOrders = Order::where('user_id', $user->id)->where('payment_status', 'paid')->with('items')->get();
        $purchasedCount = $paidOrders->flatMap(function ($order) {
            return $order->items;
        })->sum('quantity');

        return view('profile.index', compact('user', 'purchasedCount'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'bio' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar_path = $path;
        }

        $user->name = $data['name'];
        $user->bio = $data['bio'] ?? $user->bio;
        $user->save();

        return redirect()->route('profile.index')->with('success', 'تم تحديث الملف الشخصي');
    }
}