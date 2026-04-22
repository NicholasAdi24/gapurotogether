<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Strata;
use App\Models\Spmirtl;
use App\Models\Fakultas;
use App\Models\Userrole;
use App\Models\Spmielemen;
use App\Models\Spmiperiode;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Spmipenilaianprodi;
use Illuminate\Support\Facades\Session;
use App\Models\Spmipenilaianindikatorscalc;
use App\Models\Spmirtlprob;
use App\Models\Spmirtlsever;

class RtlController extends Controller
{
    public function rtlprodi(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where(['users_id' => $users->id, 'roles_id' => $request->input('roles_id')])->get();
        $spmiperiodes = Spmiperiode::all();
        $spmipenilaianprodis = Spmipenilaianprodi::where("programstudis_id", session('programstudi')->id)->get();



        return view("pagesprodi.periodertl", ['spmiperiodes' => $spmiperiodes, 'userroles' => $userroles, 'spmipenilaianprodis' => $spmipenilaianprodis]);
    }

    public function rtldetail($id)
    {

        $spmiperiodetahun = Spmiperiode::where('id', $id)->value('tahun'); // Ambil data tahun dari tabel spmi_periodes
        $spmielemens = Spmielemen::where('status', 1)->get();
        //dd($spmielemens);
        $penilaianProdi = Spmipenilaianprodi::where('programstudis_id', session()->get('programstudi')->id)
            ->where('tahun', $spmiperiodetahun)
            ->firstOrFail();

        // Get strata
        $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
        // $spmipenilaianprodi = Spmipenilaianprodi::where('tahun', $spmiperiodetahun)->where('programstudis_id', session()->get('programstudi')->id)->first();
        // $spmipenilaianindikatorcalc = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id',$spmipenilaianprodi->id)->get();

        Session::put('spmipenilaianprodi', $penilaianProdi->id);


        session(['rtldetail' => request()->fullUrl()]);

        return view("pagesprodi.rtldetail", ['spmielemens' => $spmielemens, 'spmiperiodetahun' => $spmiperiodetahun, 'penilaianprodi' => $penilaianProdi, 'strata' => $strata]);
    }

    public function rtlaction($id)
    {

        $spmipenilaianindikatorcalc = Spmipenilaianindikatorscalc::where('id', $id)->first();
        $spmirtl = Spmirtl::where('spmi_penilaianindikatorscalc_id', $spmipenilaianindikatorcalc->id)->first();
        //dd($spmielemens);
        $users = User::where('email', session()->get('user')->email)->first();
        $roleprodi = ($users && $users->id)
            ? Userrole::where('users_id', $users->id)
            ->where('roles_id', 9)
            ->exists()
            : false;

        $roledekan = ($users && $users->id)
            ? Userrole::where('users_id', $users->id)
            ->where('roles_id', 7)
            ->exists()
            : false;
        session(['rtlaction' => request()->fullUrl()]);
        $spmirtlprob = Spmirtlprob::where('status', 1)->get();
        $spmirtlsever = Spmirtlsever::where('status', 1)->get();
        return view("pagesprodi.rtlaction", ['spmipenilaianindikatorcalc' => $spmipenilaianindikatorcalc, 'spmirtl' => $spmirtl, 'roleprodi' => $roleprodi, 'roledekan' => $roledekan, 'spmirtlprob' => $spmirtlprob, 'spmirtlsever' => $spmirtlsever]);
    }

