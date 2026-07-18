<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user) {
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Role berhasil diubah!');
    }
}