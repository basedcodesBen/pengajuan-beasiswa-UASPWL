<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.login.login-page');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'user') {
                return redirect()->route('user.dashboard');
            } elseif ($user->role == 'prodi') {
                return redirect()->route('prodi.dashboard');
            } elseif ($user->role == 'fakultas') {
                return redirect()->route('fakultas.dashboard');
            }
            // Add more role-based redirects if necessary
        }

        return redirect()->back()->withErrors(['login' => 'Invalid credentials or inactive account']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
