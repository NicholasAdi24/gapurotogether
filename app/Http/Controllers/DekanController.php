<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Programstudi;
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
use App\Models\Usersfakultas;
use App\Models\Userprogramstudi;
use App\Models\Spmipenilaianindikatorscalc;


class DekanController extends Controller
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

    public function validasidekanwadek(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where('users_id', $users->id)->get();

        $spmiperiodes = Spmiperiode::where('status', 1)->get();
        $fakultasIds = Usersfakultas::where('users_id', $users->id)
            ->pluck('fakultas_id');
        $fakultas_id = $fakultasIds->first();
        $programstudiIds = Programstudi::whereIn('fakultass_id', $fakultasIds)->pluck('id');
        $data = Programstudi::with([
            'spmipenilaianprodi' => function ($query) {
                $query->with('spmiperiode');
            }
        ])
            ->whereIn('fakultass_id', $fakultasIds)
            ->paginate(10)
            ->appends($request->query());


        return view('validasidekanwadek', compact('userroles', 'users', 'spmiperiodes', 'fakultas_id', 'data'));
    }

    public function penjaminanmutuprodidekan(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required|exists:programstudis,id'
        ]);

        $users = User::where('email', session()->get('user')->email)->first();

        $userroles = Userrole::where([
            'users_id' => $users->id,
            'roles_id' => session('roles')->id,
        ])->get();

        $spmiperiodes = Spmiperiode::all();

        $programstudi = Programstudi::find($request->input('prodi_id'));

        if (!$programstudi) {
            abort(400, 'Program Studi tidak ditemukan atau prodi_id tidak dikirim.');
        }

        $request->session()->put('programstudi', $programstudi);

        $spmipenilaianprodis = Spmipenilaianprodi::where("programstudis_id", $programstudi->id)->get();

        return view('pagesprodi.periode', [
            'spmiperiodes' => $spmiperiodes,
            'userroles' => $userroles,
            'programStudi' => $programstudi,
            'spmipenilaianprodis' => $spmipenilaianprodis
        ]);
    }

    public function validasiseluruhprodidekan(Request $request)
    {
        $request->validate([
            'spmi_periodes_id' => 'required|exists:spmi_periodes,id',
            'fakultas_id' => 'required|exists:fakultass,id'
        ]);

        $spmiPeriodeId = $request->input('spmi_periodes_id');
        $fakultasId = $request->input('fakultas_id');

        $programStudiIds = Programstudi::where('fakultass_id', $fakultasId)->pluck('id');

        $cekProdisudahdiKunci = Spmipenilaianprodi::whereIn('programstudis_id', $programStudiIds)
            ->where('spmi_periodes_id', $spmiPeriodeId)
            ->where('status', 4)
            ->get();

        $cekProdisudahdiKunciId = $cekProdisudahdiKunci->pluck('id');

        $updatedRows = Spmipenilaianprodi::whereIn('id', $cekProdisudahdiKunciId)
            ->update(['status' => 5]);

        $updatedCalc = Spmipenilaianindikatorscalc::whereIn('spmi_penilaianprodis_id', $cekProdisudahdiKunciId)
            ->update(['status' => 5]);

        if ($updatedRows > 0) {
            session()->put('suksesvalidasiseluruhprodidekan', 'Validasi berhasil! Semua prodi pada fakultas ini di periode SPMI terpilih telah divalidasi.');
        } else {
            session()->put('gagalvalidasiseluruhprodidekan', 'Gagal validasi! Tidak ada data penilaian ditemukan untuk fakultas ini di periode yang dipilih.');
        }

        return redirect()->back();
    }

    public function validasisatuandekan(Request $request)
    {
        $spmipenilaianindikatorcalc = Spmipenilaianindikatorscalc::where([
            'spmi_penilaianprodis_id' => $request->input('spmi_penilaianprodis_id'),
            'spmi_indikators_id' => $request->input('spmi_indikators_id')
        ])->first();

        if ($spmipenilaianindikatorcalc) {
            $spmipenilaianindikatorcalc->status = 5;
            $spmipenilaianindikatorcalc->save();
        } else {
            // Jika tidak ada, insert baru
            Spmipenilaianindikatorscalc::create([
                'spmi_penilaianprodis_id' => $request->input('spmi_penilaianprodis_id'),
                'spmi_indikators_id' => $request->input('spmi_indikators_id'),
                'status' => 5
            ]);
        }

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function validasisatuanbataldekan(Request $request)
    {
        $spmipenilaianindikatorcalc = Spmipenilaianindikatorscalc::where([
            'spmi_penilaianprodis_id' => $request->input('spmi_penilaianprodis_id'),
            'spmi_indikators_id' => $request->input('spmi_indikators_id')
        ])->first();

        if ($spmipenilaianindikatorcalc) {
            $spmipenilaianindikatorcalc->status = 4;
            $spmipenilaianindikatorcalc->save();
        } else {
            // Jika tidak ada, insert baru
            Spmipenilaianindikatorscalc::create([
                'spmi_penilaianprodis_id' => $request->input('spmi_penilaianprodis_id'),
                'spmi_indikators_id' => $request->input('spmi_indikators_id'),
                'status' => 4
            ]);
        }

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function validasisemuadekan(Request $request)
    {
        $spmi_penilaianprodis_id = $request->input('spmi_penilaianprodis_id');
        $spmi_indikators_ids = $request->input('spmi_indikators_id'); // ini array dari input
        $programstudi_id = $request->input('programstudi');
        $spmi_periodes_id = $request->input('spmi_periodes_id');

        // Loop semua spmi_indikators_id
        foreach ($spmi_indikators_ids as $spmi_indikators_id) {
            // Update atau insert ke Spmipenilaianindikatorscalc
            $spmipenilaianindikatorcalc = Spmipenilaianindikatorscalc::where([
                'spmi_penilaianprodis_id' => $spmi_penilaianprodis_id,
                'spmi_indikators_id' => $spmi_indikators_id
            ])->first();

            if ($spmipenilaianindikatorcalc) {
                // Update status ke 5
                $spmipenilaianindikatorcalc->status = 5;
                $spmipenilaianindikatorcalc->save();
            } else {
                // Insert baru
                Spmipenilaianindikatorscalc::create([
                    'spmi_penilaianprodis_id' => $spmi_penilaianprodis_id,
                    'spmi_indikators_id' => $spmi_indikators_id,
                    'status' => 5
                ]);
            }
        }

        // Setelah semua indikator diproses, update/insert ke Spmipenilaianprodi
        $spmipenilaianprodi = Spmipenilaianprodi::where([
            'programstudis_id' => $programstudi_id,
            'spmi_periodes_id' => $spmi_periodes_id
        ])->first();

        if ($spmipenilaianprodi) {
            $spmipenilaianprodi->status = 5;
            $spmipenilaianprodi->save();
        } else {
            // Insert baru
            Spmipenilaianprodi::create([
                'programstudis_id' => $programstudi_id,
                'spmi_periodes_id' => $spmi_periodes_id,
                'status' => 5
            ]);
        }

        return redirect()->back()->with('success', 'Semua indikator berhasil divalidasi!');
    }

    public function validasisemuabataldekan(Request $request)
    {
        $spmi_penilaianprodis_id = $request->input('spmi_penilaianprodis_id');
        $spmi_indikators_ids = $request->input('spmi_indikators_id'); // ini array dari input
        $programstudi_id = $request->input('programstudi');
        $spmi_periodes_id = $request->input('spmi_periodes_id');

        // Loop semua spmi_indikators_id
        foreach ($spmi_indikators_ids as $spmi_indikators_id) {
            // Update atau insert ke Spmipenilaianindikatorscalc
            $spmipenilaianindikatorcalc = Spmipenilaianindikatorscalc::where([
                'spmi_penilaianprodis_id' => $spmi_penilaianprodis_id,
                'spmi_indikators_id' => $spmi_indikators_id
            ])->first();

            if ($spmipenilaianindikatorcalc) {
                // Update status ke 4
                $spmipenilaianindikatorcalc->status = 4;
                $spmipenilaianindikatorcalc->save();
            } else {
                // Insert baru
                Spmipenilaianindikatorscalc::create([
                    'spmi_penilaianprodis_id' => $spmi_penilaianprodis_id,
                    'spmi_indikators_id' => $spmi_indikators_id,
                    'status' => 4
                ]);
            }
        }

        // Setelah semua indikator diproses, update/insert ke Spmipenilaianprodi
        $spmipenilaianprodi = Spmipenilaianprodi::where([
            'programstudis_id' => $programstudi_id,
            'spmi_periodes_id' => $spmi_periodes_id
        ])->first();

        if ($spmipenilaianprodi) {
            $spmipenilaianprodi->status = 4;
            $spmipenilaianprodi->save();
        } else {
            // Insert baru
            Spmipenilaianprodi::create([
                'programstudis_id' => $programstudi_id,
                'spmi_periodes_id' => $spmi_periodes_id,
                'status' => 4
            ]);
        }

        return redirect()->back()->with('success', 'Semua indikator berhasil divalidasi!');
    }
}
