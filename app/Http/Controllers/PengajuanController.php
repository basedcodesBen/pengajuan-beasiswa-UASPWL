<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\PengajuanDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with('pengajuanDocs')->get();

        // Separate submissions for prodi and fakultas
        $user = Auth::user();
        if ($user->role == 'Prodi') {
            $pengajuans = Pengajuan::where('status_1', false)->get();
        } elseif ($user->role == 'Fakultas') {
            $pengajuans = Pengajuan::where('status_1', true)->where('status_2', false)->get();
        }

        return view('pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
        $pengajuanDocs = PengajuanDoc::all();
        return view('pengajuan.create', compact('pengajuanDocs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_beasiswa' => 'required',
            'id_periode' => 'required',
            'ipk' => 'required|string',
            'poin_portofolio' => 'required|integer',
            'status_1' => 'boolean',
            'status_2' => 'boolean',
            'pengajuan_doc_id' => 'required|array',
            'pengajuan_doc_id.*' => 'exists:pengajuan_doc,pengajuan_doc_id',
            'file_path' => 'required|array',
            'file_path.*' => 'required|string',
        ]);

        $pengajuan = Pengajuan::create($request->only([
            'id_user', 'id_beasiswa', 'id_periode', 'ipk', 'poin_portofolio',
        ]));

        foreach ($request->pengajuan_doc_id as $index => $pengajuanDocId) {
            $pengajuan->pengajuanDocs()->attach($pengajuanDocId, [
                'file_path' => $request->file_path[$index],
            ]);
        }

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan created successfully.');
    }

    public function edit(Pengajuan $pengajuan)
    {
        $pengajuanDocs = PengajuanDoc::all();
        return view('pengajuan.edit', compact('pengajuan', 'pengajuanDocs'));
    }

    public function update(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'ipk' => 'required|string',
            'poin_portofolio' => 'required|integer',
            'status_1' => 'required|boolean',
            'status_2' => 'required|boolean',
            'pengajuan_doc_id' => 'required|array',
            'pengajuan_doc_id.*' => 'exists:pengajuan_doc,pengajuan_doc_id',
            'file_path' => 'required|array',
            'file_path.*' => 'required|string',
        ]);

        $pengajuan->update($request->only(['ipk', 'poin_portofolio', 'status_1', 'status_2']));

        // Sync the relationships with new data
        $pengajuan->pengajuanDocs()->detach();
        foreach ($request->pengajuan_doc_id as $index => $pengajuanDocId) {
            $pengajuan->pengajuanDocs()->attach($pengajuanDocId, [
                'file_path' => $request->file_path[$index],
            ]);
        }

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan updated successfully.');
    }

    public function destroy(Pengajuan $pengajuan)
    {
        $pengajuan->pengajuanDocs()->detach(); // Remove all related docs
        $pengajuan->delete();

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan deleted successfully.');
    }

    public function approve($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $user = Auth::user();
        if ($user->role == 'Prodi') {
            $pengajuan->status_1 = true;
            $pengajuan->save();
            return redirect()->route('pengajuan.index')->with('success', 'Submission approved by Prodi.');
        } elseif ($user->role == 'Fakultas' && $pengajuan->status_1) {
            $pengajuan->status_2 = true;
            $pengajuan->save();
            return redirect()->route('pengajuan.index')->with('success', 'Submission approved by Fakultas.');
        }

        return redirect()->route('pengajuan.index')->with('error', 'You are not authorized to approve this submission.');
    }

    public function reject($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $user = Auth::user();
        if ($user->role == 'Prodi') {
            $pengajuan->status_1 = false;
            $pengajuan->save();
            return redirect()->route('pengajuan.index')->with('success', 'Submission rejected by Prodi.');
        } elseif ($user->role == 'Fakultas' && $pengajuan->status_1) {
            $pengajuan->status_2 = false;
            $pengajuan->save();
            return redirect()->route('pengajuan.index')->with('success', 'Submission rejected by Fakultas.');
        }

        return redirect()->route('pengajuan.index')->with('error', 'You are not authorized to reject this submission.');
    }

}
