<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Strata;
use App\Models\Fakultas;
use App\Models\Userrole;

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
use App\Models\Programstudi;
// use App\Models\Spmiindikatorsub;
use App\Models\Usersauditor;
use Illuminate\Http\Request;
use App\Models\Spmiindikator;
use App\Models\Spmeakreditasi;
use App\Models\Userprogramstudi;

use App\Models\Spmipenilaianprodi;
use App\Models\Spmipenilaianindikator;
use App\Models\Spmipindikatorkomponen;
use App\Models\Spmikategorijenistemuan;
use App\Models\Spmipenilaianindikatorsub;
use App\Models\Spmipenilaianindikatorscalc;

class AuditController extends Controller
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

    public function daftarpengisianaudit(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where('users_id', $users->id)->get();

        $Userprogramstudis = Userprogramstudi::where('users_id', $users->id)->get();

        $programstudiIds = $Userprogramstudis->pluck('programstudis_id');
        $tahun = $Userprogramstudis->pluck('tahun');

        $data = Spmipenilaianprodi::whereIn('programstudis_id', $programstudiIds)
            ->whereIn('tahun', $tahun)
            ->whereIn('status', [6, 7, 8, 9, 10])
            ->paginate(10)
            ->appends($request->query());


        return view('pengerjaanauditor', compact('userroles', 'data'));
    }

    public function daftarpengisianauditselesai(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where('users_id', $users->id)->get();

        $Usersauditor = Usersauditor::where('users_id', $users->id)->get();
        $SpmipenilaianprodiIds = $Usersauditor->pluck('spmi_penilaianprodis_id');

        $data = Spmipenilaianprodi::whereIn('id', $SpmipenilaianprodiIds)
            ->where('status', 10)
            ->paginate(10)
            ->appends($request->query());

        return view('pengerjaanauditorselesai', compact('userroles', 'data'));
    }

    public function listakreditasi(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where('users_id', $users->id)->get();
        $programstudiId = $request->id_prodi;

        // $prodi = Programstudi::with('getfakultas')->find($programstudiId);
        // $programstudiName = $prodi?->nama_prodi ?? '-';
        // $fakultasName = $prodi?->getfakultas?->nama_fakultas ?? '-';

        $programstudi = Programstudi::where(['id' => $programstudiId])->first();
        if ($programstudi) {

            $request->session()->put('programstudi', $programstudi);
            $validator['programstudi'] = 'Roles is correct.';

            $akreditasis = Spmeakreditasi::where('programstudis_id', $programstudiId)->get();
            return view("listakreditasi", ['akreditasis' => $akreditasis, 'userroles' => $userroles]);
        } else {
            $validator['programstudi'] = 'Prodi is incorrect.';
            return back();
        }
    }

    public function penjaminanmutuauditor(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where('users_id', $users->id)->get();
        $spmiperiodes = Spmiperiode::all();
        $programstudiId = $request->id_prodi;
        $spmiperiodesId = $request->id_spmi_periodes;
        $programstudi = Programstudi::where(['id' => $programstudiId])->first();
        $spmipenilaianprodis = Spmipenilaianprodi::where("programstudis_id", $programstudi->id)->where("spmi_periodes_id", $spmiperiodesId)->get();
        $request->session()->put('programstudi', $programstudi);
        session()->put('spmipenilaianprodis', $spmipenilaianprodis);


        return view("pagesprodi.periode", ['spmiperiodes' => $spmiperiodes, 'userroles' => $userroles, 'spmipenilaianprodis' => $spmipenilaianprodis]);
    }

    public function penjaminanmutuauditorselesai(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where('users_id', $users->id)->get();

        $spmi_penilaianprodis_id = $request->input('spmi_penilaianprodis_id');
        $programstudi_id = $request->input('programstudi_id');
        $spmi_periodes_id = $request->input('spmi_periodes_id');

        $data = Spmipenilaianprodi::where('id', $spmi_penilaianprodis_id)
            ->where('spmi_periodes_id', $spmi_periodes_id)
            ->where('programstudis_id', $programstudi_id)
            ->first();

        $dataUsersauditor = Usersauditor::where('users_id', $users->id)
            ->where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)
            ->first();

        if ($dataUsersauditor) {
            $dataUsersauditor->status = '1';
            $dataUsersauditor->save();
        } else {
            Usersauditor::create([
                'spmi_penilaianprodis_id' => $spmi_penilaianprodis_id,
                'users_id' => $users->id,
                'status' => '1',
            ]);
        }

        if ($data) {
            $data->status = 10;
            $data->save();

            Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)
                ->update(['status' => 10]);

            return redirect()->back()->with('success', 'Data penilaian berhasil dikunci!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }

    public function penjaminanmutuauditorbatalselesai(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where('users_id', $users->id)->get();

        $spmi_penilaianprodis_id = $request->input('spmi_penilaianprodis_id');
        $programstudi_id = $request->input('programstudi_id');
        $spmi_periodes_id = $request->input('spmi_periodes_id');

        $data = Spmipenilaianprodi::where('id', $spmi_penilaianprodis_id)
            ->where('spmi_periodes_id', $spmi_periodes_id)
            ->where('programstudis_id', $programstudi_id)
            ->first();

        $dataUsersauditor = Usersauditor::where('users_id', $users->id)
            ->where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)
            ->first();

        if ($dataUsersauditor) {
            $dataUsersauditor->status = '0';
            $dataUsersauditor->save();
        } else {
            Usersauditor::create([
                'spmi_penilaianprodis_id' => $spmi_penilaianprodis_id,
                'users_id' => $users->id,
                'status' => '0',
            ]);
        }

        if ($data) {
            $data->status = 9;
            $data->save();

            Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)
                ->update(['status' => 9]);

            return redirect()->back()->with('success', 'Data penilaian berhasil dikunci!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }

    public function auditindikatordetail($id)
    {
        $spmipenilaianprodi = Spmipenilaianprodi::where('programstudis_id', session()->get('programstudi')->id)->get();
        $spmipenilaianindikator = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmipenilaianprodi[0]->id)->where('spmi_indikators_id', $id)->get();
        $spmiindikator = Spmiindikator::where('id', $id)->get();
        $spmikategorijenistemuans = Spmikategorijenistemuan::all();

        if (@$spmipenilaianindikator[0]) {

            return view("pagesprodi.penjaminanmutu_indikatordetail", ['spmiindikator' => $spmiindikator, 'spmikategorijenistemuans' => $spmikategorijenistemuans, "spmipenilaianprodi" => $spmipenilaianprodi[0], 'spmipenilaianindikator' => $spmipenilaianindikator[0]]);
        } else {
            return view("pagesprodi.penjaminanmutu_indikatordetail", ['spmiindikator' => $spmiindikator, 'spmikategorijenistemuans' => $spmikategorijenistemuans, "spmipenilaianprodi" => $spmipenilaianprodi[0]]);
        }
    }


    public function penjamuindikatorkualitatifauditor_update(Request $request)
    {

        $model = Spmipenilaianindikator::findOrFail($request->spmi_penilaianindikators_id);


        $model->nilai_auditor = $request->nilai_auditor;
        $model->perhatian     = 1;


        $model->save();


        return redirect()->back()->with('success', 'Nilai auditor berhasil disimpan');
    }



    public function auditindikatordetail_update(Request $request, $id)
    {

        $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($id);
        $spmipenilaianindikator->apresiasi_pelampauan = $request->apresiasi_pelampauan;
        $spmipenilaianindikator->deskripsi_temuan = $request->deskripsi_temuan;
        $spmipenilaianindikator->dampak_temuan = $request->dampak_temuan;
        $spmipenilaianindikator->akar_masalah_temuan = $request->akar_masalah_temuan;
        $spmipenilaianindikator->rekomendasi_temuan = $request->rekomendasi_temuan;
        $spmipenilaianindikator->spmi_kategorijenistemuans_id = $request->spmi_kategorijenistemuans_id;
        $spmipenilaianindikator->save();

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function auditindikatorsubdetail_update(Request $request, $id)
    {


        $spmipenilaianindikatorsub = Spmipenilaianindikator::findOrFail($id);;
        $spmipenilaianindikatorsub->nilai_auditor = $request->nilai_auditor;
        $spmipenilaianindikatorsub->save();


        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function auditkomponen_store(Request $request)
    {

        $validated = $request->validate([

            'komponens.*.id' => 'exists:spmi_pindikatorkomponens,id',
            'komponens.*.spmi_penilaianindikators_id' => 'numeric',
            'komponens.*.nilai_auditor' => 'numeric',
            'komponens.*.spmi_indikatorkomponens_id' => 'numeric',
        ]);

        $komponens = [];
        foreach ($validated['komponens'] as $komponen) {
            $komponens[] = [
                'id' => $komponen['id'] ?? null,
                'spmi_penilaianindikators_id' => $komponen['spmi_penilaianindikators_id'],
                'spmi_indikatorkomponens_id' => $komponen['spmi_indikatorkomponens_id'],
                'nilai_auditor' => $komponen['nilai_auditor'],
                // 'created_at' => now(),
            ];
        }

        Spmipindikatorkomponen::upsert(
            $komponens,
            ['id'],
            ['nilai_auditor', 'updated_at']
        );


        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function penilaiancalculateauditor(Request $request)
    {

        $validated = $request->validate([
            'spmi_penilaianprodis_id' => 'numeric',
            'spmipenilaianindikator_id' => 'numeric',
            'spmi_indikators_id' => 'numeric',
            'spmi_indikators_kode' => 'string'
        ]);

        // try {
        if ($request->spmi_indikators_kode == 'C.2.4.a') {
            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 1)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 2)->first()->nilai_auditor;
            $result = $this->c2->c24asub($a, $b);
            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.2.4.b') {
            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 3)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 4)->first()->nilai_auditor;
            $result = $this->c2->c24asub($a, $b);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.2.4.d') {
            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 6)->first()->nilai_auditor;
            $result = $this->c2->c24d($a, $b);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.3.4.a') {
            $spmipenilaianindikators_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 7)->first()->id;
            $Pilihan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmipenilaianindikators_id)->where('spmi_indikatorkomponens_id', 8)->first()->nilai_auditor;
            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 8)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 9)->first()->nilai_auditor;

            $result = $this->c3->c34a($Pilihan, $a, $b);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.3.4.av') {

            $spmipenilaianindikators_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 37)->first()->id;
            $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmipenilaianindikators_id)->where('spmi_indikatorkomponens_id', 285)->first()->nilai_auditor;
            $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmipenilaianindikators_id)->where('spmi_indikatorkomponens_id', 286)->first()->nilai_auditor;
            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 36)->first()->nilai_auditor;

            $result = $this->c3->c34av($NA, $NB, $a);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.3.4.b') {

            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 10)->first();
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 11)->first();

            if ($request->auditor != 1) {
                $result = $this->c3->c34b($a->nilai_auditor, $b->nilai_auditor);
            } else {
                $result = $this->c3->c34b($a->nilai_auditor, $b->nilai_auditor);
            }


            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.3.4.c') {

            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 12)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 13)->first()->nilai_auditor;

            $result = $this->c3->c34c($a, $b);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.3.4.d') {

            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 31)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 32)->first()->nilai_auditor;
            $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 33)->first()->nilai_auditor;
            $result = $this->c3->c34d($a, $b, $c);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.3.4.e') {

            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 34)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 35)->first()->nilai_auditor;
            
            $result = $this->c3->c34e($a, $b);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.a1') {


            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c4->c44a1($NDTPS, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.a2') {


            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NDS3 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 15)->first()->nilai_auditor;
            $result = $this->c4->c44a2($NDS3, $NDTPS);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.a3') {


            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 17)->first()->nilai_auditor;
            $NDLK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 18)->first()->nilai_auditor;
            $NDL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 19)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c4->c44a3($NDGB, $NDLK, $NDL, $NDTPS, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.a4') {

            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            if ($strata->nama_strata == "S1") {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id_NDTPS = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id_NDTPS)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
                $spmi_penilaianindikator_id_pilihan = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 7)->first()->id;
                $pilihan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id_pilihan)->where('spmi_indikatorkomponens_id', 8)->first()->nilai_auditor;
                $rendah = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 9)->first()->nilai_auditor;
                $kelompok = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 20)->first()->nilai_auditor;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 21)->first()->nilai_auditor;

                $result = $this->c4->c44a4($kelompok, $NM, $NDTPS, $pilihan, $rendah);
            } else if ($strata->nama_strata == "D4") {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id_NDTPS = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id_NDTPS)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
                $kelompok = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 20)->first()->nilai_auditor;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 21)->first()->nilai_auditor;

                $result = $this->c4->c44a4v($kelompok, $NM, $NDTPS);
            }



            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.a5') {

            $RDPUPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 23)->first()->nilai_auditor;
            $RDPUL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 24)->first()->nilai_auditor;
            $result = $this->c4->c44a5($RDPUPS, $RDPUL);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.a6') {

            $EWMPDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 26)->first()->nilai_auditor;
            $EWMPDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 27)->first()->nilai_auditor;
            $result = $this->c4->c44a6($EWMPDT, $EWMPDTPS);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.a6v') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NDSK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 272)->first()->nilai_auditor;
            $result = $this->c4->c44a6v($NDTPS, $NDSK);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.a7') {

            $NDTT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 29)->first()->nilai_auditor;
            $NDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 30)->first()->nilai_auditor;
            $result = $this->c4->c44a7($NDTT, $NDT);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.a7v') {

            $MKKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 273)->first()->nilai_auditor;
            $MKK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 274)->first()->nilai_auditor;
            $result = $this->c4->c44a7v($MKKI, $MKK);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.b1') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NRD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 32)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c4->c44b1($NRD, $NDTPS, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.b2') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 33)->first()->nilai_auditor;
            $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 34)->first()->nilai_auditor;
            $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 35)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c4->c44b2($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.b3') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 39)->first()->nilai_auditor;
            $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 40)->first()->nilai_auditor;
            $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 41)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c4->c44b3($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.b3v') {

            
            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NRD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 283)->first()->nilai_auditor;
            $result = $this->c4->c44b3v($NRD, $NDTPS);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.b4') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $data = [
                'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 45)->first()->nilai_auditor,
                'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 46)->first()->nilai_auditor,
                'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 47)->first()->nilai_auditor,
                'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 48)->first()->nilai_auditor,
                'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 49)->first()->nilai_auditor,
                'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 50)->first()->nilai_auditor,
                'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 51)->first()->nilai_auditor,
                'NC1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 52)->first()->nilai_auditor,
                'NC2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 53)->first()->nilai_auditor,
                'NC3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 54)->first()->nilai_auditor,
            ];
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c4->c44b4($data, $NDTPS, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.b5') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 58)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c4->c44b5($NAS, $NDTPS, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.b6') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 59)->first()->nilai_auditor;
            $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 60)->first()->nilai_auditor;
            $NC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 61)->first()->nilai_auditor;
            $ND = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 62)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c4->c44b6($NA, $NB, $NC, $ND, $NDTPS, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.b7v') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 275)->first()->nilai_auditor;
            $result = $this->c4->c44a6v($NDTPS, $NAPJ);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.b6m') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 278)->first()->nilai_auditor;
            $result = $this->c4->c44b6m($NDTPS, $NAS);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.c') {
            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id',$spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id',5)->first()->id;

            $data = [
                'c44a1' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 17)->first()->nilai_auditor ?? 0,
                'c44a2' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 18)->first()->nilai_auditor ?? 0,
                'c44a3' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 19)->first()->nilai_auditor ?? 0,
                'c44a4' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 20)->first()->nilai_auditor ?? 0,
                'c44a5' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 21)->first()->nilai_auditor ?? 0,
                'c44a6' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 22)->first()->nilai_auditor ?? 0,
                'c44a7' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 23)->first()->nilai_auditor ?? 0,
            ];
            $c44c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 30)->first()->nilai_auditor;

            $result = $this->c4->c44ckomp($data, $c44c);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.4.4.d') {

            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 14)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 15)->first()->nilai_auditor;

            $result = $this->c4->c44d($a, $b);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.5.4.a1') {

            // $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 20)->first()->id;
            $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 287)->first()->nilai_auditor;
            $BOP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 65)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            $result = $this->c5->c54a1($BOP, $NM, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.5.4.a2') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $DP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 67)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c5->c54a2($DP, $NDTPS, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.5.4.a3') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $DPKM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 69)->first()->nilai_auditor;
            $result = $this->c5->c54a3($DPKM, $NDTPS);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.5.4.a4') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $data = [
                'c44a1' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 17)->first()->nilai_auditor ?? 0,
                'c44a2' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 18)->first()->nilai_auditor ?? 0,
                'c44a3' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 19)->first()->nilai_auditor ?? 0,
                'c44a4' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 20)->first()->nilai_auditor ?? 0,
                'c44a5' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 21)->first()->nilai_auditor ?? 0,
                'c44a6' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 22)->first()->nilai_auditor ?? 0,
                'c44a7' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 23)->first()->nilai_auditor ?? 0,
            ];

            $c54a4 = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 35)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            $result = $this->c5->c54a4ckomp($data, $c54a4, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.6.4.a') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 16)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 17)->first()->nilai_auditor;
            $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 18)->first()->nilai_auditor;

            $result = $this->c6->c64a($a, $b, $c);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.6.4.c') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 19)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 20)->first()->nilai_auditor;

            $result = $this->c6->c64c($a, $b);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.6.4.d1') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 21)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 22)->first()->nilai_auditor;
            $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 23)->first()->nilai_auditor;
            $d = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 24)->first()->nilai_auditor;
            $e = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 25)->first()->nilai_auditor;

            $result = $this->c6->c64d1($a, $b, $c, $d, $e);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.6.4.d2') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            $JP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 72)->first()->nilai_auditor;
            $JB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 73)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            $result = $this->c6->c64d2($JP, $JB, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.6.4.f') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 26)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 27)->first()->nilai_auditor;
            $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 28)->first()->nilai_auditor;


            $result = $this->c6->c64f($a, $b, $c);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.6.4.g') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            $MK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 75)->first()->nilai_auditor;

            $result = $this->c6->c64g($MK);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.6.4.j') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            $MKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 279)->first()->nilai_auditor;
            $MK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 280)->first()->nilai_auditor;
            
            

            $result = $this->c6->c64j($MKI, $MK);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.6.4.i') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 29)->first()->nilai_auditor;
            $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 30)->first()->nilai_auditor;

            $result = $this->c6->c64i($a, $b);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.7.4.b') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            $NPM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 102)->first()->nilai_auditor;
            $NPKMD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 103)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c7->c74b($NPM, $NPKMD, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.7.4.cm') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            $NPM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 281)->first()->nilai_auditor;
            $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 282)->first()->nilai_auditor;
            
            
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            $result = $this->c7->c74cm($NPM, $NPD, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.8.4.b') {


            $NPKMM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 105)->first()->nilai_auditor;
            $NPKMD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 106)->first()->nilai_auditor;

            $result = $this->c8->c84b($NPKMM, $NPKMD);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.a2') {

            $lulusan = [
                'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 108)->first()->nilai_auditor,
                'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 109)->first()->nilai_auditor,
                'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 110)->first()->nilai_auditor,
            ];

            $ipk = [
                'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 111)->first()->nilai_auditor,
                'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 112)->first()->nilai_auditor,
                'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 113)->first()->nilai_auditor,
            ];

            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c9->c94a2($lulusan, $ipk, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.a3') {


            $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 115)->first()->nilai_auditor;
            $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 116)->first()->nilai_auditor;
            $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 117)->first()->nilai_auditor;
            $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 118)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c9->c94a3($NI, $NN, $NW, $NM, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.a4') {


            $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 122)->first()->nilai_auditor;
            $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 123)->first()->nilai_auditor;
            $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 124)->first()->nilai_auditor;
            $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 125)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c9->c94a4($NI, $NN, $NW, $NM, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.a5') {


            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            // $dts6 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 129)->first()->nilai_prodi;
            if ($strata->nama_strata == "S2") {
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 289)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 290)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 291)->first()->nilai_auditor,
                ];
            } else if ($strata->nama_strata == "S3") {
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 293)->first()->nilai_auditor,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 294)->first()->nilai_auditor,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 295)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 296)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 297)->first()->nilai_auditor,
                ];
            } else {
                $lulusan = [
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 130)->first()->nilai_auditor,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 131)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 132)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 133)->first()->nilai_auditor,
                ];
            }

            $result = $this->c9->c94a5($lulusan, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.a6') {
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            if ($strata->nama_strata == "S2") {
                $diterima = [
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 298)->first()->nilai_auditor,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 299)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 300)->first()->nilai_auditor,
                ];
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 301)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 302)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 303)->first()->nilai_auditor,
                ];
            } else if ($strata->nama_strata == "S3") {
                $diterima = [
                    'ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 304)->first()->nilai_auditor,
                    'ts5' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 305)->first()->nilai_auditor,
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 306)->first()->nilai_auditor,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 307)->first()->nilai_auditor,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 308)->first()->nilai_auditor,
                ];
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 309)->first()->nilai_auditor,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 310)->first()->nilai_auditor,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 311)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 312)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 313)->first()->nilai_auditor,
                ];
            } else {

                $diterima = [
                    'ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 135)->first()->nilai_auditor,
                    'ts5' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 136)->first()->nilai_auditor,
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 137)->first()->nilai_auditor,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 138)->first()->nilai_auditor,
                ];
                $lulusan = [
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 139)->first()->nilai_auditor,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 140)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 141)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 142)->first()->nilai_auditor,
                ];
            }
            

            $result = $this->c9->c94a6($diterima, $lulusan, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.a7') {

            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            if ($strata->nama_strata == "S2") {
                $dt = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 314)->first()->nilai_auditor;
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 315)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 316)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 317)->first()->nilai_auditor,
                ];
            } else if ($strata->nama_strata == "S3") {
                $dt = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 318)->first()->nilai_auditor;
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 319)->first()->nilai_auditor,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 320)->first()->nilai_auditor,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 321)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 322)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 323)->first()->nilai_auditor,
                ];
            } else {
                $dt = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 144)->first()->nilai_auditor;
                $lulusan = [
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 145)->first()->nilai_auditor,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 146)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 147)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 148)->first()->nilai_auditor,
                ];
            }
            $result = $this->c9->c94a7($lulusan, $dt, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.a9') {
            $lulusan = [
                'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 150)->first()->nilai_auditor,
                'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 151)->first()->nilai_auditor,
                'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 152)->first()->nilai_auditor,
            ];

            $lulusanterlacak = [
                'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 153)->first()->nilai_auditor,
                'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 154)->first()->nilai_auditor,
                'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 155)->first()->nilai_auditor,
            ];

            $tahunlulus = [
                'tlts4wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 159)->first()->nilai_auditor,
                'tlts4wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 160)->first()->nilai_auditor,
                'tlts4wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 161)->first()->nilai_auditor,
                'tlts3wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 162)->first()->nilai_auditor,
                'tlts3wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 163)->first()->nilai_auditor,
                'tlts3wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 164)->first()->nilai_auditor,
                'tlts2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 165)->first()->nilai_auditor,
                'tlts2wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 166)->first()->nilai_auditor,
                'tlts2wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 167)->first()->nilai_auditor,
            ];

            $result = $this->c9->c94a9($lulusan, $lulusanterlacak, $tahunlulus);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.a10') {
            $lulusan = [
                'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 169)->first()->nilai_auditor,
                'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 170)->first()->nilai_auditor,
                'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 171)->first()->nilai_auditor,
            ];

            $lulusanterlacak = [
                'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 172)->first()->nilai_auditor,
                'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 173)->first()->nilai_auditor,
                'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 174)->first()->nilai_auditor,
            ];

            $kesesuaianlulusan = [
                'tlts4wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 178)->first()->nilai_auditor,
                'tlts4wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 179)->first()->nilai_auditor,
                'tlts4wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 180)->first()->nilai_auditor,
                'tlts3wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 181)->first()->nilai_auditor,
                'tlts3wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 182)->first()->nilai_auditor,
                'tlts3wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 183)->first()->nilai_auditor,
                'tlts2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 184)->first()->nilai_auditor,
                'tlts2wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 185)->first()->nilai_auditor,
                'tlts2wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 186)->first()->nilai_auditor,
            ];

            $result = $this->c9->c94a10($lulusan, $lulusanterlacak, $kesesuaianlulusan);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.a11') {
            $lulusan = [
                'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 188)->first()->nilai_auditor,
                'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 189)->first()->nilai_auditor,
                'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 190)->first()->nilai_auditor,
            ];

            $lulusanterlacak = [
                'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 191)->first()->nilai_auditor,
                'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 192)->first()->nilai_auditor,
                'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 193)->first()->nilai_auditor,
            ];

            $lulusantingkat = [
                'NIts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 197)->first()->nilai_auditor,
                'NNts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 198)->first()->nilai_auditor,
                'NWts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 199)->first()->nilai_auditor,
                'NIts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 200)->first()->nilai_auditor,
                'NNts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 201)->first()->nilai_auditor,
                'NWts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 202)->first()->nilai_auditor,
                'NIts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 203)->first()->nilai_auditor,
                'NNts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 204)->first()->nilai_auditor,
                'NWts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 205)->first()->nilai_auditor,
            ];

            $result = $this->c9->c94a11($lulusan, $lulusanterlacak, $lulusantingkat);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.a12') {
            $lulusan = [
                'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 209)->first()->nilai_auditor,
                'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 210)->first()->nilai_auditor,
                'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 211)->first()->nilai_auditor,
            ];

            $lulusanterlacak = [
                'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 212)->first()->nilai_auditor,
                'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 213)->first()->nilai_auditor,
                'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 214)->first()->nilai_auditor,
            ];

            $penggunalulusan = [
                'etika_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 218)->first()->nilai_auditor,
                'etika_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 219)->first()->nilai_auditor,
                'etika_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 220)->first()->nilai_auditor,
                'etika_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 221)->first()->nilai_auditor,

                'keahlian_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 223)->first()->nilai_auditor,
                'keahlian_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 224)->first()->nilai_auditor,
                'keahlian_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 225)->first()->nilai_auditor,
                'keahlian_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 226)->first()->nilai_auditor,

                'bahasa_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 228)->first()->nilai_auditor,
                'bahasa_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 229)->first()->nilai_auditor,
                'bahasa_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 230)->first()->nilai_auditor,
                'bahasa_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 231)->first()->nilai_auditor,

                'teknologiinformasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 233)->first()->nilai_auditor,
                'teknologiinformasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 234)->first()->nilai_auditor,
                'teknologiinformasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 235)->first()->nilai_auditor,
                'teknologiinformasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 236)->first()->nilai_auditor,

                'komunikasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 238)->first()->nilai_auditor,
                'komunikasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 239)->first()->nilai_auditor,
                'komunikasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 240)->first()->nilai_auditor,
                'komunikasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 241)->first()->nilai_auditor,

                'kerjasama_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 243)->first()->nilai_auditor,
                'kerjasama_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 244)->first()->nilai_auditor,
                'kerjasama_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 245)->first()->nilai_auditor,
                'kerjasama_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 246)->first()->nilai_auditor,

                'pengembangandiri_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 248)->first()->nilai_auditor,
                'pengembangandiri_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 249)->first()->nilai_auditor,
                'pengembangandiri_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 250)->first()->nilai_auditor,
                'pengembangandiri_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 251)->first()->nilai_auditor,
            ];

            $result = $this->c9->c94a12($lulusan, $lulusanterlacak, $penggunalulusan);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.b1') {
            $data = [
                'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 253)->first()->nilai_auditor,
                'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 254)->first()->nilai_auditor,
                'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 255)->first()->nilai_auditor,
                'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 256)->first()->nilai_auditor,
                'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 257)->first()->nilai_auditor,
                'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 258)->first()->nilai_auditor,
                'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 259)->first()->nilai_auditor,
                'NC1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 260)->first()->nilai_auditor,
                'NC2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 261)->first()->nilai_auditor,
                'NC3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 262)->first()->nilai_auditor,
            ];

            $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 263)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

            $result = $this->c9->c94b1($data, $NM, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.b2') {

            $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 267)->first()->nilai_auditor;
            $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 268)->first()->nilai_auditor;
            $NC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 269)->first()->nilai_auditor;
            $ND = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 270)->first()->nilai_auditor;

            $result = $this->c9->c94b2($NA, $NB, $NC, $ND);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.b3v') {

            $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
            $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_auditor;
            $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 276)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            $result = $this->c9->c94b3v($NAPJ, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.b3') {

            $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 277)->first()->nilai_auditor;
            // Get strata bcs difer threshold
            $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            $result = $this->c9->c94b3($NAS, $strata->nama_strata);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else if ($request->spmi_indikators_kode == 'C.9.4.b1d') {

            $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 284)->first()->nilai_auditor;
            $result = $this->c9->c94b1d($NAS);

            $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
        } else {
            $indikator = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)
                ->where('spmi_indikators_id', $request->input('spmi_indikators_id'))
                ->first();

            $result = $indikator ? $indikator->nilai_auditor : null;
        }

        // $spmipenilaianindikator->nilai_auditor = $result;
        // $spmipenilaianindikator->save();

        $spmipenilaianindikatorcalc = Spmipenilaianindikatorscalc::where([
            'spmi_penilaianprodis_id' => $request->input('spmi_penilaianprodis_id'),
            'spmi_indikators_id' => $request->input('spmi_indikators_id')
        ])->first();

        if ($spmipenilaianindikatorcalc) {
            $spmipenilaianindikatorcalc->nilai_auditor = $result;
            $spmipenilaianindikatorcalc->status = 7;
            $spmipenilaianindikatorcalc->save();
        } else {
            // Jika tidak ada, insert baru
            Spmipenilaianindikatorscalc::create([
                'spmi_penilaianprodis_id' => $request->input('spmi_penilaianprodis_id'),
                'spmi_indikators_id' => $request->input('spmi_indikators_id'),
                'nilai_auditor' => $result,
                'status' => 7
            ]);
        }
        return redirect()->back()->with('successPenilaianCalculate', 'Data tersimpan!');
        // }
        // catch (\Throwable $e) {
        //     return redirect()
        //         ->back()
        //         ->withErrors(['errorPenilaianCalculate' => 'Gagal menghitung penilaian: Data tidak lengkap.']);
        // }
    }

    public function kalkulasiauditor(Request $request)
    {
        $spmi_penilaianprodis_id = $request->input('spmi_penilaianprodis_id');
        $jumlahhasilauditor = $request->input('jumlahhasilauditor');
        $programstudi_id = $request->input('programstudi');
        $spmi_periodes_id = $request->input('spmi_periodes_id');

        $data = Spmipenilaianprodi::where('id', $spmi_penilaianprodis_id)
            ->where('spmi_periodes_id', $spmi_periodes_id)
            ->where('programstudis_id', $programstudi_id)
            ->first();

        if ($data) {
            // Update nilai_prodi_final
            $data->nilai_auditor_final = $jumlahhasilauditor;
            $data->status = 8;
            $data->save();

            Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)
                ->update(['status' => 8]);

            return redirect()->back()->with('success', 'Data kalkulasi berhasil ditambah!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }

    public function kuncinilaiauditor(Request $request)
    {
        $spmi_penilaianprodis_id = $request->input('spmi_penilaianprodis_id');
        $programstudi_id = $request->input('programstudi');
        $spmi_periodes_id = $request->input('spmi_periodes_id');

        $data = Spmipenilaianprodi::where('id', $spmi_penilaianprodis_id)
            ->where('spmi_periodes_id', $spmi_periodes_id)
            ->where('programstudis_id', $programstudi_id)
            ->first();

        if ($data) {
            $data->status = 9;
            $data->save();

            Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)
                ->update(['status' => 9]);

            return redirect()->back()->with('success', 'Data penilaian berhasil dikunci!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }

    public function prosesalauditor(Request $request)
    {
        $spmi_penilaianprodis_id = $request->input('spmi_penilaianprodis_id');
        $programstudi_id = $request->input('programstudi');
        $spmi_periodes_id = $request->input('spmi_periodes_id');

        $data = Spmipenilaianprodi::where('id', $spmi_penilaianprodis_id)
            ->where('spmi_periodes_id', $spmi_periodes_id)
            ->where('programstudis_id', $programstudi_id)
            ->first();

        if ($data) {
            $data->status = 10;
            $data->save();

            Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)
                ->update(['status' => 10]);

            return redirect()->back()->with('success', 'Data penilaian berhasil dikunci!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }

    public function bukakuncinilaiauditor(Request $request)
    {
        $spmi_penilaianprodis_id = $request->input('spmi_penilaianprodis_id');
        $programstudi_id = $request->input('programstudi');
        $spmi_periodes_id = $request->input('spmi_periodes_id');

        $data = Spmipenilaianprodi::where('id', $spmi_penilaianprodis_id)
            ->where('spmi_periodes_id', $spmi_periodes_id)
            ->where('programstudis_id', $programstudi_id)
            ->first();

        if ($data) {
            $data->status = 8;
            $data->save();

            Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)
                ->update(['status' => 8]);

            return redirect()->back()->with('success', 'Data penilaian berhasil dibuka kunci!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }

    public function komponencalculateauditor(Request $request)
    {
        $validated = $request->validate([
            'spmi_penilaianprodis_id' => 'numeric',
            'spmipenilaianindikatorsub_id' => 'numeric',
            'spmi_indikatorsubs_id' => 'numeric'
        ]);

        try {
            $spmi_indikatorsubs_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikatorsub_id)->first()->spmi_indikatorsubs_id;
            //dd($request);
            if ($spmi_indikatorsubs_id == 5) {
                $N1 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 1)->first();
                $N2 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 2)->first();
                $N3 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 3)->first();
                $NDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 4)->first();
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c2->c24dsubkoma($N1->nilai_auditor, $N2->nilai_auditor, $N3->nilai_auditor, $NDT->nilai_auditor, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 6) {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 5)->first();
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 6)->first();
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 7)->first();
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c2->c24dsubkomb($NI->nilai_auditor, $NN->nilai_auditor, $NW->nilai_auditor, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 8) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',8)->first()->nilai_prodi;
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 9)->first();
                $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 10)->first();

                // $result = $this->c3->c34asub1($NA, $NB);
                $result = $this->c3->c34asub1($NA->nilai_auditor, $NB->nilai_auditor);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 11) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',8)->first()->nilai_prodi;
                $NMUPPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 11)->first();
                $NMAFT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 12)->first();
                $NMAPT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 13)->first();
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c3->c34bsubb($NMUPPS->nilai_auditor, $NMAFT->nilai_auditor, $NMAPT->nilai_auditor, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 29) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',8)->first()->nilai_prodi;
                $kepuasan = [
                    'reliability_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 76)->first()->nilai_auditor,
                    'reliability_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 77)->first()->nilai_auditor,
                    'reliability_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 78)->first()->nilai_auditor,
                    'reliability_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 79)->first()->nilai_auditor,

                    'responsiveness_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 81)->first()->nilai_auditor,
                    'responsiveness_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 82)->first()->nilai_auditor,
                    'responsiveness_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 83)->first()->nilai_auditor,
                    'responsiveness_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 84)->first()->nilai_auditor,

                    'assurance_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 86)->first()->nilai_auditor,
                    'assurance_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 87)->first()->nilai_auditor,
                    'assurance_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 88)->first()->nilai_auditor,
                    'assurance_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 89)->first()->nilai_auditor,

                    'empathy_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 91)->first()->nilai_auditor,
                    'empathy_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 92)->first()->nilai_auditor,
                    'empathy_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 93)->first()->nilai_auditor,
                    'empathy_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 94)->first()->nilai_auditor,

                    'tangible_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 96)->first()->nilai_auditor,
                    'tangible_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 97)->first()->nilai_auditor,
                    'tangible_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 98)->first()->nilai_auditor,
                    'tangible_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 99)->first()->nilai_auditor,
                ];

                $kepuasan = [
                    'reliability_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 76)->first()->nilai_auditor,
                    'reliability_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 77)->first()->nilai_auditor,
                    'reliability_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 78)->first()->nilai_auditor,
                    'reliability_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 79)->first()->nilai_auditor,

                    'responsiveness_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 81)->first()->nilai_auditor,
                    'responsiveness_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 82)->first()->nilai_auditor,
                    'responsiveness_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 83)->first()->nilai_auditor,
                    'responsiveness_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 84)->first()->nilai_auditor,

                    'assurance_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 86)->first()->nilai_auditor,
                    'assurance_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 87)->first()->nilai_auditor,
                    'assurance_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 88)->first()->nilai_auditor,
                    'assurance_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 89)->first()->nilai_auditor,

                    'empathy_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 91)->first()->nilai_auditor,
                    'empathy_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 92)->first()->nilai_auditor,
                    'empathy_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 93)->first()->nilai_auditor,
                    'empathy_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 94)->first()->nilai_auditor,

                    'tangible_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 96)->first()->nilai_auditor,
                    'tangible_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 97)->first()->nilai_auditor,
                    'tangible_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 98)->first()->nilai_auditor,
                    'tangible_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 99)->first()->nilai_auditor,
                ];

                $result = $this->c6->c64itkm($kepuasan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else {
                $indikator = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)
                    ->where('spmi_indikatorkomponens_id', $request->input('spmi_indikatorsubs_id'))
                    ->first();

                $result = $indikator ? $indikator->nilai_auditor : null;
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            }



            $spmipenilaianindikator->nilai_auditor = $result;
            $spmipenilaianindikator->save();

            return redirect()->back()->with('successPenilaianCalculate', 'Data tersimpan!');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withErrors(['errorPenilaianCalculate' => 'Gagal menghitung penilaian: Data tidak lengkap.']);
        }
    }

    public function penjamukomponenaudit_store(Request $request)
    {
        
        // Validate the request (optional but recommended)
        if ($request->spmipenilaianindikatorsub_id == NULL && $request->spmi_indikatorsubs_id != NULL) {

            $spmipenilaianindikator = new Spmipenilaianindikator;
            $spmipenilaianindikator->spmi_indikatorsubs_id = $request->spmi_indikatorsubs_id;
            $spmipenilaianindikator->spmi_penilaianprodis_id = $request->spmi_penilaianprodis_id;
            $spmipenilaianindikator->save();
            
            $spmi_penilaianindikators_id = $spmipenilaianindikator->id;
            //cek
            // $spmi_penilaianindikators_id = $request->spmi_penilaianindikators_id;
        } else if ($request->spmipenilaianindikatorsub_id != NULL && $request->spmi_indikatorsubs_id != NULL) {
            // cek
            $spmi_penilaianindikators_id = $request->spmipenilaianindikatorsub_id;
        } else if ($request->spmi_penilaianindikators_id != NULL && $request->spmi_penilaianprodis_id != NULL) {
            $spmi_penilaianindikators_id = $request->spmi_penilaianindikators_id;
        }


        

        $validated = $request->validate([
            // 'komponens' => 'required|array|min:1',
            'komponens.*.id' => 'nullable|exists:spmi_pindikatorkomponens,id',
            // 'komponens.*.spmi_penilaianindikators_id' => 'numeric',
            'komponens.*.nilai_auditor' => 'numeric',
            'komponens.*.spmi_indikatorkomponens_id' => 'numeric',
        ]);
        
        // Prepare the data for batch insert
        $komponens = [];
        foreach ($validated['komponens'] as $komponen) {
            $komponens[] = [
                'id' => $komponen['id'] ?? null,
                'spmi_penilaianindikators_id' => $spmi_penilaianindikators_id,
                'spmi_indikatorkomponens_id' => $komponen['spmi_indikatorkomponens_id'],
                // 'nilai_prodi' => 0,
                'nilai_auditor' => $komponen['nilai_auditor'],
                'created_at' => now(),
            ];
        }
        
        // Laravel upsert: (array $values, array $uniqueBy, array $update)
        Spmipindikatorkomponen::upsert(
            $komponens,
            ['id'],               // Column to check for existing record (unique key)
            ['nilai_auditor', 'updated_at']  // Columns to update if exists
        );
        // Spmipindikatorkomponen::insert($komponens);

        return redirect()->back()->with('success', 'Post created successfully!');
    }
}
