<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAdminController extends Controller
{
    public function index()
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin','admin'])) {
            abort(403);
        }
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin'])) {
            abort(403);
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'nullable|string|in:super-admin,admin,staff',
        ]);

        $user->update(['name' => $data['name'], 'email' => $data['email']]);

        if (isset($data['role']) && method_exists($user, 'syncRoles')) {
            $user->syncRoles([$data['role']]);
        }

        return redirect()->route('admin.users.index')->with('status', 'تم تعديل المستخدم');
    }

    public function destroy(User $user)
    {
        if (method_exists(Auth::user(), 'hasRole') && !Auth::user()->hasRole(['super-admin'])) {
            abort(403);
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('status', 'تم حذف المستخدم');
    }
}