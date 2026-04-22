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
use App\Models\Userprogramstudi;
use App\Models\Spmipenilaianindikatorscalc;


class KapusSpmiController extends Controller
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

    public function pembukaansesiaudit(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where('users_id', $users->id)->get();

        $programstudis = Programstudi::all();

        $spmiPeriodes = Spmiperiode::all();


        return view('pembukaansesiaudit', compact(
            'programstudis',
            'spmiPeriodes',
            'userroles'
        ));

        // [
        //     'programstudis' => $programstudis,
        //     'spmiPeriodes'  => $spmiPeriodes
        // ]
    }

    public function sesiauditdibuka(Request $request)
    {

        $request->validate([
            'spmi_periode' => 'required|exists:spmi_periodes,id',
            'tahun' => 'required|integer'
        ]);

        $spmiPeriodeId = $request->input('spmi_periode');

        $tahun = $request->input('tahun');


        $programstudiIds = Programstudi::pluck('id');


        for ($i = 1; $i <= Programstudi::count(); $i++) {
            Spmipenilaianprodi::create([
                'programstudis_id'      => $i,
                'spmi_periodes_id'      => $spmiPeriodeId,
                'lembagas_id'           => 1,
                'tahun'                 => $tahun,
                'nilai_prodi_final'     => 0,
                'nilai_auditor_final'   => 0,
                'skor_final'            => 0,
                'status'                => 0,
                'created_at'            => now(),
                'updated_at'            => now(),
                'auditor_id'            => 0
            ]);
        }

        Spmiperiode::where('id', $spmiPeriodeId)->update([
            'status' => 1
        ]);

        return redirect()->back()->with('success', 'Sesi audit berhasil dibuka untuk seluruh program studi.');
    }


    // public function penugasanauditormenu(Request $request) Cadangan
    public function penugasanauditormenu(Request $request)
    {
        $spmiperiodes = Spmiperiode::all();


        //dd($spmiperiodes);
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where('users_id', $users->id)->get();
        $usersrolesauditor   = Userrole::with(['getUser', 'getRole'])
            ->where('roles_id', 12)
            ->get();


        $periodeId = $request->query('periode');
        $periode = Spmiperiode::find($periodeId);
        if ($periode) {
            $periodeTahun = $periode->tahun;
            $periodeStatus = [5, 6]; // TELAH DIVALIDASI OLEH DEKAN || PROSES DIAUDIT

            $programstudis = Spmipenilaianprodi::with('programstudi')
                ->where('spmi_periodes_id', $periodeId)
                ->where('tahun', $periodeTahun)
                ->whereIn('status', $periodeStatus)
                ->get();
        } else {
            $programstudis = collect();
        }



        $selectedProdi       = $request->query('program')
            ?? old('programstudis_id')
            ?? null;


        $assignedAuditors    = [];
        if ($selectedProdi) {
            $assignedAuditors = Userprogramstudi::where('programstudis_id', $selectedProdi)
                ->pluck('users_id')
                ->toArray();
        }

        $usersprogramstudis = Userprogramstudi::query()
            // join ke programstudis untuk nama prodi
            ->join('programstudis', 'users_programstudis.programstudis_id', '=', 'programstudis.id')
            // join ke users untuk nama user
            ->join('users', 'users_programstudis.users_id', '=', 'users.id')
            // join ke users_roles hanya untuk roles_id = 12
            ->join('users_roles', function ($join) {
                $join->on('users.id', '=', 'users_roles.users_id')
                    ->where('users_roles.roles_id', 12);
            })
            // pilih kolom yang dibutuhkan
            ->select([
                'users_programstudis.*',
                'users.name as user_name',
                'programstudis.nama_prodi',
            ])
            ->get();

        //dd($programstudis);
        // return view("chooserole",['userroles' => $userroles]);
        return view('penugasanauditor', compact(
            'spmiperiodes',
            'users',
            'userroles',
            'usersrolesauditor',
            'programstudis',
            'selectedProdi',
            'assignedAuditors',
            'usersprogramstudis'
        ));
    }


    public function penugasanauditorpilih(Request $request)
    {
        // Ambil periode dari query string (?periode=...)
        $periodeId = $request->query('periode');
        $periode = Spmiperiode::find($periodeId);

        if (!$periode) {
            return back()->with('error', 'Periode tidak ditemukan.');
        }

        $currentYear = $periode->tahun;

        // Validasi input lain
        $data = $request->validate([
            'programstudis_id' => 'required|integer|exists:programstudis,id',
            'auditor_id_1'     => 'required|integer|exists:users,id',
            'auditor_id_2'     => 'nullable|integer|exists:users,id|different:auditor_id_1',
        ]);

        // Hapus assignment lama untuk program studi & tahun periode ini
        Userprogramstudi::where('programstudis_id', $data['programstudis_id'])
            ->where('tahun', $currentYear)
            ->delete();

        // Cek duplikasi auditor
        $violations = [];
        foreach (['auditor_id_1', 'auditor_id_2'] as $field) {
            if (empty($data[$field])) {
                continue; // Skip jika auditor_id_2 tidak diisi
            }

            $userId = $data[$field];

            $existsElsewhere = Userprogramstudi::where('users_id', $userId)
                ->where('tahun', $currentYear)
                ->where('programstudis_id', '<>', $data['programstudis_id'])
                ->exists();

            if ($existsElsewhere) {
                $userName = User::find($userId)->name ?? "User #{$userId}";
                $violations[] = "Auditor “{$userName}” sudah punya penugasan lain di tahun {$currentYear}.";
            }
        }

        if (!empty($violations)) {
            return back()
                ->withErrors($violations)
                ->withInput();
        }

        // Simpan auditor
        foreach (['auditor_id_1', 'auditor_id_2'] as $field) {
            if (empty($data[$field])) {
                continue;
            }

            Userprogramstudi::create([
                'users_id'         => $data[$field],
                'programstudis_id' => $data['programstudis_id'],
                'status'           => 1,
                'tahun'            => $currentYear,
            ]);
        }

        // Update status pada Spmipenilaianprodi
        $penilaianProdi = Spmipenilaianprodi::where('programstudis_id', $data['programstudis_id'])
            ->where('spmi_periodes_id', $periode->id)
            ->first();

        if ($penilaianProdi) {
            $penilaianProdi->status = 6; //PROSES DIAUDIT
            $penilaianProdi->save();

            Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianProdi->id)
                ->update(['status' => 6]); //PROSES DIAUDIT
        } else {
            return redirect()->back()->with('error', 'Data penilaian prodi tidak ditemukan.');
        }

        return redirect()
            ->route('penugasanauditormenu', [
                'periode' => $periodeId,
                'program' => $data['programstudis_id'],
            ])
            ->with('success', 'Penugasan auditor berhasil disimpan.');
    }

    public function rekapkapus(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where('users_id', $users->id)->get();

        $query = Spmipenilaianprodi::with(['programstudi.getfakultas', 'spmiperiode']);

        if ($request->filled('fakultas')) {
            $query->whereHas('programstudi.getfakultas', function ($q) use ($request) {
                $q->where('id', $request->fakultas);
            });
        }

        if ($request->filled('periode')) {
            $query->where('spmi_periodes_id', $request->periode);
        }

        if ($request->filled('search')) {
            $searchTerm = strtolower($request->search);
            $query->whereHas('programstudi', function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(nama_prodi) LIKE ?', ['%' . $searchTerm . '%']);
            });
        }

        $data = $query->paginate(10)->appends($request->query());
        $allFakultas = Fakultas::orderBy('nama_fakultas')->get();
        $allPeriode = Spmiperiode::orderBy('nama')->get();

        return view('rekapkapus', compact('userroles', 'data', 'allFakultas', 'allPeriode'));
    }

    public function penjaminanmutuprodikapusspmi(Request $request)
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
}
