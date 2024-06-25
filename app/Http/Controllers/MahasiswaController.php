<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\PengajuanDoc;
use App\Models\PeriodeBeasiswa;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Beasiswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    public function welcome()
    {
        $User = Auth::user();

        // $file_path = PengajuanDoc::all();

        return view('pages.user.index-user', compact('User'));
    }

    public function beasiswa()
    {
        $id_beasiswa = PeriodeBeasiswa::where('end_date', '>=', Carbon::today())
            ->pluck('id_beasiswa')
            ->toArray();
        $beasiswa = Beasiswa::whereIn('id_beasiswa',$id_beasiswa)
            ->get();

        return view('pages.user.beasiswa-user', compact('beasiswa'));
    }

    public function validateInput($id_beasiswa){
        $User = Auth::user();
        $id_user = $User -> id;
        $periode = PeriodeBeasiswa::where('id_beasiswa','=',$id_beasiswa)->value('id_periode');
        $exists = Pengajuan::where('id_beasiswa', $id_beasiswa)
            ->where('id_periode', $periode)
            ->where('id_user', $id_user)
            ->exists();

        if ($exists){
            return redirect()->route('mahasiswa.beasiswa');
        }else{
            return redirect()->route('pengajuan.beasiswa',[$id_beasiswa]);
        }
    }

    public function pengajuan($id_beasiswa){
        $beasiswas = Beasiswa::where('id_beasiswa','=',$id_beasiswa)->get();
        return view('pages.user.pengajuan-user', compact('beasiswas'));
    }

    public function store(Request $request){

        $request->validate([
            'id_beasiswa' => 'required|integer',
            'ipk' => 'required|string',
            'poinporto' => 'required|integer',
            'dkbs' => 'required|file|mimes:pdf,doc,docx,png', // Example file validation
            'surat_rekom' => 'required|file|mimes:pdf,doc,docx,png', // Example file validation
            'surat_pernyataan' => 'required|file|mimes:pdf,doc,docx,png', // Example file validation
        ]);
//
        $periode = PeriodeBeasiswa::where('id_beasiswa', $request->id_beasiswa)
            ->value('id_periode');

        $User = Auth::user();
        $name = $User -> nrp;
        $id_user = $User -> id;
        $date = Carbon::now()->toDateString();
        $dirname = $name.'_'.$date;
        Storage::disk('public')->makeDirectory($dirname);

        $dkbs = $request->file('dkbs');
        $suratrekom = $request->file('surat_rekom');
        $suratpernyataan = $request->file('surat_pernyataan');

        $dkbsPath = $dkbs->storeAs($dirname, $dkbs->getClientOriginalName() , 'public');
        $suratRekomPath = $suratrekom->storeAs($dirname,$suratrekom->getClientOriginalName(),'public');
        $suratPernyataanPath = $suratpernyataan->storeAs($dirname,$suratpernyataan->getClientOriginalName() ,'public');
//
        $pengajuan = new Pengajuan();
        $pengajuan->id_user = $id_user;
        $pengajuan->id_beasiswa = $request->id_beasiswa;
        $pengajuan->id_periode = $periode;
        $pengajuan->ipk = $request->ipk;
        $pengajuan->poin_portofolio = $request->poinporto;
        $pengajuan->status_1 = NULL;
        $pengajuan->status_2 = NULL;
        $pengajuan->save();

        $pengajuan_doc = new PengajuanDoc();
        $pengajuan_doc->id_user = $id_user;
        $pengajuan_doc->id_beasiswa = $request->id_beasiswa;
        $pengajuan_doc->id_periode = $periode;
        $pengajuan_doc->dkbs = $dkbsPath;
        $pengajuan_doc->surat_rekom = $suratRekomPath;
        $pengajuan_doc->surat_pernyataan = $suratPernyataanPath;
        $pengajuan_doc->save();



        return redirect()->route('mahasiswa.beasiswa');
    }
    public function validatePengajuan($id_beasiswa){
        $User = Auth::user();
        $id_user = $User -> id;
        $periode = PeriodeBeasiswa::where('id_beasiswa','=',$id_beasiswa)->value('id_periode');
        $exists = Pengajuan::where('id_beasiswa', $id_beasiswa)
            ->where('id_periode', $periode)
            ->where('id_user', $id_user)
            ->exists();

        if ($exists){
            return redirect()->route('edit.pengajuan',[$id_beasiswa]);
        }else{
            return redirect()->route('mahasiswa.beasiswa');
        }
    }
    public function editPengajuan($id_beasiswa){
        $User = Auth::user();
        $id_user = $User -> id;
        $periode = PeriodeBeasiswa::where('id_beasiswa','=',$id_beasiswa)->value('id_periode');
        $pengajuan = PengajuanDoc::where('id_beasiswa','=',$id_beasiswa)
            -> where('id_periode',$periode)
            -> where('id_user', $id_user)
            -> get();
        $beasiswas = Beasiswa::where('id_beasiswa','=',$id_beasiswa)->get();
        return view('pages.user.edit-pengajuan-user', compact('beasiswas','pengajuan'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'id_beasiswa' => 'required|integer',
            'ipk' => 'nullable|string',
            'poinporto' => 'nullable|integer',
            'dkbs' => 'nullable|file|mimes:pdf,doc,docx,png',
            'surat_rekom' => 'nullable|file|mimes:pdf,doc,docx,png',
            'surat_pernyataan' => 'nullable|file|mimes:pdf,doc,docx,png',
        ]);

        $periode = PeriodeBeasiswa::where('id_beasiswa', $request->id_beasiswa)
            ->value('id_periode');

        $User = Auth::user();
        $id_user = $User->id;

        $pengajuan = Pengajuan::where('id_beasiswa', '=', $request->id_beasiswa)
            ->where('id_periode', $periode)
            ->where('id_user', $id_user)
            ->first();

        if ($request->ipk != null) {
            $pengajuan->ipk = $request->ipk;
        }

        if ($request-> poinporto != null) {
           $pengajuan->poin_portofolio = $request->poinporto;
        }

        // Save changes only if there are updates
        if ($request->ipk != null || $request->ipk != null) {
            $pengajuan->update();
        }
        if ($request->has('dkbs') || $request->has('surat_rekom') || $request->has('surat_pernyataan')) {
        $pengajuan_doc = PengajuanDoc::where('id_beasiswa', '=', $request->id_beasiswa)
            ->where('id_periode', $periode)
            ->where('id_user', $id_user)
            ->first();

        $dkbspath = pathinfo($pengajuan_doc->dkbs);
        $folderName = $dkbspath['dirname'];
         // Or use a different naming convention
    
        

        //Handle file uploads
        if ($request->dkbs != null) {
            if ($pengajuan_doc->dkbs) {
                $dkbs = $request->file('dkbs')->getClientOriginalName();
                Storage::disk('public')->delete($pengajuan_doc->dkbs);
            }
            $pengajuan_doc->dkbs = $request->file('dkbs')->storeAs($folderName, $dkbs, 'public');
        }

        if ($request->surat_rekom != null) {
            if ($pengajuan_doc->surat_rekom) {
                $suratrekom = $request->file('surat_rekom')->getClientOriginalName();
                Storage::disk('public')->delete($pengajuan_doc->surat_rekom);
            }
            $pengajuan_doc->surat_rekom = $request->file('surat_rekom')->storeAs($folderName, $suratrekom, 'public');
        }

        if ($request->surat_pernyataan != null) {
            if ($pengajuan_doc->surat_pernyataan) {
                $suratpernyataan = $request->file('surat_pernyataan')->getClientOriginalName();
                Storage::disk('public')->delete($pengajuan_doc->surat_pernyataan);
            }
            $pengajuan_doc->surat_pernyataan = $request->file('surat_pernyataan')->storeAs($folderName, $suratpernyataan, 'public');
        }

        
            $pengajuan_doc->update();
        }
        return redirect()->route('mahasiswa.beasiswa');
    }

    public function VerifyDestroy(Request $request, $id_beasiswa)
    {
        $periode = PeriodeBeasiswa::where('id_beasiswa', $request->id_beasiswa)
            ->value('id_periode');

        // Get the authenticated user
        $User = Auth::user();
        $id_user = $User->id;
        $beasiswa = Beasiswa::where('id_beasiswa','=',$id_beasiswa)->first();
        // Find the Pengajuan entry
        $pengajuan = Pengajuan::where('id_beasiswa', $id_beasiswa)
            ->where('id_user', $id_user)
            ->where('id_periode',$periode)
            ->first();

        // Verify that the Pengajuan entry exists
        if ($pengajuan){
            // Set flash data for confirmation
            Session::flash('confirm-delete', [
                'id_beasiswa' => $pengajuan->id_beasiswa,
                'jenis_beasiswa' => $beasiswa->jenis_beasiswa,
            ]);


            return redirect()->route('mahasiswa.beasiswa');
        }else{
            return redirect()->route('mahasiswa.beasiswa');
        }

    }

    public function destroy($id_beasiswa){
        $periode = PeriodeBeasiswa::where('id_beasiswa', $id_beasiswa)
            ->value('id_periode');

        $User = Auth::user();
        $id_user = $User->id;

        $pengajuan = Pengajuan::where('id_beasiswa', $id_beasiswa)
            ->where('id_user', $id_user)
            ->where('id_periode',$periode)
            ->first();

        $pengajuan_doc = PengajuanDoc::where('id_beasiswa', '=', $id_beasiswa)
            ->where('id_periode', $periode)
            ->where('id_user', $id_user)
            ->first();

        $dkbspath = pathinfo($pengajuan_doc->dkbs);
        $folderName = $dkbspath['dirname'];
        $folderpath = 'public/'.$folderName;
        Storage::deleteDirectory($folderpath);

        // Delete the Pengajuan entry
        $pengajuan_doc->delete();
        $pengajuan->delete();

        return redirect()->back();
    }
}
