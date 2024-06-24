<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;

class PengajuanFakultasController extends Controller
{
    public function index()
    {
        // Get all submissions approved by prodi
        $pengajuans = Pengajuan::where('status_1', true)->get();
        return view('fakultas.pengajuan.index', compact('pengajuans'));
    }

    public function approve($id_user, $id_beasiswa, $id_periode)
    {
        // Find the submission and approve it
        $pengajuan = Pengajuan::where('id_user', $id_user)
                              ->where('id_beasiswa', $id_beasiswa)
                              ->where('id_periode', $id_periode)
                              ->firstOrFail();

        $pengajuan->status_2 = true; // Approved by fakultas
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

        $pengajuan->status_2 = false; // Rejected by fakultas
        $pengajuan->save();

        return redirect()->back()->with('success', 'Submission rejected successfully.');
    }
}
