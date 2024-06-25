<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeBeasiswa;

class PeriodeBeasiswaController extends Controller
{
    public function index()
    {
        $periodes = PeriodeBeasiswa::all();
        return view('pages.fakultas.index-fakultas', compact('periodes'));
    }

    public function create()
    {
        return view('fakultas.periode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        PeriodeBeasiswa::create($request->all());

        return redirect()->route('fakultas.periode.index')->with('success', 'Periode created successfully.');
    }

    public function edit($id)
    {
        $periode = PeriodeBeasiswa::findOrFail($id);
        return view('fakultas.periode.edit', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        $periode = PeriodeBeasiswa::findOrFail($id);
        $periode->update($request->all());

        return redirect()->route('fakultas.periode.index')->with('success', 'Periode updated successfully.');
    }

    public function destroy($id)
    {
        $periode = PeriodeBeasiswa::findOrFail($id);
        $periode->delete();

        return redirect()->route('fakultas.periode.index')->with('success', 'Periode deleted successfully.');
    }
}
