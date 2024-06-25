<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeBeasiswa;
use App\Models\Beasiswa;

class PeriodeBeasiswaController extends Controller
{   
    public function index()
    {
        $periodes = PeriodeBeasiswa::select('tahun_ajaran', 'triwulan', 'start_date', 'end_date')
                                    ->distinct()
                                    ->orderBy('tahun_ajaran')
                                    ->orderBy('triwulan')
                                    ->get();
        return view('pages.fakultas.periode.periode-fakultas', compact('periodes'));
    }

    public function create()
    {
        $beasiswas = Beasiswa::whereDoesntHave('periodes')->get();
        return view('pages.fakultas.periode.create-periode', compact('beasiswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|integer|min:1900|max:2100',
            'triwulan' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'beasiswas' => 'required|array',
            'beasiswas.*' => 'exists:beasiswa,id_beasiswa',
        ]);

        foreach ($request->beasiswas as $id_beasiswa) {
            PeriodeBeasiswa::create([
                'id_beasiswa' => $id_beasiswa,
                'tahun_ajaran' => $request->tahun_ajaran,
                'triwulan' => $request->triwulan,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
        }

        return redirect()->route('fakultas.periode.index')->with('success', 'Periode created successfully.');
    }

    public function edit($tahun_ajaran, $triwulan)
    {
        $periodes = PeriodeBeasiswa::where('tahun_ajaran', $tahun_ajaran)
                                    ->where('triwulan', $triwulan)
                                    ->get();
        $beasiswas = Beasiswa::whereDoesntHave('periodes')
                            ->orWhereHas('periodes', function($query) use ($tahun_ajaran, $triwulan) {
                                $query->where('tahun_ajaran', $tahun_ajaran)
                                      ->where('triwulan', $triwulan);
                            })->get();
        $selectedBeasiswas = $periodes->pluck('id_beasiswa')->toArray();

        return view('pages.fakultas.periode.edit-periode', compact('periodes', 'beasiswas', 'selectedBeasiswas', 'tahun_ajaran', 'triwulan'));
    }

    public function update(Request $request, $tahun_ajaran, $triwulan)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'beasiswas' => 'required|array',
            'beasiswas.*' => 'exists:beasiswa,id_beasiswa',
        ]);

        // Delete existing periodes for the given tahun_ajaran and triwulan
        PeriodeBeasiswa::where('tahun_ajaran', $tahun_ajaran)
                        ->where('triwulan', $triwulan)
                        ->delete();

        // Create new periodes with updated data
        foreach ($request->beasiswas as $id_beasiswa) {
            PeriodeBeasiswa::create([
                'id_beasiswa' => $id_beasiswa,
                'tahun_ajaran' => $tahun_ajaran,
                'triwulan' => $triwulan,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
        }

        return redirect()->route('fakultas.periode.index')->with('success', 'Periode updated successfully.');
    }

    public function destroy($tahun_ajaran, $triwulan)
    {
        PeriodeBeasiswa::where('tahun_ajaran', $tahun_ajaran)
                        ->where('triwulan', $triwulan)
                        ->delete();

        return redirect()->route('fakultas.periode.index')->with('success', 'Periode deleted successfully.');
    }
}
