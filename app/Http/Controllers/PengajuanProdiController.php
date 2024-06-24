<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\PeriodeBeasiswa;
use App\Models\Beasiswa;

class PengajuanProdiController extends Controller
{
    public function index()
    {
        // Get all periods
        $periodes = PeriodeBeasiswa::all();
        return view('pages.prodi.pengajuan.pengajuan-prodi', compact('periodes'));
    }

    public function selectBeasiswa($periode_id)
    {
        // Display list of beasiswa for the selected periode
        $beasiswas = Beasiswa::all();
        return view('pages.prodi.pengajuan.select-beasiswa-prodi', compact('beasiswas', 'periode_id'));
    }

    public function showPengajuan($periode_id, $beasiswa_id)
    {
        // Display list of pengajuan for the selected beasiswa in the selected periode
        $pengajuans = Pengajuan::where('id_periode', $periode_id)
                                ->where('id_beasiswa', $beasiswa_id)
                                ->get();
        return view('pages.prodi.pengajuan.show-pengajuan-prodi', compact('pengajuans', 'periode_id', 'beasiswa_id'));
    }

    public function approve($id_user, $id_beasiswa, $id_periode)
    {
        // Find the submission and approve it
        $pengajuan = Pengajuan::where('id_user', $id_user)
                              ->where('id_beasiswa', $id_beasiswa)
                              ->where('id_periode', $id_periode)
                              ->firstOrFail();

        $pengajuan->status_1 = true; // Approved by prodi
        $pengajuan->save();

        return redirect()->back()->with('success', 'Submission approved successfully.');
    }

    public function reject($id_user, $id_beasiswa, $id_periode)
    {
        // Find the submission and reject it
        $pengajuan = Pengajuan::where('id_user', $id_user)
                              ->where('id_beasiswa', $id_beasiswa)
                              ->where('id_periode', $id_periode)
                              ->firstOrFail();

        $pengajuan->status_1 = false; // Rejected by prodi
        $pengajuan->save();

        return redirect()->back()->with('success', 'Submission rejected successfully.');
    }
}
