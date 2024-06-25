<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\PeriodeBeasiswa;
use App\Models\Beasiswa;
use App\Models\PengajuanDoc;

class FakultasPengajuanController extends Controller
{
    public function index()
    {
        $periodes = PeriodeBeasiswa::select('tahun_ajaran', 'triwulan', 'id_beasiswa')
                                    ->distinct()
                                    ->orderBy('tahun_ajaran')
                                    ->orderBy('triwulan')
                                    ->get();

        $beasiswas = Beasiswa::all();

        return view('pages.fakultas.pengajuan.index', compact('periodes', 'beasiswas'));
    }

    public function show($tahun_ajaran, $triwulan, $beasiswa_id)
    {
        $pengajuans = Pengajuan::whereHas('periode', function ($query) use ($tahun_ajaran, $triwulan) {
                $query->where('tahun_ajaran', $tahun_ajaran)
                      ->where('triwulan', $triwulan);
            })
            ->where('id_beasiswa', $beasiswa_id)
            ->where('status_1', true) // Ensure that status_1 is accepted by Prodi
            ->get();
        return view('pages.fakultas.pengajuan.show', compact('pengajuans', 'tahun_ajaran', 'triwulan', 'beasiswa_id'));
    }

    public function approve($id_user, $id_beasiswa, $id_periode)
    {
        $pengajuan = Pengajuan::where('id_user', $id_user)
                              ->where('id_beasiswa', $id_beasiswa)
                              ->where('id_periode', $id_periode)
                              ->firstOrFail();
        $pengajuan->status_2 = true;
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan approved successfully.');
    }

    public function reject($id_user, $id_beasiswa, $id_periode)
    {
        $pengajuan = Pengajuan::where('id_user', $id_user)
                              ->where('id_beasiswa', $id_beasiswa)
                              ->where('id_periode', $id_periode)
                              ->firstOrFail();
        $pengajuan->status_2 = false;
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan rejected successfully.');
    }

    public function viewDocuments($id_user, $id_beasiswa, $id_periode)
    {
        $pengajuanDocs = PengajuanDoc::where('id_user', $id_user)
                                     ->where('id_beasiswa', $id_beasiswa)
                                     ->where('id_periode', $id_periode)
                                     ->get();

        return view('pages.fakultas.pengajuan.documents', compact('pengajuanDocs'));
    }
}