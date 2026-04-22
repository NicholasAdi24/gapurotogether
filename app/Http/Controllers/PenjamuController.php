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
// use App\Models\Spmipenilaianindikatorsub;
use App\Services\C7Service;
use App\Services\C8Service;
use App\Services\C9Service;
use Illuminate\Http\Request;
use App\Models\Spmiindikator;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Spmiindikatorsub;
use App\Models\Userprogramstudi;
use App\Models\Spmipenilaianprodi;
use App\Models\Spmiindikatorkomponen;
use App\Models\Spmipenilaianindikator;
use App\Models\Spmipindikatorkomponen;
use App\Models\Spmikategorijenistemuan;
use Illuminate\Support\Facades\Session;
use App\Models\Spmipenilaianindikatorscalc;



class PenjamuController extends Controller
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

    public function penjaminanmutuprodi(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where(['users_id' => $users->id, 'roles_id' => $request->input('roles_id')])->get();
        $spmiperiodes = Spmiperiode::all();
        $spmipenilaianprodis = Spmipenilaianprodi::where("programstudis_id", session('programstudi')['id'])->get();
        session()->put('spmipenilaianprodis', $spmipenilaianprodis);


        return view("pagesprodi.periode", ['spmiperiodes' => $spmiperiodes, 'userroles' => $userroles, 'spmipenilaianprodis' => $spmipenilaianprodis]);
    }


//ADD exclude elemen//

