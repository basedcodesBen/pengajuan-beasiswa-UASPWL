<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function welcome()
    {
        return view('pages.admin.index-admin');
    }

    public function users()
    {
        $users = User::all(); // Fetch all users from the User table
        return view('pages.admin.users', compact('users'));
    }
    
    public function create()
    {
        return view('pages.admin.user-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nrp' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'nrp' => $request->nrp,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users');
    }

    public function edit(User $user)
    {
        return view('pages.admin.user-edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nrp' => 'required|string|max:255|unique:users,nrp,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'nrp' => $request->nrp,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users');
    }
}