    public function rtlposts_store(Request $request)
    {

        try {
            $spmirtl = new Spmirtl;

            $request->validate([
                'bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,txt,xls,xlsx|max:10240',
            ]);


            // public/uploads

            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $filename = time() . '_rtl_' . $file->getClientOriginalName();

                $destinationPath = public_path('uploads/rtl/');
                $file->move($destinationPath, $filename);

                $spmirtl->bukti = 'uploads/rtl/' . $filename;
            }

            $spmirtl->spmi_penilaianindikatorscalc_id = $request->spmi_penilaianindikatorcalc_id;
            $spmirtl->program_kerja = $request->programkerja;
            $spmirtl->target = $request->target;
            $spmirtl->capaian = $request->capaian;
            $spmirtl->deskripsi_risiko = $request->deskripsi_risiko;
            $spmirtl->pengendalian = $request->pengendalian;
            $spmirtl->akar_masalah = $request->akar_masalah;
            $spmirtl->kategori_risiko = $request->kategori_risiko;
            $spmirtl->satuan = $request->satuan;
            $spmirtl->probability = $request->probability;
            $spmirtl->severity = $request->severity;
            $spmirtl->rtl = $request->rtl;
            $spmirtl->anggaran = $request->anggaran;
            $spmirtl->selesai = $request->target_selesai;
            $spmirtl->pic = $request->pic;
            if (session()->get('roles')->id == 9) {
                $spmirtl->persetujuan = 'Submission';
            }

            $spmirtl->status = 1;
            $spmirtl->save();

            return redirect()->back()->with('success', 'Post created successfully!');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withErrors(['errorPenilaianCalculate' => 'Gagal menghitung RTL']);
        }
    }

    public function rtlposts_update(Request $request, $id)
    {
        try {
            $spmirtl = Spmirtl::findOrFail($id);

            $request->validate([
                'bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,txt,xls,xlsx|max:10240',
            ]);


            // public/uploads
            if (!$request->roledekan) {


                if ($request->hasFile('bukti')) {
                    $file = $request->file('bukti');
                    $filename = time() . '_rtl_' . $file->getClientOriginalName();

                    $destinationPath = public_path('uploads/rtl/');
                    $file->move($destinationPath, $filename);

                    $spmirtl->bukti = 'uploads/rtl/' . $filename;
                }

                $spmirtl->spmi_penilaianindikatorscalc_id = $request->spmi_penilaianindikatorcalc_id;
                $spmirtl->program_kerja = $request->programkerja;
                $spmirtl->target = $request->target;
                $spmirtl->capaian = $request->capaian;
                $spmirtl->deskripsi_risiko = $request->deskripsi_risiko;
                $spmirtl->pengendalian = $request->pengendalian;
                $spmirtl->akar_masalah = $request->akar_masalah;
                $spmirtl->kategori_risiko = $request->kategori_risiko;
                $spmirtl->satuan = $request->satuan;
                $spmirtl->probability = $request->probability;
                $spmirtl->severity = $request->severity;
                $spmirtl->rtl = $request->rtl;
                $spmirtl->anggaran = $request->anggaran;
                $spmirtl->selesai = $request->target_selesai;
                $spmirtl->pic = $request->pic;
                if (session()->get('roles')->id == 9) {
                    $spmirtl->persetujuan = 'Submission';
                }
                $spmirtl->status = 1;
                $spmirtl->save();
            } else {
                $spmirtl->persetujuan = $request->persetujuan;
                $spmirtl->save();
            }

            return redirect()->back()->with('success', 'Post created successfully!');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withErrors(['errorPenilaianCalculate' => 'Gagal menghitung RTL']);
        }
    }

    public function laporangenerate_rtl(Request $request)
    {

        // Ambil user dan program studi dari session
        $user = User::where('email', session('user')->email)->firstOrFail();
        $programStudiId = session('programstudi')->id;
        $spmielemens = Spmielemen::where('status', 1)->get();
        $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();


        $nama_programstudi = session('programstudi')->nama_prodi;
        $fakultas = Fakultas::findOrFail(session('programstudi')->fakultass_id);


        $penilaianprodi = Spmipenilaianprodi::where('id', session()->get('spmipenilaianprodi'))
            ->firstOrFail();

        $spmipenilaianindikatorcalcs = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianprodi->id)->get();

        $tahun = $penilaianprodi->tahun;


        $pdf = Pdf::loadView('pagesprodi/rtlcetak', compact(
            'tahun',
            'nama_programstudi',
            'penilaianprodi',
            'fakultas',
            'spmipenilaianindikatorcalcs',
            'spmielemens',
            'strata',
        ))->setPaper('a4', 'landscape');

        return $pdf->stream('laporan RTL.pdf');
    }
}