public function penjamuelemen($id)
{
    // Ambil user & role
    $users = User::where('email', session()->get('user')->email)->first();
    $rolesIds = Userrole::where('users_id', $users->id)->pluck('roles_id');
    $userroles = Userrole::where('users_id', $users->id)
        ->whereIn('roles_id', $rolesIds)
        ->get();

    // Ambil data penilaian prodi + relasi programstudi
    $spmipenilaianprodi = Spmipenilaianprodi::with('programstudi')->findOrFail($id);

    // Ambil nama prodi (aman dari null)
    $namaProdi = $spmipenilaianprodi->programstudi->nama_prodi ?? '';

    // Ambil tahun periode
    $spmiperiodetahun = Spmiperiode::where('id', $spmipenilaianprodi->spmi_periodes_id)->value('tahun');

    // Ambil lembaga dari session
    $spmiperiodelembaga = session()->get('spmipenilaianprodis')
        ->where('id', $id)
        ->first()
        ->lembagas_id;

    // Query elemen
    $query = Spmielemen::where('lembagas_id', $spmipenilaianprodi->lembagas_id);

    // Filter jika S2
    if (str_starts_with($namaProdi, 'S2')) {
        $query->whereNotIn('id', [53, 54, 65]);
    }
    else if (str_starts_with($namaProdi, 'S3')) {
        $query->whereNotIn('id', [53, 54, 65, 71, 72]);
    }
    else if (str_starts_with($namaProdi, 'D4')) {
        $query->whereNotIn('id', [49, 66]);
    }

    // Eksekusi query
    $spmielemens = $query->get();

    // Simpan ke session
    Session::put('spmipenilaianprodi', $spmipenilaianprodi->id);
    session(['penjamuelemen' => request()->fullUrl()]);

    // Return view
    return view("pagesprodi.elemen", [
        'spmielemens' => $spmielemens,
        'userroles' => $userroles,
        'spmiperiodetahun' => $spmiperiodetahun,
        'spmiperiodelembaga' => $spmiperiodelembaga
    ]);
}
//ADD Exclude elemen//

    public function penjamuindikator($id) //$id adalah id dari programstudi
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $programstudi_id = session()->get('programstudi')->id; //ID PROGRAM STUDI
        // $tahun = request('tahun');
        $lembagas_id = request('lembaga');
        $elemen_id = request('elemen');

        $spmipenilaianprodiId = Spmipenilaianprodi::where('programstudis_id', $programstudi_id)
            ->where('lembagas_id', $lembagas_id)
            ->value('id'); //ID SPMI_PENILAIANPRODIS

        $userroles = Userrole::where('users_id', $users->id)->get();
        $spmielemen = Spmielemen::where('id', $elemen_id)->get();

        $spmiindikators = Spmiindikator::where('spmi_elemens_id', $elemen_id)->get();

        // Get strata
        $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

        $spmiindikatorupdate = []; // Menghindari $spmiindikatorupdate not defined
        foreach ($spmiindikators as $spmiindikator) {
            if ($spmiindikator->spmi_tipe_id == 'U') {
                // echo 'okee';
                $spmiindikatorupdate[] = $spmiindikator;
            } else {
                // var_dump($spmiindikator->id);
                // echo '<br>';
                $cek = json_decode($spmiindikator->spmi_tipe_id);
                // var_dump($cek);
                if ($strata->nama_strata == "PROFESI") {
                    $strata->nama_strata = "S2";
                }

                $profesi = ["PROFESI", "PPDS", "PPDSS"];
                if (in_array($strata->nama_strata, $cek)) {
                    // echo 'ada';
                    $spmiindikatorupdate[] = $spmiindikator;
                }
            }
        }




        $spmiindikatorId = Spmiindikator::where('spmi_elemens_id', $id)
            ->value('id'); //ID SPMI_INDIKATORS

        $spmiindikatorsubs = Spmiindikatorsub::whereIn('spmi_indikators_id', $spmiindikators->pluck('id'))->get();

        session(['penjamuindikator' => request()->fullUrl()]);


        return view("pagesprodi.indikator", ['spmiindikators' => $spmiindikatorupdate, 'spmielemen' => $spmielemen, 'userroles' => $userroles, 'spmipenilaianprodiId' => $spmipenilaianprodiId, 'spmiindikatorId' => $spmiindikatorId, 'spmiindikatorsubs' => $spmiindikatorsubs]);
    }

    public function penjamupenilaianindikator(Request $request)
    {
        $spmipenilaianprodiId = $request->input('spmipenilaianprodiId');
        $spmiindikatorId = $request->input('spmiindikatorId');
        $spmiindikatorsubId = $request->spmiindikatorsubId;

        if (!$spmipenilaianprodiId || !$spmiindikatorId) {
            return back()->with('error', 'Data tidak lengkap.');
        }

        // Cek apakah data sudah ada
        $existing = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmipenilaianprodiId)
            ->where('spmi_indikators_id', $spmiindikatorId)
            ->first();

        if (!$existing) {
            // Data belum ada → buat baru
            Spmipenilaianindikator::create([
                'spmi_penilaianprodis_id' => $spmipenilaianprodiId,
                'spmi_indikators_id'      => $spmiindikatorId
            ]);
        }

        // Redirect ke detail
        return redirect()->route('penjamuindikatordetail', [
            'id' => $spmiindikatorId,

        ])
            ->with('success', 'Data penilaian indikator berhasil diproses.')
            ->with('spmiindikatorsubId', $spmiindikatorsubId)
            ->with('spmipenilaianprodiId', $spmipenilaianprodiId);
    }



    public function penjamuindikatorhasil($id)
    {
        $tahun = request('tahun');
        if (!$tahun) {
            abort(400, 'Tahun tidak ditemukan di URL');
        }
        $lembagas_id = request('lembaga');

        // Ambil user dan program studi dari session
        $user = User::where('email', session('user')->email)->firstOrFail();
        $programStudiId = session('programstudi')["id"];

        if ($id != $programStudiId) {
            abort(404, 'ID tidak sesuai');
        }

        // Ambil role user
        $roleId = Userrole::where('users_id', $user->id)->value('roles_id');
        $userroles = Userrole::where('users_id', $user->id)
            ->where('roles_id', session()->get('roles')->id)
            ->get();


        // Ambil Spmipenilaianprodi untuk tahun ini
        $penilaianProdi = Spmipenilaianprodi::where('programstudis_id', $programStudiId)
            ->where('lembagas_id', $lembagas_id)
            ->firstOrFail();
        //dd($penilaianProdi);

        // Cari data indikator berdasarkan id penilaian prodi
        $penilaianindikatorcalc = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianProdi->id)->get();


        // Ambil semua indikator unik yang ada di hasil kalkulasi
        $indikatorIds = $penilaianindikatorcalc->pluck('spmi_indikators_id')->unique();
        $spmiindikators = Spmiindikator::whereIn('id', $indikatorIds)->get();

        // Jika semua status == status saat ini, update atau insert status penilaian prodi
        if ($penilaianindikatorcalc->isNotEmpty()) {
            if ($penilaianindikatorcalc->every(fn($item) => $item->status == 1)) {
                $penilaianProdi->status = 1;
            } elseif ($penilaianindikatorcalc->every(fn($item) => $item->status == 2)) {
                $penilaianProdi->status = 2;
            } elseif ($penilaianindikatorcalc->every(fn($item) => $item->status == 3)) {
                $penilaianProdi->status = 3;
            } elseif ($penilaianindikatorcalc->every(fn($item) => $item->status == 4)) {
                $penilaianProdi->status = 4;
            } elseif ($penilaianindikatorcalc->every(fn($item) => $item->status == 5)) {
                $penilaianProdi->status = 5;
            } elseif ($penilaianindikatorcalc->every(fn($item) => $item->status == 6)) {
                $penilaianProdi->status = 6;
            } elseif ($penilaianindikatorcalc->every(fn($item) => $item->status == 7)) {
                $penilaianProdi->status = 7;
            } elseif ($penilaianindikatorcalc->every(fn($item) => $item->status == 8)) {
                $penilaianProdi->status = 8;
            }
            $penilaianProdi->save();
        }

        $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();


        $errorChart = null;

        try {
            // Membuat Grafik C1 - C9

            // C1
            $spmi_elemens1 = Spmielemen::where('kode', 'C.1')->first();

            $chartsc1 = [];

            foreach ($spmi_elemens1->getSpmiIndikator as $spmi_indikator) {
                if ($spmi_indikator->spmi_tipe_id == 'U') {
                    $spmiindikatorupdate[] = $spmi_indikator;
                    $indikators1[] = [
                        'name' => $spmi_indikator->kode,
                        'max' => 4,
                    ];
                } else {
                    $cek = json_decode($spmi_indikator->spmi_tipe_id);
                    $profesi = ["PROFESI", "PPDS", "PPDSS"];
                    if ($strata->nama_strata == "PROFESI") {
                        $strata->nama_strata = "S2";
                    }
                    if (in_array($strata->nama_strata, $cek)) {
                        $indikators1[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else if (in_array($strata->nama_strata, $profesi)) {
                        $indikators1[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else {
                        continue;
                    }
                }

                $nilai = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianProdi->id)->where('spmi_indikators_id', $spmi_indikator->id)->first();
                $nilai_prodi1[] = round($nilai->nilai_prodi ?? 0, 2);
                $nilai_auditor1[] = round($nilai->nilai_auditor ?? 0, 2);
            }

            $chartsc1 = [
                'indikators' => $indikators1,
                'series' => [
                    [
                        'name' => 'Auditor',
                        'value' => $nilai_auditor1
                    ],
                    [
                        'name' => 'Prodi',
                        'value' => $nilai_prodi1
                    ]
                ]
            ];


            // C2
            $spmi_elemens2 = Spmielemen::where('kode', 'C.2')->first();
            $chartsc2 = [];

            foreach ($spmi_elemens2->getSpmiIndikator as $spmi_indikator) {
                if ($spmi_indikator->spmi_tipe_id == 'U') {
                    $spmiindikatorupdate[] = $spmi_indikator;
                    $indikators2[] = [
                        'name' => $spmi_indikator->kode,
                        'max' => 4,
                    ];
                } else {
                    $cek = json_decode($spmi_indikator->spmi_tipe_id);
                    $profesi = ["PROFESI", "PPDS", "PPDSS"];
                    if ($strata->nama_strata == "PROFESI") {
                        $strata->nama_strata = "S2";
                    }
                    if (in_array($strata->nama_strata, $cek)) {
                        $indikators2[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else if (in_array($strata->nama_strata, $profesi)) {
                        $indikators2[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else {
                        continue;
                    }
                }
                $nilai = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianProdi->id)->where('spmi_indikators_id', $spmi_indikator->id)->first();
                $nilai_prodi2[] = round($nilai->nilai_prodi ?? 0, 2);
                $nilai_auditor2[] = round($nilai->nilai_auditor ?? 0, 2);
            }

            $chartsc2 = [
                'indikators' => $indikators2,
                'series' => [
                    [
                        'name' => 'Auditor',
                        'value' => $nilai_auditor2
                    ],
                    [
                        'name' => 'Prodi',
                        'value' => $nilai_prodi2
                    ]
                ]
            ];

            // C3
            $spmi_elemens3 = Spmielemen::where('kode', 'C.3')->first();
            $chartsc3 = [];

            foreach ($spmi_elemens3->getSpmiIndikator as $spmi_indikator) {
                if ($spmi_indikator->spmi_tipe_id == 'U') {
                    $spmiindikatorupdate[] = $spmi_indikator;
                    $indikators3[] = [
                        'name' => $spmi_indikator->kode,
                        'max' => 4,
                    ];
                } else {
                    $cek = json_decode($spmi_indikator->spmi_tipe_id);
                    $profesi = ["PROFESI", "PPDS", "PPDSS"];
                    if ($strata->nama_strata == "PROFESI") {
                        $strata->nama_strata = "S2";
                    }
                    if (in_array($strata->nama_strata, $cek)) {
                        $indikators3[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else if (in_array($strata->nama_strata, $profesi)) {
                        $indikators3[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else {
                        continue;
                    }
                }
                $nilai = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianProdi->id)->where('spmi_indikators_id', $spmi_indikator->id)->first();
                $nilai_prodi3[] = round($nilai->nilai_prodi ?? 0, 2);
                $nilai_auditor3[] = round($nilai->nilai_auditor ?? 0, 2);
            }

            $chartsc3 = [
                'indikators' => $indikators3,
                'series' => [
                    [
                        'name' => 'Auditor',
                        'value' => $nilai_auditor3
                    ],
                    [
                        'name' => 'Prodi',
                        'value' => $nilai_prodi3
                    ]
                ]
            ];


            // C4
            $spmi_elemens4 = Spmielemen::where('kode', 'C.4')->first();
            $chartsc4 = [];

            foreach ($spmi_elemens4->getSpmiIndikator as $spmi_indikator) {
                if ($spmi_indikator->spmi_tipe_id == 'U') {
                    $spmiindikatorupdate[] = $spmi_indikator;
                    $indikators4[] = [
                        'name' => $spmi_indikator->kode,
                        'max' => 4,
                    ];
                } else {
                    $cek = json_decode($spmi_indikator->spmi_tipe_id);
                    $profesi = ["PROFESI", "PPDS", "PPDSS"];
                    if ($strata->nama_strata == "PROFESI") {
                        $strata->nama_strata = "S2";
                    }

                    if (in_array($strata->nama_strata, $cek)) {
                        $indikators4[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else if (in_array($strata->nama_strata, $profesi)) {
                        $indikators4[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else {
                        continue;
                    }
                }
                $nilai = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianProdi->id)->where('spmi_indikators_id', $spmi_indikator->id)->first();
                $nilai_prodi4[] = round($nilai->nilai_prodi ?? 0, 2);
                $nilai_auditor4[] = round($nilai->nilai_auditor ?? 0, 2);
            }

            $chartsc4 = [
                'indikators' => $indikators4,
                'series' => [
                    [
                        'name' => 'Auditor',
                        'value' => $nilai_auditor4
                    ],
                    [
                        'name' => 'Prodi',
                        'value' => $nilai_prodi4
                    ]
                ]
            ];


            // C5
            $spmi_elemens5 = Spmielemen::where('kode', 'C.5')->first();
            $chartsc5 = [];

            foreach ($spmi_elemens5->getSpmiIndikator as $spmi_indikator) {
                if ($spmi_indikator->spmi_tipe_id == 'U') {
                    $spmiindikatorupdate[] = $spmi_indikator;
                    $indikators5[] = [
                        'name' => $spmi_indikator->kode,
                        'max' => 4,
                    ];
                } else {
                    $cek = json_decode($spmi_indikator->spmi_tipe_id);
                    $profesi = ["PROFESI", "PPDS", "PPDSS"];
                    if ($strata->nama_strata == "PROFESI") {
                        $strata->nama_strata = "S2";
                    }
                    if (in_array($strata->nama_strata, $cek)) {
                        $indikators5[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else if (in_array($strata->nama_strata, $profesi)) {
                        $indikators5[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else {
                        continue;
                    }
                }
                $nilai = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianProdi->id)->where('spmi_indikators_id', $spmi_indikator->id)->first();
                $nilai_prodi5[] = round($nilai->nilai_prodi ?? 0, 2);
                $nilai_auditor5[] = round($nilai->nilai_auditor ?? 0, 2);
            }

            $chartsc5 = [
                'indikators' => $indikators5,
                'series' => [
                    [
                        'name' => 'Auditor',
                        'value' => $nilai_auditor5
                    ],
                    [
                        'name' => 'Prodi',
                        'value' => $nilai_prodi5
                    ]
                ]
            ];


            // C6
            $spmi_elemens6 = Spmielemen::where('kode', 'C.6')->first();
            $chartsc6 = [];

            foreach ($spmi_elemens6->getSpmiIndikator as $spmi_indikator) {
                if ($spmi_indikator->spmi_tipe_id == 'U') {
                    $spmiindikatorupdate[] = $spmi_indikator;
                    $indikators6[] = [
                        'name' => $spmi_indikator->kode,
                        'max' => 4,
                    ];
                } else {
                    $cek = json_decode($spmi_indikator->spmi_tipe_id);
                    $profesi = ["PROFESI", "PPDS", "PPDSS"];
                    if ($strata->nama_strata == "PROFESI") {
                        $strata->nama_strata = "S2";
                    }
                    if (in_array($strata->nama_strata, $cek)) {
                        $indikators6[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else if (in_array($strata->nama_strata, $profesi)) {
                        $indikators6[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else {
                        continue;
                    }
                }
                $nilai = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianProdi->id)->where('spmi_indikators_id', $spmi_indikator->id)->first();
                $nilai_prodi6[] = round($nilai->nilai_prodi ?? 0, 2);
                $nilai_auditor6[] = round($nilai->nilai_auditor ?? 0, 2);
            }

            $chartsc6 = [
                'indikators' => $indikators6,
                'series' => [
                    [
                        'name' => 'Auditor',
                        'value' => $nilai_auditor6
                    ],
                    [
                        'name' => 'Prodi',
                        'value' => $nilai_prodi6
                    ]
                ]
            ];


            // C7
            $spmi_elemens7 = Spmielemen::where('kode', 'C.7')->first();
            $chartsc7 = [];

            foreach ($spmi_elemens7->getSpmiIndikator as $spmi_indikator) {
                if ($spmi_indikator->spmi_tipe_id == 'U') {
                    $spmiindikatorupdate[] = $spmi_indikator;
                    $indikators7[] = [
                        'name' => $spmi_indikator->kode,
                        'max' => 4,
                    ];
                } else {
                    $cek = json_decode($spmi_indikator->spmi_tipe_id);
                    $profesi = ["PROFESI", "PPDS", "PPDSS"];
                    if ($strata->nama_strata == "PROFESI") {
                        $strata->nama_strata = "S2";
                    }
                    if (in_array($strata->nama_strata, $cek)) {
                        $indikators7[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else if (in_array($strata->nama_strata, $profesi)) {
                        $indikators7[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else {
                        continue;
                    }
                }
                $nilai = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianProdi->id)->where('spmi_indikators_id', $spmi_indikator->id)->first();
                $nilai_prodi7[] = round($nilai->nilai_prodi ?? 0, 2);
                $nilai_auditor7[] = round($nilai->nilai_auditor ?? 0, 2);
            }

            $chartsc7 = [
                'indikators' => $indikators7,
                'series' => [
                    [
                        'name' => 'Auditor',
                        'value' => $nilai_auditor7
                    ],
                    [
                        'name' => 'Prodi',
                        'value' => $nilai_prodi7
                    ]
                ]
            ];


            // C8
            $spmi_elemens8 = Spmielemen::where('kode', 'C.8')->first();
            $chartsc8 = [];

            foreach ($spmi_elemens8->getSpmiIndikator as $spmi_indikator) {
                if ($spmi_indikator->spmi_tipe_id == 'U') {
                    $spmiindikatorupdate[] = $spmi_indikator;
                    $indikators8[] = [
                        'name' => $spmi_indikator->kode,
                        'max' => 4,
                    ];
                } else {
                    $cek = json_decode($spmi_indikator->spmi_tipe_id);
                    $profesi = ["PROFESI", "PPDS", "PPDSS"];
                    if (in_array($strata->nama_strata, $cek)) {
                        $indikators8[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else if (in_array($strata->nama_strata, $profesi)) {
                        $indikators8[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else {
                        continue;
                    }
                }
                $nilai = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianProdi->id)->where('spmi_indikators_id', $spmi_indikator->id)->first();
                $nilai_prodi8[] = round($nilai->nilai_prodi ?? 0, 2);
                $nilai_auditor8[] = round($nilai->nilai_auditor ?? 0, 2);
            }

            $chartsc8 = [
                'indikators' => $indikators8,
                'series' => [
                    [
                        'name' => 'Auditor',
                        'value' => $nilai_auditor8
                    ],
                    [
                        'name' => 'Prodi',
                        'value' => $nilai_prodi8
                    ]
                ]
            ];


            // C9
            $spmi_elemens9 = Spmielemen::where('kode', 'C.9')->first();
            $chartsc9 = [];

            foreach ($spmi_elemens9->getSpmiIndikator as $spmi_indikator) {
                if ($spmi_indikator->spmi_tipe_id == 'U') {
                    $spmiindikatorupdate[] = $spmi_indikator;
                    $indikators9[] = [
                        'name' => $spmi_indikator->kode,
                        'max' => 4,
                    ];
                } else {
                    $cek = json_decode($spmi_indikator->spmi_tipe_id);
                    $profesi = ["PROFESI", "PPDS", "PPDSS"];
                    if (in_array($strata->nama_strata, $cek)) {
                        $indikators9[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else if (in_array($strata->nama_strata, $profesi)) {
                        $indikators9[] = [
                            'name' => $spmi_indikator->kode,
                            'max' => 4,
                        ];
                    } else {
                        continue;
                    }
                }
                $nilai = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianProdi->id)->where('spmi_indikators_id', $spmi_indikator->id)->first();
                $nilai_prodi9[] = round($nilai->nilai_prodi ?? 0, 2);
                $nilai_auditor9[] = round($nilai->nilai_auditor ?? 0, 2);
            }

            $chartsc9 = [
                'indikators' => $indikators9,
                'series' => [
                    [
                        'name' => 'Auditor',
                        'value' => $nilai_auditor9
                    ],
                    [
                        'name' => 'Prodi',
                        'value' => $nilai_prodi9
                    ]
                ]
            ];
        } catch (\Exception $e) {

            $chartsc1 = $chartsc2 = $chartsc3 = $chartsc4 = $chartsc5 = $chartsc6 = $chartsc7 = $chartsc8 = $chartsc9 = [];
            $errorChart = "Data diagram tidak berhasil diproses";
        }


        return view('pagesprodi.indikatorhasil', [
            'userroles' => $userroles,
            'penilaianindikatorcalc' => $penilaianindikatorcalc,
            'spmiindikators' => $spmiindikators,
            'penilaianProdi' => $penilaianProdi,
            'strata' => $strata,
            'chartsc1' => $chartsc1,
            'chartsc2' => $chartsc2,
            'chartsc3' => $chartsc3,
            'chartsc4' => $chartsc4,
            'chartsc5' => $chartsc5,
            'chartsc6' => $chartsc6,
            'chartsc7' => $chartsc7,
            'chartsc8' => $chartsc8,
            'chartsc9' => $chartsc9,
            'errorChart' => $errorChart,
        ]);
    }



    public function penjamuindikatordetail($id)
    {
        $spmiindikatorsubId = session('spmiindikatorsubId');

        $spmipenilaianprodiId = session()->get('spmipenilaianprodi');

        $userskapusspmi = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where(['users_id' => $userskapusspmi->id])->get(); // Cek roles Kapus Penjamu Internal
        $users       = session('user');
        /**
         * kadep = 10
         * audior = 12
         * dekan = 7
         * prodi = 9
         */
        $roleakadep = ($users && $users["id"])
            ? Userrole::where('users_id', $users["id"])
            ->where('roles_id', 10)
            ->exists()
            : false;
        $roleauditor = ($users && $users["id"])
            ? Userrole::where('users_id', $users["id"])
            ->where('roles_id', 12)
            ->exists()
            : false;
        $roledekan = ($users && $users["id"])
            ? Userrole::where('users_id', $users["id"])
            ->where('roles_id', 7)
            ->exists()
            : false;

        $roleprodi = ($users && $users["id"])
            ? Userrole::where('users_id', $users["id"])
            ->where('roles_id', 9)
            ->exists()
            : false;



        $programStudiId = Userprogramstudi::where('users_id', $users->id)
            ->value('programstudis_id');
        $allUserIdsInProdi = Userprogramstudi::where('programstudis_id', $programStudiId)
            ->pluck('users_id');
        $auditorUserIds = Userrole::whereIn('users_id', $allUserIdsInProdi)
            ->where('roles_id', 12)
            ->pluck('users_id')
            ->toArray();
        $auditorUsers = \App\Models\User::whereIn('id', $auditorUserIds)->get();

        //dd($programStudiId);
        $spmipenilaianprodi = Spmipenilaianprodi::where('id', $spmipenilaianprodiId)->first();

        $spmipenilaianindikator = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmipenilaianprodi->id)->where('spmi_indikators_id', $id)->get();
        $spmipenilaianindikatorcalc = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmipenilaianprodi->id)
            ->where('spmi_indikators_id', $id)
            ->first();
        //dd($spmipenilaianindikatorcalc);
        $spmiindikator = Spmiindikator::where('id', $id)->get();
        $spmiindikatorsubs = Spmiindikatorsub::where('spmi_indikators_id', $id)->get();

        $spmikategorijenistemuans = Spmikategorijenistemuan::all();


        if (@$spmipenilaianindikator[0]) {

            return view("pagesprodi.indikatordetail", ['spmipenilaianindikatorcalc' => $spmipenilaianindikatorcalc, 'roledekan' => $roledekan, 'userroles' => $userroles, 'auditorUsers' => $auditorUsers, 'rolekadep' => $roleakadep, 'roleprodi' => $roleprodi, 'roleauditor' => $roleauditor, 'spmiindikator' => $spmiindikator, 'spmiindikatorsubs' => @$spmiindikatorsubs, 'spmikategorijenistemuans' => $spmikategorijenistemuans, "spmipenilaianprodi" => $spmipenilaianprodi, 'spmipenilaianindikator' => $spmipenilaianindikator[0]]);
        } else {
            return view("pagesprodi.indikatordetail", ['spmipenilaianindikatorcalc' => $spmipenilaianindikatorcalc, 'roledekan' => $roledekan, 'userroles' => $userroles, 'auditorUsers' => $auditorUsers, 'rolekadep' => $roleakadep, 'roleprodi' => $roleprodi, 'roleauditor' => $roleauditor, 'spmiindikator' => $spmiindikator, 'spmiindikatorsubs' => @$spmiindikatorsubs, 'spmikategorijenistemuans' => $spmikategorijenistemuans, "spmipenilaianprodi" => $spmipenilaianprodi]);
        }
    }

    public function penjamuindikatordetail_store(Request $request)
    {
        $spmipenilaianindikator = new Spmipenilaianindikator;
        $request->validate([
            'fileupload' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,txt,xls,xlsx|max:5120',
        ]);


        // public/uploads
        if ($request->hasFile('fileupload')) {
            $file = $request->file('fileupload');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('uploads');
            $file->move($destinationPath, $filename);

            $spmipenilaianindikator->berkas = 'uploads/' . $filename;
        }

        $spmipenilaianindikator->spmi_indikators_id = $request->spmi_indikators_id;
        $spmipenilaianindikator->spmi_indikatorsubs_id = $request->spmi_indikatorsubs_id;
        // $spmipenilaianindikator->nilai_prodi = $request->nilai_prodi;
        $spmipenilaianindikator->link = $request->link;
        $spmipenilaianindikator->catatan_prodi = $request->catatan_prodi;
        $spmipenilaianindikator->akar_masalah_temuan = $request->akar_masalah_temuan;
        $spmipenilaianindikator->spmi_penilaianprodis_id = $request->spmi_penilaianprodis_id;

        $spmipenilaianindikator->perhatian = 1;
        $spmipenilaianindikator->save();



        // Post::create($validated);

        return redirect()->back()->with('success', 'Post created successfully!')->with('spmipenilaianprodiId', $request->spmi_penilaianprodis_id);
    }

    public function penjamuindikatorkualitatif_update(Request $request)
    {
        $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmi_penilaianindikator_id);
        $spmipenilaianindikator->nilai_prodi = $request->nilai_prodi;
        $spmipenilaianindikator->perhatian = 1;
        $spmipenilaianindikator->save();



        // Post::create($validated);

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function penjamuindikatordetail_update(Request $request, $id)
    {

        $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($id);

        $request->validate([
            'fileupload' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,txt,xls,xlsx|max:5120',
        ]);

        // public/uploads
        if ($request->hasFile('fileupload')) {
            $file = $request->file('fileupload');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('uploads');

            if ($spmipenilaianindikator->berkas && file_exists(public_path($spmipenilaianindikator->berkas))) {
                unlink(public_path($spmipenilaianindikator->berkas));
            }

            $file->move($destinationPath, $filename);
            $spmipenilaianindikator->berkas = 'uploads/' . $filename;
        }


        $spmipenilaianindikator->spmi_indikators_id = $request->spmi_indikators_id;
        // $spmipenilaianindikator->spmi_indikatorsubs_id = $request->spmi_indikatorsubs_id;
        // $spmipenilaianindikator->nilai_prodi = $request->nilai_prodi;
        $spmipenilaianindikator->link = $request->link;
        $spmipenilaianindikator->catatan_prodi = $request->catatan_prodi;
        $spmipenilaianindikator->akar_masalah_temuan = $request->akar_masalah_temuan;
        $spmipenilaianindikator->spmi_penilaianprodis_id = $request->spmi_penilaianprodis_id;

        $spmipenilaianindikator->perhatian = 1;
        $spmipenilaianindikator->save();

        // Post::create($validated);

        return redirect()->back()->with('success', 'Post created successfully!')->with('spmipenilaianprodiId', $request->spmi_penilaianprodis_id);
    }

    public function penjamuindikatorsubdetail_store(Request $request)
    {
        $data = $request->validate([
            'spmi_indikatorsubs_id'   => 'required|integer|exists:spmi_indikatorsubs,id',
            'nilai_prodi'             => 'required|numeric',
            'spmi_penilaianprodis_id' => 'required|integer|exists:spmi_penilaianprodis,id',
            'auditor'                 => 'sometimes|integer',
        ]);

        // 1) Cari parent indikator dari indikator-sub
        $sub = SpmiIndikatorsub::findOrFail($data['spmi_indikatorsubs_id']);

        // 2) Cek apakah ada baris existing dengan subs_id NULL
        $existing = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $data['spmi_penilaianprodis_id'])
            ->where('spmi_indikators_id',      $sub->spmi_indikators_id)
            ->whereNull('spmi_indikatorsubs_id')
            ->first();

        if ($existing) {
            // 3a) Kalau ada, update baris itu saja
            $existing->spmi_indikatorsubs_id = $sub->id;
            $existing->nilai_prodi           = $data['nilai_prodi'];
            if (isset($data['auditor'])) {
                $existing->nilai_auditor = $data['nilai_prodi'];
            }
            $existing->save();
        } else {
            // 3b) Kalau tidak ada (semua baris grouping sudah diisi), buat baris baru
            $new = new Spmipenilaianindikator();
            $new->spmi_indikators_id      = $sub->spmi_indikators_id;
            $new->spmi_indikatorsubs_id   = $sub->id;
            $new->nilai_prodi             = $data['nilai_prodi'];
            $new->spmi_penilaianprodis_id = $data['spmi_penilaianprodis_id'];
            if (isset($data['auditor'])) {
                $new->nilai_auditor = $data['nilai_prodi'];
            }
            $new->save();
        }

        return back()->with('success', 'Penilaian sub berhasil disimpan');
    }


    public function penjamuindikatorsubdetail_update(Request $request, $id)
    {
        // 1. Validasi input
        $data = $request->validate([
            'spmi_indikatorsubs_id'   => 'required|integer|exists:spmi_indikatorsubs,id',
            'nilai_prodi'             => 'required|numeric',
            'spmi_penilaianprodis_id' => 'required|integer|exists:spmi_penilaianprodis,id',
            'auditor'                 => 'sometimes|integer',
        ]);

        // 2. Ambil model yang akan di‐update
        $model = Spmipenilaianindikator::findOrFail($id);

        // 3. Cari parent indikator dari indikator‐sub
        $sub = SpmiIndikatorsub::findOrFail($data['spmi_indikatorsubs_id']);

        // 4. Cek apakah user mengubah penilaianprodis_id
        $newProdiId = $data['spmi_penilaianprodis_id'];
        $oldProdiId = $model->spmi_penilaianprodis_id;

        if ($newProdiId !== $oldProdiId) {
            // 4a. Cek apakah sudah ada record untuk kombinasi baru
            $existing = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $newProdiId)
                ->where('spmi_indikators_id', $sub->spmi_indikators_id)
                ->where('spmi_indikatorsubs_id', $sub->id)
                ->first();

            if ($existing) {
                // Opsional: update record existing itu saja
                $target = $existing;
            } else {
                // Buat record baru
                $target = new Spmipenilaianindikator();
                $target->spmi_penilaianprodis_id = $newProdiId;
                $target->spmi_indikators_id      = $sub->spmi_indikators_id;
                $target->spmi_indikatorsubs_id   = $sub->id;
            }
        } else {
            // 4b. Tidak pindah prodi → kita update baris yang sama
            $target = $model;
        }

        // 5. Set nilai nilai_prodi / nilai_auditor
        if (isset($data['auditor']) && $data['auditor'] == 1) {
            $target->nilai_auditor = $data['nilai_prodi'];
        } else {
            $target->nilai_prodi = $data['nilai_prodi'];
        }

        // 6. Simpan
        $target->save();

        return back()->with('success', 'Penilaian sub berhasil di‐update');
    }



    public function penjamukomponen_store(Request $request)
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
            'komponens.*.nilai_prodi' => 'numeric',
            'komponens.*.spmi_indikatorkomponens_id' => 'numeric',
        ]);

        // Prepare the data for batch insert
        $komponens = [];
        foreach ($validated['komponens'] as $komponen) {
            $komponens[] = [
                'id' => $komponen['id'] ?? null,
                'spmi_penilaianindikators_id' => $spmi_penilaianindikators_id,
                'spmi_indikatorkomponens_id' => $komponen['spmi_indikatorkomponens_id'],
                'nilai_prodi' => $komponen['nilai_prodi'],
                // 'nilai_auditor' => 0,
                'created_at' => now(),
            ];
        }

        // Laravel upsert: (array $values, array $uniqueBy, array $update)
        Spmipindikatorkomponen::upsert(
            $komponens,
            ['id'],               // Column to check for existing record (unique key)
            ['nilai_prodi', 'updated_at']  // Columns to update if exists
        );
        // Spmipindikatorkomponen::insert($komponens);

        return redirect()->back()->with('success', 'Post created successfully!');
    }


    public function penilaiancalculate(Request $request)
    {
        // Validate the request (optional but recommended)
        $validated = $request->validate([
            'spmi_penilaianprodis_id' => 'numeric',
            'spmipenilaianindikator_id' => 'numeric',
            'spmi_indikators_id' => 'numeric',
            'spmi_indikators_kode' => 'string'
        ]);
        //dd($request);

        try {
            if ($request->spmi_indikators_kode == 'C.2.4.a') {
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 1)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 2)->first()->nilai_prodi;
                $result = $this->c2->c24asub($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.2.4.b') {
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 3)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 4)->first()->nilai_prodi;
                $result = $this->c2->c24bsub($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.2.4.d') {
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 6)->first()->nilai_prodi;

                $result = $this->c2->c24d($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.3.4.a') {
                $spmipenilaianindikators_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 7)->first()->id;
                $Pilihan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmipenilaianindikators_id)->where('spmi_indikatorkomponens_id', 8)->first()->nilai_prodi;
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 8)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 9)->first()->nilai_prodi;

                $result = $this->c3->c34a($Pilihan, $a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.3.4.av') {

                $spmipenilaianindikators_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 37)->first()->id;
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmipenilaianindikators_id)->where('spmi_indikatorkomponens_id', 285)->first()->nilai_prodi;

                $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmipenilaianindikators_id)->where('spmi_indikatorkomponens_id', 286)->first()->nilai_prodi;
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 36)->first()->nilai_prodi;

                $result = $this->c3->c34av($NA, $NB, $a);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.3.4.b') {

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 10)->first();
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 11)->first();


                $result = $this->c3->c34b($a->nilai_prodi, $b->nilai_prodi);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.3.4.c') {

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 12)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 13)->first()->nilai_prodi;

                $result = $this->c3->c34c($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.3.4.d') {

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 31)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 32)->first()->nilai_prodi;
                $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 33)->first()->nilai_prodi;

                $result = $this->c3->c34d($a, $b, $c);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.3.4.e') {

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 34)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 35)->first()->nilai_prodi;

                $result = $this->c3->c34e($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.a1') {


                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44a1($NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.a2') {


                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NDS3 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 15)->first()->nilai_prodi;
                $result = $this->c4->c44a2($NDS3, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.a3') {


                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 17)->first()->nilai_prodi;
                $NDLK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 18)->first()->nilai_prodi;
                $NDL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 19)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c4->c44a3($NDGB, $NDLK, $NDL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.a4') {
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                if ($strata->nama_strata == "S1") {
                    $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                    $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                    $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                    $spmi_penilaianindikator_id_pilihan = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 7)->first()->id;
                    $pilihan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id_pilihan)->where('spmi_indikatorkomponens_id', 8)->first()->nilai_prodi;
                    $rendah = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 9)->first()->nilai_prodi;
                    $kelompok = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 20)->first()->nilai_prodi;
                    $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 21)->first()->nilai_prodi;

                    $result = $this->c4->c44a4($kelompok, $NM, $NDTPS, $pilihan, $rendah);
                } else if ($strata->nama_strata == "D4") {
                    $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                    $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                    $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                    $kelompok = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 20)->first()->nilai_prodi;
                    $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 21)->first()->nilai_prodi;

                    $result = $this->c4->c44a4v($kelompok, $NM, $NDTPS);
                }



                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.a5') {

                $RDPUPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 23)->first()->nilai_prodi;
                $RDPUL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 24)->first()->nilai_prodi;
                $result = $this->c4->c44a5($RDPUPS, $RDPUL);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.a6') {

                $EWMPDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 26)->first()->nilai_prodi;
                $EWMPDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 27)->first()->nilai_prodi;
                $result = $this->c4->c44a6($EWMPDT, $EWMPDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.a6v') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NDSK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 272)->first()->nilai_prodi;
                $result = $this->c4->c44a6v($NDTPS, $NDSK);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.a7') {

                $NDTT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 29)->first()->nilai_prodi;
                $NDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 30)->first()->nilai_prodi;
                $result = $this->c4->c44a7($NDTT, $NDT);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.a7v') {

                $MKKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 273)->first()->nilai_prodi;
                $MKK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 274)->first()->nilai_prodi;
                $result = $this->c4->c44a7v($MKKI, $MKK);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.b1') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NRD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 32)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b1($NRD, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.b2') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 33)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 34)->first()->nilai_prodi;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 35)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b2($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.b3') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 39)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 40)->first()->nilai_prodi;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 41)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b3($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.b3v') {


                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NRD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 283)->first()->nilai_prodi;
                $result = $this->c4->c44b3v($NRD, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.b4') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 45)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 46)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 47)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 48)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 49)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 50)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 51)->first()->nilai_prodi,
                    'NC1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 52)->first()->nilai_prodi,
                    'NC2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 53)->first()->nilai_prodi,
                    'NC3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 54)->first()->nilai_prodi,
                ];
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b4($data, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.b5') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 58)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c4->c44b5($NAS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.b6') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 59)->first()->nilai_prodi;
                $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 60)->first()->nilai_prodi;
                $NC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 61)->first()->nilai_prodi;
                $ND = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 62)->first()->nilai_prodi;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c4->c44b6($NA, $NB, $NC, $ND, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.b7v') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 275)->first()->nilai_prodi;
                $result = $this->c4->c44a6v($NDTPS, $NAPJ);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.b6m') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 278)->first()->nilai_prodi;
                $result = $this->c4->c44b6m($NDTPS, $NAS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.c') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id',$spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id',5)->first()->id;

                $data = [
                    'c44a1' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 17)->first()->nilai_prodi ?? 0,
                    'c44a2' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 18)->first()->nilai_prodi ?? 0,
                    'c44a3' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 19)->first()->nilai_prodi ?? 0,
                    'c44a4' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 20)->first()->nilai_prodi ?? 0,
                    'c44a5' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 21)->first()->nilai_prodi ?? 0,
                    'c44a6' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 22)->first()->nilai_prodi ?? 0,
                    'c44a7' => Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 23)->first()->nilai_prodi ?? 0,
                ];
                $c44c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 30)->first()->nilai_prodi;

                $result = $this->c4->c44ckomp($data, $c44c);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.4.4.d') {

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 14)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 15)->first()->nilai_prodi;

                $result = $this->c4->c44d($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.5.4.a1') {

                // $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 20)->first()->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 287)->first()->nilai_prodi;
                $BOP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 65)->first()->nilai_prodi;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c5->c54a1($BOP, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.5.4.a2') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $DP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 67)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c5->c54a2($DP, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.5.4.a3') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $DPKM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 69)->first()->nilai_prodi;

                $result = $this->c5->c54a3($DPKM, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.5.4.a4') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $data = [
                    'c44a1' => Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 17)->first()->nilai_prodi ?? 0,
                    'c44a2' => Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 18)->first()->nilai_prodi ?? 0,
                    'c44a3' => Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 19)->first()->nilai_prodi ?? 0,
                    'c44a4' => Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 20)->first()->nilai_prodi ?? 0,
                    'c44a5' => Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 21)->first()->nilai_prodi ?? 0,
                    'c44a6' => Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 22)->first()->nilai_prodi ?? 0,
                    'c44a7' => Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 23)->first()->nilai_prodi ?? 0,
                ];
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $c54a4 = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 35)->first()->nilai_prodi;

                $result = $this->c5->c54a4ckomp($data, $c54a4, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.6.4.a') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 16)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 17)->first()->nilai_prodi;
                $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 18)->first()->nilai_prodi;


                $result = $this->c6->c64a($a, $b, $c);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.6.4.c') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 19)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 20)->first()->nilai_prodi;


                $result = $this->c6->c64c($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.6.4.d1') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 21)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 22)->first()->nilai_prodi;
                $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 23)->first()->nilai_prodi;
                $d = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 24)->first()->nilai_prodi;
                $e = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 25)->first()->nilai_prodi;


                $result = $this->c6->c64d1($a, $b, $c, $d, $e);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.6.4.d2') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $JP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 72)->first()->nilai_prodi;
                $JB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 73)->first()->nilai_prodi;


                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c6->c64d2($JP, $JB, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.6.4.f') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 26)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 27)->first()->nilai_prodi;
                $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 28)->first()->nilai_prodi;



                $result = $this->c6->c64f($a, $b, $c);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.6.4.g') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $MK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 75)->first()->nilai_prodi;


                $result = $this->c6->c64g($MK);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.6.4.j') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $MKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 279)->first()->nilai_prodi;
                $MK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 280)->first()->nilai_prodi;



                $result = $this->c6->c64j($MKI, $MK);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.6.4.i') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 29)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 30)->first()->nilai_prodi;


                $result = $this->c6->c64i($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.7.4.b') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $NPM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 102)->first()->nilai_prodi;
                $NPKMD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 103)->first()->nilai_prodi;


                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c7->c74b($NPM, $NPKMD, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.7.4.cm') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $NPM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 281)->first()->nilai_prodi;
                $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 282)->first()->nilai_prodi;


                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c7->c74cm($NPM, $NPD, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.8.4.b') {


                $NPKMM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 105)->first()->nilai_prodi;
                $NPKMD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 106)->first()->nilai_prodi;


                $result = $this->c8->c84b($NPKMM, $NPKMD);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.a2') {

                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 108)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 109)->first()->nilai_prodi,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 110)->first()->nilai_prodi,
                ];

                $ipk = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 111)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 112)->first()->nilai_prodi,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 113)->first()->nilai_prodi,
                ];
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c9->c94a2($lulusan, $ipk, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.a3') {


                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 115)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 116)->first()->nilai_prodi;
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 117)->first()->nilai_prodi;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 118)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c9->c94a3($NI, $NN, $NW, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.a4') {


                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 122)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 123)->first()->nilai_prodi;
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 124)->first()->nilai_prodi;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 125)->first()->nilai_prodi;
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
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 289)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 290)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 291)->first()->nilai_prodi,
                    ];
                } else if ($strata->nama_strata == "S3") {
                    $lulusan = [
                        'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 293)->first()->nilai_prodi,
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 294)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 295)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 296)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 297)->first()->nilai_prodi,
                    ];
                } else {
                    $lulusan = [
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 130)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 131)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 132)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 133)->first()->nilai_prodi,
                    ];
                }

                $result = $this->c9->c94a5($lulusan, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.a6') {
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                if ($strata->nama_strata == "S2") {
                    $diterima = [
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 298)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 299)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 300)->first()->nilai_prodi,
                    ];
                    $lulusan = [
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 301)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 302)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 303)->first()->nilai_prodi,
                    ];
                } else if ($strata->nama_strata == "S3") {
                    $diterima = [
                        'ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 304)->first()->nilai_prodi,
                        'ts5' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 305)->first()->nilai_prodi,
                        'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 306)->first()->nilai_prodi,
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 307)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 308)->first()->nilai_prodi,
                    ];
                    $lulusan = [
                        'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 309)->first()->nilai_prodi,
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 310)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 311)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 312)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 313)->first()->nilai_prodi,
                    ];
                } else {

                    $diterima = [
                        'ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 135)->first()->nilai_prodi,
                        'ts5' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 136)->first()->nilai_prodi,
                        'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 137)->first()->nilai_prodi,
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 138)->first()->nilai_prodi,
                    ];
                    $lulusan = [
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 139)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 140)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 141)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 142)->first()->nilai_prodi,
                    ];
                }


                $result = $this->c9->c94a6($diterima, $lulusan, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.a7') {
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                if ($strata->nama_strata == "S2") {
                    $dt = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 314)->first()->nilai_prodi;
                    $lulusan = [
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 315)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 316)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 317)->first()->nilai_prodi,
                    ];
                } else if ($strata->nama_strata == "S3") {
                    $dt = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 318)->first()->nilai_prodi;
                    $lulusan = [
                        'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 319)->first()->nilai_prodi,
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 320)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 321)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 322)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 323)->first()->nilai_prodi,
                    ];
                } else {
                    $dt = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 144)->first()->nilai_prodi;
                    $lulusan = [
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 145)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 146)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 147)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 148)->first()->nilai_prodi,
                    ];
                }
                $result = $this->c9->c94a7($lulusan, $dt, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.a9') {
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 150)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 151)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 152)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 153)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 154)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 155)->first()->nilai_prodi,
                ];

                $tahunlulus = [
                    'tlts4wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 159)->first()->nilai_prodi,
                    'tlts4wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 160)->first()->nilai_prodi,
                    'tlts4wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 161)->first()->nilai_prodi,
                    'tlts3wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 162)->first()->nilai_prodi,
                    'tlts3wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 163)->first()->nilai_prodi,
                    'tlts3wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 164)->first()->nilai_prodi,
                    'tlts2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 165)->first()->nilai_prodi,
                    'tlts2wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 166)->first()->nilai_prodi,
                    'tlts2wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 167)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a9($lulusan, $lulusanterlacak, $tahunlulus);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.a10') {
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 169)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 170)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 171)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 172)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 173)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 174)->first()->nilai_prodi,
                ];

                $kesesuaianlulusan = [
                    'tlts4wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 178)->first()->nilai_prodi,
                    'tlts4wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 179)->first()->nilai_prodi,
                    'tlts4wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 180)->first()->nilai_prodi,
                    'tlts3wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 181)->first()->nilai_prodi,
                    'tlts3wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 182)->first()->nilai_prodi,
                    'tlts3wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 183)->first()->nilai_prodi,
                    'tlts2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 184)->first()->nilai_prodi,
                    'tlts2wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 185)->first()->nilai_prodi,
                    'tlts2wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 186)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a10($lulusan, $lulusanterlacak, $kesesuaianlulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.a11') {
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 188)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 189)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 190)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 191)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 192)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 193)->first()->nilai_prodi,
                ];

                $lulusantingkat = [
                    'NIts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 197)->first()->nilai_prodi,
                    'NNts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 198)->first()->nilai_prodi,
                    'NWts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 199)->first()->nilai_prodi,
                    'NIts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 200)->first()->nilai_prodi,
                    'NNts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 201)->first()->nilai_prodi,
                    'NWts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 202)->first()->nilai_prodi,
                    'NIts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 203)->first()->nilai_prodi,
                    'NNts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 204)->first()->nilai_prodi,
                    'NWts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 205)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a11($lulusan, $lulusanterlacak, $lulusantingkat);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.a12') {
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 209)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 210)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 211)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 212)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 213)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 214)->first()->nilai_prodi,
                ];

                $penggunalulusan = [
                    'etika_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 218)->first()->nilai_prodi,
                    'etika_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 219)->first()->nilai_prodi,
                    'etika_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 220)->first()->nilai_prodi,
                    'etika_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 221)->first()->nilai_prodi,

                    'keahlian_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 223)->first()->nilai_prodi,
                    'keahlian_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 224)->first()->nilai_prodi,
                    'keahlian_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 225)->first()->nilai_prodi,
                    'keahlian_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 226)->first()->nilai_prodi,

                    'bahasa_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 228)->first()->nilai_prodi,
                    'bahasa_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 229)->first()->nilai_prodi,
                    'bahasa_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 230)->first()->nilai_prodi,
                    'bahasa_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 231)->first()->nilai_prodi,

                    'teknologiinformasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 233)->first()->nilai_prodi,
                    'teknologiinformasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 234)->first()->nilai_prodi,
                    'teknologiinformasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 235)->first()->nilai_prodi,
                    'teknologiinformasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 236)->first()->nilai_prodi,

                    'komunikasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 238)->first()->nilai_prodi,
                    'komunikasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 239)->first()->nilai_prodi,
                    'komunikasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 240)->first()->nilai_prodi,
                    'komunikasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 241)->first()->nilai_prodi,

                    'kerjasama_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 243)->first()->nilai_prodi,
                    'kerjasama_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 244)->first()->nilai_prodi,
                    'kerjasama_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 245)->first()->nilai_prodi,
                    'kerjasama_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 246)->first()->nilai_prodi,

                    'pengembangandiri_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 248)->first()->nilai_prodi,
                    'pengembangandiri_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 249)->first()->nilai_prodi,
                    'pengembangandiri_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 250)->first()->nilai_prodi,
                    'pengembangandiri_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 251)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a12($lulusan, $lulusanterlacak, $penggunalulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.b1') {
                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 253)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 254)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 255)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 256)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 257)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 258)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 259)->first()->nilai_prodi,
                    'NC1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 260)->first()->nilai_prodi,
                    'NC2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 261)->first()->nilai_prodi,
                    'NC3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 262)->first()->nilai_prodi,
                ];


                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 263)->first()->nilai_prodi;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c9->c94b1($data, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.b2') {

                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 267)->first()->nilai_prodi;
                $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 268)->first()->nilai_prodi;
                $NC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 269)->first()->nilai_prodi;
                $ND = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 270)->first()->nilai_prodi;

                $result = $this->c9->c94b2($NA, $NB, $NC, $ND);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.b3v') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 5)->first()->id;
                // $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 4)->first()->nilai_prodi;
                $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 276)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c9->c94b3v($NAPJ, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.b3') {

                $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 277)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c9->c94b3($NAS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'C.9.4.b1d') {

                $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 284)->first()->nilai_prodi;
                $result = $this->c9->c94b1d($NAS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            // $spmipenilaianindikator->nilai_prodi = $result;
            // $spmipenilaianindikator->save();
            else {
                $indikator = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)
                    ->where('spmi_indikators_id', $request->input('spmi_indikators_id'))
                    ->first();

                $result = $indikator ? $indikator->nilai_prodi : null;
            }
            //dd($result);
            $spmipenilaianindikatorcalc = Spmipenilaianindikatorscalc::where([
                'spmi_penilaianprodis_id' => $request->input('spmi_penilaianprodis_id'),
                'spmi_indikators_id' => $request->input('spmi_indikators_id')
            ])->first();

            if ($spmipenilaianindikatorcalc) {
                //dd($spmipenilaianindikatorcalc);
                $spmipenilaianindikatorcalc->nilai_prodi = $result;
                $spmipenilaianindikatorcalc->status = 1;
                $spmipenilaianindikatorcalc->save();
            } else {
                // Jika tidak ada, insert baru
                Spmipenilaianindikatorscalc::create([
                    'spmi_penilaianprodis_id' => $request->input('spmi_penilaianprodis_id'),
                    'spmi_indikators_id' => $request->input('spmi_indikators_id'),
                    'nilai_prodi' => $result,
                    'status' => 1
                ]);
            }
            return redirect()->back()->with('successPenilaianCalculate', 'Data tersimpan!');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withErrors(['errorPenilaianCalculate' => 'Gagal menghitung penilaian: Data tidak lengkap.']);
        }
    }

    public function komponencalculate(Request $request)
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
                $result = $this->c2->c24dsubkoma($N1->nilai_prodi, $N2->nilai_prodi, $N3->nilai_prodi, $NDT->nilai_prodi, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 6) {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 5)->first();
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 6)->first();
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 7)->first();
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c2->c24dsubkomb($NI->nilai_prodi, $NN->nilai_prodi, $NW->nilai_prodi, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 8) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',8)->first()->nilai_prodi;
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 9)->first();
                $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 10)->first();

                // $result = $this->c3->c34asub1($NA, $NB);
                $result = $this->c3->c34asub1($NA->nilai_prodi, $NB->nilai_prodi);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 11) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',8)->first()->nilai_prodi;
                $NMUPPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 11)->first();
                $NMAFT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 12)->first();
                $NMAPT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 13)->first();
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c3->c34bsubb($NMUPPS->nilai_prodi, $NMAFT->nilai_prodi, $NMAPT->nilai_prodi, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 29) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',8)->first()->nilai_prodi;
                $kepuasan = [
                    'reliability_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 76)->first()->nilai_prodi,
                    'reliability_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 77)->first()->nilai_prodi,
                    'reliability_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 78)->first()->nilai_prodi,
                    'reliability_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 79)->first()->nilai_prodi,

                    'responsiveness_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 81)->first()->nilai_prodi,
                    'responsiveness_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 82)->first()->nilai_prodi,
                    'responsiveness_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 83)->first()->nilai_prodi,
                    'responsiveness_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 84)->first()->nilai_prodi,

                    'assurance_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 86)->first()->nilai_prodi,
                    'assurance_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 87)->first()->nilai_prodi,
                    'assurance_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 88)->first()->nilai_prodi,
                    'assurance_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 89)->first()->nilai_prodi,

                    'empathy_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 91)->first()->nilai_prodi,
                    'empathy_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 92)->first()->nilai_prodi,
                    'empathy_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 93)->first()->nilai_prodi,
                    'empathy_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 94)->first()->nilai_prodi,

                    'tangible_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 96)->first()->nilai_prodi,
                    'tangible_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 97)->first()->nilai_prodi,
                    'tangible_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 98)->first()->nilai_prodi,
                    'tangible_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 99)->first()->nilai_prodi,
                ];

                $kepuasan = [
                    'reliability_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 76)->first()->nilai_prodi,
                    'reliability_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 77)->first()->nilai_prodi,
                    'reliability_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 78)->first()->nilai_prodi,
                    'reliability_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 79)->first()->nilai_prodi,

                    'responsiveness_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 81)->first()->nilai_prodi,
                    'responsiveness_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 82)->first()->nilai_prodi,
                    'responsiveness_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 83)->first()->nilai_prodi,
                    'responsiveness_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 84)->first()->nilai_prodi,

                    'assurance_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 86)->first()->nilai_prodi,
                    'assurance_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 87)->first()->nilai_prodi,
                    'assurance_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 88)->first()->nilai_prodi,
                    'assurance_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 89)->first()->nilai_prodi,

                    'empathy_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 91)->first()->nilai_prodi,
                    'empathy_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 92)->first()->nilai_prodi,
                    'empathy_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 93)->first()->nilai_prodi,
                    'empathy_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 94)->first()->nilai_prodi,

                    'tangible_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 96)->first()->nilai_prodi,
                    'tangible_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 97)->first()->nilai_prodi,
                    'tangible_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 98)->first()->nilai_prodi,
                    'tangible_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 99)->first()->nilai_prodi,
                ];

                $result = $this->c6->c64itkm($kepuasan);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else {
                $indikator = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)
                    ->where('spmi_indikatorkomponens_id', $request->input('spmi_indikatorsubs_id'))
                    ->first();

                $result = $indikator ? $indikator->nilai_prodi : null;
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            }

            //dd($result);

            $spmipenilaianindikator->nilai_prodi = $result;
            $spmipenilaianindikator->save();

            return redirect()->back()->with('successPenilaianCalculate', 'Data tersimpan!');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withErrors(['errorPenilaianCalculate' => 'Gagal menghitung penilaian: Data tidak lengkap.']);
        }
    }

    public function laporangenerate(Request $request)
    {
        $tahun = $request->tahun;

        if (!$tahun) {
            abort(400, 'Tahun tidak ditemukan di URL');
        }

        // Ambil user dan program studi dari session
        $user = User::where('email', session('user')->email)->firstOrFail();
        $programStudiId = session('programstudi')["id"];

        if ($request->program_studiid != $programStudiId) {
            abort(404, 'ID tidak sesuai');
        } else {
            $nama_programstudi = session('programstudi')->nama_prodi;
            $fakultas = Fakultas::findOrFail(session('programstudi')->fakultass_id);
        }

        // Get Auditor Jika sudah Assign
        $cek_auditor = Userprogramstudi::where('programstudis_id', $programStudiId)->where('tahun', $tahun)->first();
        if (!$cek_auditor) {
            $auditor = "Belum Ada Auditor";
        } else {

            $auditor = User::findOrFail($cek_auditor->users_id)->name;
        }




        // Ambil role user
        $roleId = Userrole::where('users_id', $user->id)->value('roles_id');
        $userroles = Userrole::where('users_id', $user->id)
            ->where('roles_id', $roleId)
            ->get();

        // Ambil Spmipenilaianprodi untuk tahun ini
        $penilaian_prodi = Spmipenilaianprodi::where('programstudis_id', $programStudiId)
            ->where('tahun', $tahun)
            ->firstOrFail();

        // Cari data indikator berdasarkan id penilaian prodi
        $penilaianindikatorcalc = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaian_prodi->id)->get();

        // Ambil Elemen Sebagai Base Cetak
        $elemens = Spmielemen::where('lembagas_id', $penilaian_prodi->lembagas_id)->get();


        // Ambil semua indikator unik yang ada di hasil kalkulasi
        $indikatorIds = $penilaianindikatorcalc->pluck('spmi_indikators_id')->unique();
        $spmiindikators = Spmiindikator::whereIn('id', $indikatorIds)->get();
        // ambil strata
        $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

        $chart_image1 = $request->input('chart_image');
        $chart_image2 = $request->input('chart_image2');
        $chart_image3 = $request->input('chart_image3');
        $chart_image4 = $request->input('chart_image4');
        $chart_image5 = $request->input('chart_image5');
        $chart_image6 = $request->input('chart_image6');
        $chart_image7 = $request->input('chart_image7');
        $chart_image8 = $request->input('chart_image8');
        $chart_image9 = $request->input('chart_image9');


        $pdf = Pdf::loadView('pagesprodi/indikatorhasilcetak', compact(
            'chart_image1',
            'chart_image2',
            'chart_image3',
            'chart_image4',
            'chart_image5',
            'chart_image6',
            'chart_image7',
            'chart_image8',
            'chart_image9',
            'tahun',
            'nama_programstudi',
            'elemens',
            'penilaian_prodi',
            'strata',
            'fakultas',
            'auditor'
        ))->setPaper('a4');
        return $pdf->stream('laporan-radar.pdf');
    }

    public function laporangenerate_excel(Request $request) {}
}
