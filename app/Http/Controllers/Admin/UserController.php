<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Jangan biarkan admin mem-banned dirinya sendiri
        if ($user->id === auth()->id() && $request->is_active == '0') {
            return back()->with('error', 'Anda tidak dapat non-aktifkan akun Anda sendiri.');
        }
        
        // Jangan biarkan admin mencabut hak admin dirinya sendiri
        if ($user->id === auth()->id() && $request->role !== 'admin') {
            return back()->with('error', 'Anda tidak dapat merubah role akun admin utama Anda.');
        }

        $request->validate([
            'role' => 'required|in:user,admin',
            'is_active' => 'required|boolean',
        ]);

        $user->update([
            'role' => $request->role,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Status pengguna diperbarui.');
    }
}
