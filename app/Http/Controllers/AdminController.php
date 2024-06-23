<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Fakultas;

class AdminController extends Controller
{
    public function welcome()
    {
        return view('pages.admin.index-admin');
    }

    public function users()
    {
        $users = User::all(); // Fetch all users from the User table
        return view('pages.admin.user.users', compact('users'));
    }
    
    public function create()
    {
        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        return view('pages.admin.user.user-create', compact('prodi', 'fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'role' => 'required|in:admin,prodi,fakultas,mahasiswa',
            'nrp' => 'required|string|unique:users,nrp',
            'id_prodi' => 'nullable|string|exists:prodi,id_prodi|required_if:role,prodi|required_if:role,mahasiswa',
            'id_fakultas' => 'nullable|string|exists:fakultas,id_fakultas|required_if:role,Fakultas',
        ]);

        $id_prodi = $request->input('id_prodi');
        $id_fakultas = null;

        if ($id_prodi) {
            $prodi = Prodi::find($id_prodi);
            $id_fakultas = $prodi->id_fakultas;
        }

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'nrp' => $request->input('nrp'),
            'id_prodi' => $request->input('role') !== 'admin' ? $id_prodi : null,
            'id_fakultas' => ($request->input('role') === 'fakultas') ? $request->input('id_fakultas') : $id_fakultas,
        ]);

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('pages.admin.user.user-edit', compact('user'));
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
