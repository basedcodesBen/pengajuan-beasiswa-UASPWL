<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beasiswa;

class BeasiswaController extends Controller
{
    public function index()
    {
        $beasiswas = Beasiswa::with('periodes')->get();
        return view('pages.admin.beasiswa.beasiswa-admin', compact('beasiswas'));
    }

    public function create()
    {
        return view('pages.admin.beasiswa.create-beasiswa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_beasiswa' => 'required|string|max:255',
        ]);

        Beasiswa::create($request->all());

        return redirect()->route('beasiswa.index')->with('success', 'Beasiswa created successfully.');
    }

    public function edit($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('pages.admin.beasiswa.edit-beasiswa', compact('beasiswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_beasiswa' => 'required|string|max:255',
        ]);

        $beasiswa = Beasiswa::findOrFail($id);
        $beasiswa->update($request->all());

        return redirect()->route('beasiswa.index')->with('success', 'Beasiswa updated successfully.');
    }

    public function destroy($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        $beasiswa->delete();

        return redirect()->route('beasiswa.index')->with('success', 'Beasiswa deleted successfully.');
    }
}
