<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Programstudi;
use Illuminate\Http\Request;
use App\Models\Dokumen;


class DokumenController extends Controller
{
    public function Getdokumen(Request $request)
    {
        $dokumens = Dokumen::All();

        return view('pages.dokumen', ['dokumens' => $dokumens]);
    }

    public function Getprodidokumen(Request $request)
    {
        $dokumens = Dokumen::where('status', 1)->get();

        return view('pagesprodi.dokumen', ['dokumens' => $dokumens]);
    }

    public function store(Request $request)
    {

        $dokumen = new Dokumen;


        $request->validate([
            'berkas' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,txt,xls,xlsx|max:10240',
        ]);


        // public/uploads

        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('uploads/dokumen/');
            $file->move($destinationPath, $filename);

            $dokumen->berkas = 'uploads/dokumen/' . $filename;
        }


        $dokumen->nama = $request->nama;
        $dokumen->kategori = $request->kategori;
        $dokumen->type = $request->type;
        // $dokumen->berkas = NULL;
        $dokumen->keterangan = $request->keterangan;
        $dokumen->updateby = session()->get('user')->username;
        $dokumen->status = $request->status;
        $dokumen->created_at = Carbon::now('Asia/Jakarta');
        $dokumen->updated_at = NULL;

        $dokumen->save();

        return redirect()->back()->with('success', 'Dokumen created successfully!');
    }

    public function edit(Request $request)
    {

        $dokumen = Dokumen::findOrFail($request->id);


        $request->validate([
            'berkas' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,txt,xls,xlsx|max:10240',
        ]);


        // public/uploads

        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('uploads/dokumen/');
            $file->move($destinationPath, $filename);

            $dokumen->berkas = 'uploads/dokumen/' . $filename;
        }


        $dokumen->nama = $request->nama;
        $dokumen->kategori = $request->kategori;
        $dokumen->type = $request->type;
        // $dokumen->berkas = NULL;
        $dokumen->keterangan = $request->keterangan;
        $dokumen->updateby = session()->get('user')->username;
        $dokumen->status = $request->status;
        $dokumen->created_at = Carbon::now('Asia/Jakarta');
        $dokumen->updated_at = NULL;

        $dokumen->save();

        return redirect()->back()->with('success', 'Dokumen created successfully!');
    }

    public function destroy($id)
    {
        Dokumen::findOrFail($id)->delete();
        return back();
    }

    public function show($id)
    {
        return Dokumen::findOrFail($id);
    }
}
