<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function dashboard()
    {
        return view('pages.fakultas.index-fakultas');
    }
    
    public function index()
    {
        $fakultas = Fakultas::all();
        return view('pages.admin.fakultas.fakultas', compact('fakultas'));
    }

    public function create()
    {
        return view('pages.admin.fakultas.fakultas-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_fakultas' => 'required|string|max:255|unique:fakultas,id_fakultas',
            'nama_fakultas' => 'required|string|max:255',
        ]);

        Fakultas::create($request->all());
        return redirect()->route('fakultas.index')->with('success', 'Fakultas created successfully.');
    }

    public function edit($id_fakultas)
    {
        $fakultas = Fakultas::findOrFail($id_fakultas);
        return view('pages.admin.fakultas.fakultas-edit', compact('fakultas'));
    }

    public function update(Request $request, $id_fakultas)
    {
        $request->validate([
            'nama_fakultas' => 'required|string|max:255',
        ]);

        $fakultas = Fakultas::findOrFail($id_fakultas);
        $fakultas->update($request->all());
        return redirect()->route('fakultas.index')->with('success', 'Fakultas updated successfully.');
    }

    public function destroy($id_fakultas)
    {
        $fakultas = Fakultas::findOrFail($id_fakultas);
        $fakultas->delete();
        return redirect()->route('fakultas.index')->with('success', 'Fakultas deleted successfully.');
    }
}

