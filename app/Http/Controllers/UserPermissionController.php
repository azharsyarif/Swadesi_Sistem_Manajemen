<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function index()
    {
        $users = User::with('permissions')->get();
        $permissions = Permission::all();

        return view('Admins.user_permission', compact('users', 'permissions'));
    }

    public function update(Request $request, $userId)
    {
        // Validasi input
        $validated = $request->validate([
            'permissions' => 'array|required',
            'permissions.*' => 'exists:permissions,id',
        ]);
    
        // Ambil user berdasarkan ID
        $user = User::findOrFail($userId);
    
        // Sinkronkan izin-izin baru dengan user
        $user->permissions()->sync($validated['permissions']);
    
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Permissions updated successfully.');
    }
    
}
