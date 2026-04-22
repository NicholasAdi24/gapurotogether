<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Spmielemen;
use App\Models\Spmiperiode;
use App\Services\C2Service;
use App\Services\C3Service;
use App\Services\C4Service;
use App\Services\C5Service;
use App\Services\C6Service;
use App\Services\C7Service;
use App\Services\C8Service;
use App\Services\C9Service;
// use App\Models\Spmipenilaianindikatorsub;
use Illuminate\Http\Request;
use App\Models\Spmiindikator;
use App\Models\Spmiindikatorsub;
use App\Models\Spmipenilaianprodi;
use App\Models\Spmiindikatorkomponen;
use App\Models\Spmipenilaianindikator;
use App\Models\Spmipindikatorkomponen;
use App\Models\Spmikategorijenistemuan;
use App\Models\User;
use App\Models\Userrole;
use App\Models\Userprogramstudi;
use App\Models\Spmipenilaianindikatorscalc;


class ProdiController extends Controller
{
    protected $c2;
    protected $c3;
    protected $c4;
    protected $c5;
    protected $c6;
    protected $c7;
    protected $c8;
    protected $c9;

    public function __construct(
        C2Service $c2,
        C3Service $c3,
        C4Service $c4,
        C5Service $c5,
        C6Service $c6,
        C7Service $c7,
        C8Service $c8,
        C9Service $c9,
    ) {
        $this->c2 = $c2;
        $this->c3 = $c3;
        $this->c4 = $c4;
        $this->c5 = $c5;
        $this->c6 = $c6;
        $this->c7 = $c7;
        $this->c8 = $c8;
        $this->c9 = $c9;
    }

    public function kalkulasiprodi(Request $request)
    {
        $spmi_penilaianprodis_id = $request->input('spmi_penilaianprodis_id');
        $jumlahhasilprodi = $request->input('jumlahhasilprodi');
        $programstudi_id = $request->input('programstudi');
        $spmi_periodes_id = $request->input('spmi_periodes_id');

        $data = Spmipenilaianprodi::where('id', $spmi_penilaianprodis_id)
            ->where('spmi_periodes_id', $spmi_periodes_id)
            ->where('programstudis_id', $programstudi_id)
            ->first();

        if ($data) {
            // Update nilai_prodi_final
            $data->nilai_prodi_final = $jumlahhasilprodi;
            $data->status = 2;
            $data->save();

            Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)
                ->update(['status' => 2]);

            return redirect()->back()->with('success', 'Data kalkulasi berhasil ditambah!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }

    public function kuncinilaiprodi(Request $request)
    {
        $spmi_penilaianprodis_id = $request->input('spmi_penilaianprodis_id');
        $programstudi_id = $request->input('programstudi');
        $spmi_periodes_id = $request->input('spmi_periodes_id');

        $data = Spmipenilaianprodi::where('id', $spmi_penilaianprodis_id)
            ->where('spmi_periodes_id', $spmi_periodes_id)
            ->where('programstudis_id', $programstudi_id)
            ->first();

        if ($data) {
            $data->status = 3;
            $data->save();

            Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)
                ->update(['status' => 3]);

            return redirect()->back()->with('success', 'Data penilaian berhasil dikunci!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }

    public function bukakuncinilaiprodi(Request $request)
    {
        $spmi_penilaianprodis_id = $request->input('spmi_penilaianprodis_id');
        $programstudi_id = $request->input('programstudi');
        $spmi_periodes_id = $request->input('spmi_periodes_id');

        $data = Spmipenilaianprodi::where('id', $spmi_penilaianprodis_id)
            ->where('spmi_periodes_id', $spmi_periodes_id)
            ->where('programstudis_id', $programstudi_id)
            ->first();

        if ($data) {
            $data->status = 2;
            $data->save();

            Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)
                ->update(['status' => 2]);

            return redirect()->back()->with('success', 'Data penilaian berhasil dibuka kunci!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }
}
