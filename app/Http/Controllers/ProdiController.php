<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Fakultas;
use App\Models\Pengajuan;
use App\Models\Periode;
use App\Models\Beasiswa;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view('pages.prodi.index-prodi');
    }

    public function index()
    {
        $prodi = Prodi::with('fakultas')->get();
        return view('pages.admin.prodi.prodi', compact('prodi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::all();
        return view('pages.admin.prodi.prodi-create', compact('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_prodi' => 'required|string|max:255|unique:prodi,id_prodi',
            'nama_prodi' => 'required|string|max:255',
            'id_fakultas' => 'required|string|exists:fakultas,id_fakultas',
        ]);

        Prodi::create($request->all());
        return redirect()->route('prodi.index')->with('success', 'Prodi created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_prodi)
    {
        $prodi = Prodi::findOrFail($id_prodi);
        $fakultas = Fakultas::all();
        return view('pages.admin.prodi.prodi-edit', compact('prodi', 'fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_prodi)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255',
            'id_fakultas' => 'required|string|exists:fakultas,id_fakultas',
        ]);

        $prodi = Prodi::findOrFail($id_prodi);
        $prodi->update($request->all());
        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil di update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_prodi)
    {
        $prodi = Prodi::findOrFail($id_prodi);
        $prodi->delete();
        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus.');
    }
}
