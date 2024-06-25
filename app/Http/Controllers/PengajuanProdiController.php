<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\PeriodeBeasiswa;
use App\Models\Beasiswa;
use App\Models\PengajuanDoc;

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

    public function viewDocuments($id_user, $id_beasiswa, $id_periode)
    {
        $periode = PeriodeBeasiswa::where('id_beasiswa','=',$id_beasiswa)->value('id_periode');
        $pengajuan = PengajuanDoc::where('id_beasiswa','=',$id_beasiswa)
            -> where('id_periode',$periode)
            -> where('id_user', $id_user)
            -> get();

        return view('pages.prodi.pengajuan.docs-pengajuan-prodi', compact('pengajuan'));
    }

    public function approve($id_user, $id_beasiswa, $id_periode)
    {
        $pengajuan = Pengajuan::where('id_user', $id_user)
                              ->where('id_beasiswa', $id_beasiswa)
                              ->where('id_periode', $id_periode)
                              ->firstOrFail();

        $pengajuan->status_1 = true; // Set status to approved
        $pengajuan->save();

        return redirect()->back()->with('success', 'Submission approved successfully.');
    }

    public function reject($id_user, $id_beasiswa, $id_periode)
    {
        $pengajuan = Pengajuan::where('id_user', $id_user)
                              ->where('id_beasiswa', $id_beasiswa)
                              ->where('id_periode', $id_periode)
                              ->firstOrFail();

        $pengajuan->status_1 = false; // Set status to rejected
        $pengajuan->save();

        return redirect()->back()->with('success', 'Submission rejected successfully.');
    }
}
