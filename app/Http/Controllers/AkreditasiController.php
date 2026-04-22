<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Programstudi;
use Illuminate\Http\Request;
use App\Models\Spmeakreditasi;


class AkreditasiController extends Controller
{
    public function GetAkreduniv(Request $request)
    {
        $akreditasiunivs = Spmeakreditasi::where('type', 3)->get();

        return view('pages.akreditasiuniv', ['akreditasiunivs' => $akreditasiunivs]);
    }

    public function GetAkredprodinasional(Request $request)
    {
        $akreditasinasionals = Spmeakreditasi::where('type', 1)->where('status', 1)->get();


        return view('pages.akreditasinasional', ['akreditasinasionals' => $akreditasinasionals]);
    }

    public function GetAkredprodiinternasional(Request $request)
    {
        $akreditasiinternasionals = Spmeakreditasi::where('type', 2)->where('status', 1)->get();

        return view('pages.akreditasiinternasional', ['akreditasiinternasionals' => $akreditasiinternasionals]);
    }

    public function GetAkred($id)
    {
        $programstudi = Programstudi::findOrFail($id);
        $akreditasis = Spmeakreditasi::where('programstudis_id', $id)->get();



        return view('pages.akreditasi', ['akreditasis' => $akreditasis, 'programstudi' => $programstudi]);
    }

    public function store(Request $request)
    {

        $akreditasi = new Spmeakreditasi;

        $request->validate([
            'berkas' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,txt,xls,xlsx|max:5120',
        ]);


        // public/uploads

        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('uploads/akreditasi/');
            $file->move($destinationPath, $filename);

            $akreditasi->berkas = 'uploads/akreditasi/' . $filename;
        }

        $akreditasi->programstudis_id = $request->programstudis_id;
        $akreditasi->no_sk = $request->no_sk;
        $akreditasi->tahun = $request->tahun;
        $akreditasi->masa_mulai = $request->masa_mulai;
        $akreditasi->masa_akhir = $request->masa_akhir;
        $akreditasi->akreditasi = $request->akreditasi;
        $akreditasi->skor = $request->skor;
        $akreditasi->type = $request->type;
        // $akreditasi->berkas = NULL;
        $akreditasi->lembaga = $request->lembaga;
        $akreditasi->keterangan = $request->keterangan;
        $akreditasi->updateby = session()->get('user')->username;
        $akreditasi->status = $request->status;
        $akreditasi->created_at = Carbon::now('Asia/Jakarta');
        $akreditasi->updated_at = NULL;

        $akreditasi->save();

        return redirect()->back()->with('success', 'Akreditasi created successfully!');
    }

    public function edit(Request $request)
    {

        $akreditasi = Spmeakreditasi::findOrFail($request->id);

        $request->validate([
            'berkas' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,txt,xls,xlsx|max:5120',
        ]);


        // public/uploads

        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('uploads/akreditasi/');
            $file->move($destinationPath, $filename);

            $akreditasi->berkas = 'uploads/akreditasi/' . $filename;
        }

        $akreditasi->programstudis_id = $request->programstudis_id;
        $akreditasi->no_sk = $request->no_sk;
        $akreditasi->tahun = $request->tahun;
        $akreditasi->masa_mulai = $request->masa_mulai;
        $akreditasi->masa_akhir = $request->masa_akhir;
        $akreditasi->akreditasi = $request->akreditasi;
        $akreditasi->skor = $request->skor;
        $akreditasi->type = $request->type;
        // $akreditasi->berkas = NULL;
        $akreditasi->lembaga = $request->lembaga;
        $akreditasi->keterangan = $request->keterangan;
        $akreditasi->updateby = session()->get('user')->username;
        $akreditasi->status = $request->status;
        $akreditasi->created_at = Carbon::now('Asia/Jakarta');
        $akreditasi->updated_at = NULL;

        $akreditasi->save();

        return redirect()->back()->with('success', 'Akreditasi created successfully!');
    }

    public function show($id)
    {
        return Spmeakreditasi::findOrFail($id);
    }

    public function destroy($id)
    {
        Spmeakreditasi::findOrFail($id)->delete();
        return back();
    }
}
