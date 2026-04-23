<?php

namespace App\Http\Controllers\LamTeknik;

use App\Http\Controllers\Controller;

use App\Models\Strata;
use App\Services\LamTeknik\V2\Service2;
use App\Services\LamTeknik\V2\Service3;
use App\Services\LamTeknik\V2\Service4;
use App\Services\LamTeknik\V2\Service5;
use App\Services\LamTeknik\V2\Service6;
use App\Services\LamTeknik\V2\Service7;
use App\Services\LamTeknik\V2\Service8;
use App\Services\LamTeknik\V2\Service9;
use App\Services\LamTeknik\V2\Service10;
use App\Services\LamTeknik\V2\Service11;
use App\Services\LamTeknik\V2\Service16;
use Illuminate\Http\Request;
use App\Models\Spmipenilaianindikator;
use App\Models\Spmipindikatorkomponen;
use App\Models\Spmipenilaianindikatorscalc;

class LamTeknikControllerV2 extends Controller
{
    protected $s2;
    protected $s3;
    protected $s4;
    protected $s5;
    protected $s6;
    protected $s7;
    protected $s8;
    protected $s9;
    protected $s10;
    protected $s11;
    protected $s16;

    public function __construct(
        Service2 $s2,
        Service3 $s3,
        Service4 $s4,
        Service5 $s5,
        Service6 $s6,
        Service7 $s7,
        Service8 $s8,
        Service9 $s9,
        Service10 $s10,
        Service11 $s11,
        Service16 $s16,
    ) {
        $this->s2 = $s2;
        $this->s3 = $s3;
        $this->s4 = $s4;
        $this->s5 = $s5;
        $this->s6 = $s6;
        $this->s7 = $s7;
        $this->s8 = $s8;
        $this->s9 = $s9;
        $this->s10 = $s10;
        $this->s11 = $s11;
        $this->s16 = $s16;
    }

    # NON-AUDITOR
    public function penilaiancalculatelamteknik(Request $request)
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
            if ($request->spmi_indikators_kode == 'LT.V2.4.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 75)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 76)->first()->nilai_prodi;
                $result = $this->s2->s2_1sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.5.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 77)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 78)->first()->nilai_prodi;
                $result = $this->s2->s2_2sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.6.1') {
                // $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->nilai_prodi;
                // $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 80)->first()->nilai_prodi;

                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 80)->first()->nilai_prodi;
                $result = $this->s2->s2_3sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.9.1') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // dd($spmi_penilaianprodis_id);
                // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $BOP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 619)->first()->nilai_prodi;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_prodi;
                // dd($BOP, $NM);
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s3->s3_2($BOP, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.9.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $DP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 622)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s3->s3_3($DP, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.9.2m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $DP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 622)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s3->s3_3($DP, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.9.3') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $DPKM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 624)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s3->s3_4($DPKM, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.9.3m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $DPKM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 624)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s3->s3_4($DPKM, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.11.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 81)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 82)->first()->nilai_prodi;
                $result = $this->s4->s4_2sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.12.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 83)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 84)->first()->nilai_prodi;
                $result = $this->s4->s4_3sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.13.1.m') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 85)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 86)->first()->nilai_prodi;
                $III = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 87)->first()->nilai_prodi;
                $result = $this->s4->s4_4msub($I, $II, $III);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.14.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 88)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 89)->first()->nilai_prodi;
                $result = $this->s4->s4_5sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.15.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 90)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 91)->first()->nilai_prodi;
                $result = $this->s4->s4_6sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.16.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $JP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 626)->first()->nilai_prodi;
                $JB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 627)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s4->s4_8($JP, $JB, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.17.1') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 629)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s4->s4_9($NA, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.19.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 92)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 93)->first()->nilai_prodi;
                $result = $this->s4->s4_11sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.20.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $NPMhs = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 630)->first()->nilai_prodi;
                $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 631)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s5->s5_2($NPMhs, $NPD, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.20.3.m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 234)->first()->id;
                $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 631)->first()->nilai_prodi;
                $NTM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 633)->first()->nilai_prodi;
                // $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 631)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s5->s5_3m($NTM, $NPD, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.21.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $NPkMhm = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 635)->first()->nilai_prodi;
                $NPkD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 636)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s6->s6_2($NPkMhm, $NPkD, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.1') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NDTT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 638)->first()->nilai_prodi;
                $NDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 639)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_3($NDTPS, $NDT, $NDTT, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.1d') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 844)->first()->nilai_prodi;

                $result = $this->s7->s7_3d($NDGB, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NDS3 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 641)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_2($NDS3, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.3m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 924)->first()->nilai_prodi;
                $NDLK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 925)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_1m($NDGB, $NDLK, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.3') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 643)->first()->nilai_prodi;
                $NDLK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 644)->first()->nilai_prodi;
                $NDL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 645)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_1($NDGB, $NDLK, $NDL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.3d') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 283)->first()->id;
                $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 844)->first()->nilai_prodi;
                $NDLK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 846)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_1m($NDGB, $NDLK, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.4v') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NDSK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 647)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_4v($NDTPS, $NDSK);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.5v') {
                $MKKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 649)->first()->nilai_prodi;
                $MKK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 650)->first()->nilai_prodi;

                $result = $this->s7->s7_5v($MKKI, $MKK);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.1') {
                $RBK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 652)->first()->nilai_prodi;

                $result = $this->s7->s7_7($RBK);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 653)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 654)->first()->nilai_prodi;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 655)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_8($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.3') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 659)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 660)->first()->nilai_prodi;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 661)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_9($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.4v') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;

                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 665)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 666)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 667)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 668)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 669)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 670)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 671)->first()->nilai_prodi,
                    'NC1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 672)->first()->nilai_prodi,
                    'NC2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 673)->first()->nilai_prodi,
                    'NC3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 674)->first()->nilai_prodi,
                ];

                $result = $this->s7->s7_10v($data, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.5') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;

                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 678)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 679)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 680)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 681)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 682)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 683)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 684)->first()->nilai_prodi,
                ];

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_10($data, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.6') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NPaten = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 688)->first()->nilai_prodi;
                $NHKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 689)->first()->nilai_prodi;
                $NTTG = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 690)->first()->nilai_prodi;
                $NBC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 691)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_11($NPaten, $NHKI, $NTTG, $NBC, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.7v') {
                $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 693)->first()->nilai_prodi;

                $result = $this->s7->s7_12v($NAPJ);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.8') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NKDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 694)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_13($NKDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.9') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $KIB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 696)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_14($KIB,  $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.10') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NRDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 698)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_15($NRDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.1m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 889)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 890)->first()->nilai_prodi;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 891)->first()->nilai_prodi;
                
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_8($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.2m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 896)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 897)->first()->nilai_prodi;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 898)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_9($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.3m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;

                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 903)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 904)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 905)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 906)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 907)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 908)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 909)->first()->nilai_prodi,
                ];

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_10($data, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.4m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NPaten = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 911)->first()->nilai_prodi;
                $NHKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 912)->first()->nilai_prodi;
                $NTTG = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 913)->first()->nilai_prodi;
                $NBC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 914)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_11($NPaten, $NHKI, $NTTG, $NBC, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.5m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NKDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 916)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_13($NKDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.5d') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NKDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 694)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_13($NKDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.5dd') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NRDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 976)->first()->nilai_prodi;
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_16($NRDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.6m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $KIB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 920)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_14($KIB,  $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } 
            else if ($request->spmi_indikators_kode == 'LT.V2.34.7m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NRDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 922)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_15($NRDTPS,  $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            else if ($request->spmi_indikators_kode == 'LT.V2.25.7') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NRDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 698)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_15($NRDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.26.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 94)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 95)->first()->nilai_prodi;
                $result = $this->s8->s8_1sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.27.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_prodi;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 700)->first()->nilai_prodi;
                #$spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first()->id;
                #NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_prodi;
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s8->s8_3($NM, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.28.1') {
                $NMUPPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 702)->first()->nilai_prodi;
                $NMAFT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 703)->first()->nilai_prodi;
                $NMAPT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 704)->first()->nilai_prodi;

                $result = $this->s9->s9_1($NMUPPS, $NMAFT, $NMAPT);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.28.2') {
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 706)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 707)->first()->nilai_prodi,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 708)->first()->nilai_prodi,
                ];
                $ipk = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 709)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 710)->first()->nilai_prodi,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 711)->first()->nilai_prodi,
                ];

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s9->s9_2($lulusan,  $ipk, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.29.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 96)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 97)->first()->nilai_prodi;

                $result = $this->s10->s10_1sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.29.1d') {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 977)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 978)->first()->nilai_prodi;
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 979)->first()->nilai_prodi;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 980)->first()->nilai_prodi;
                $RI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 981)->first()->nilai_prodi;
                $RN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 982)->first()->nilai_prodi;
                $RW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 983)->first()->nilai_prodi;

                $result = $this->s10->s10_1sub($NI, $NN, $NW, $NM, $RI, $RN, $RN);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.29.2v') {
                $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 725)->first()->nilai_prodi;

                $result = $this->s10->s10_2v($NAPJ);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.30.1m') {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 726)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 727)->first()->nilai_prodi;
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 728)->first()->nilai_prodi;
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first()->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_prodi;
                // $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 729)->first()->nilai_prodi;

                $result = $this->s10->s10_1m($NI, $NN, $NW, $NM);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.31.1') {
                $lulusan = [
                    'ts7a' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 734)->first()->nilai_prodi,
                    'ts7b' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 735)->first()->nilai_prodi,
                    'ts7c' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 736)->first()->nilai_prodi,
                    'ts7d' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 737)->first()->nilai_prodi,
                    'ts6a' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 741)->first()->nilai_prodi,
                    'ts6b' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 742)->first()->nilai_prodi,
                    'ts6c' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 743)->first()->nilai_prodi,
                    'ts6d' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 744)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_3($lulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.31.1m') {
                $lulusan = [
                    'ts3a' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 849)->first()->nilai_prodi,
                    'ts3b' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 850)->first()->nilai_prodi,
                    'ts3c' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 851)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_3m($lulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.31.1d') {
                $lulusan = [
                    'ts5a' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 855)->first()->nilai_prodi,
                    'ts5b' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 856)->first()->nilai_prodi,
                    'ts5c' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 857)->first()->nilai_prodi,
                    'ts4a' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 861)->first()->nilai_prodi,
                    'ts4b' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 862)->first()->nilai_prodi,
                    'ts4c' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 863)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_3d($lulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.32.1') {
                $diterima = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 748)->first()->nilai_prodi;
                $lulusan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 749)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s10->s10_4($diterima, $lulusan, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.32.1m') {
                $diterima = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 867)->first()->nilai_prodi;
                $lulusan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 868)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s10->s10_4m($diterima, $lulusan, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.32.1d') {
                $diterima = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 870)->first()->nilai_prodi;
                $lulusan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 871)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s10->s10_4d($diterima, $lulusan, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.33.1') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first()->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_prodi;

                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 751)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 752)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 753)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 754)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 755)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 756)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 757)->first()->nilai_prodi,
                ];

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s10->s10_5($data, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.33.1v') {
                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 761)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 762)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 763)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 764)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 765)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 766)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 767)->first()->nilai_prodi,
                ];
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first()->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_prodi;
                // $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 729)->first()->nilai_prodi;

                $result = $this->s10->s10_5v($data, $NM);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.33.2') {
                $NPaten = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 873)->first()->nilai_prodi;
                $NHKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 874)->first()->nilai_prodi;
                $NTTG = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 875)->first()->nilai_prodi;
                $NBC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 876)->first()->nilai_prodi;

                $result = $this->s10->s10_6($NPaten, $NHKI, $NTTG, $NBC);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.33.2m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first()->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_prodi;
                // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 249)->first()->id;
                // $NPaten = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 688)->first()->nilai_prodi;
                // $NTTG = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 690)->first()->nilai_prodi;
                // $NBC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 691)->first()->nilai_prodi;

                $NPaten = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 878)->first()->nilai_prodi;
                $NHKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 879)->first()->nilai_prodi;
                $NTTG = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 880)->first()->nilai_prodi;
                $NBC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 881)->first()->nilai_prodi;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s10->s10_6m($NPaten, $NHKI, $NTTG, $NBC, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.35.1') {
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 778)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 779)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 780)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 781)->first()->nilai_prodi,
                ];
                $tahunlulus = [
                    'tl2wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 783)->first()->nilai_prodi,
                    'tl2wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 784)->first()->nilai_prodi,
                    'tl2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 785)->first()->nilai_prodi,
                    'tl1wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 786)->first()->nilai_prodi,
                    'tl1wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 787)->first()->nilai_prodi,
                    'tl1wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 788)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_9($lulusan,  $lulusanterlacak,  $tahunlulus);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.35.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 269)->first()->id;
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 778)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 779)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 780)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 781)->first()->nilai_prodi,
                ];
                $tahunlulus = [
                    'tl2wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 790)->first()->nilai_prodi,
                    'tl2wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 791)->first()->nilai_prodi,
                    'tl2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 792)->first()->nilai_prodi,
                    'tl1wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 793)->first()->nilai_prodi,
                    'tl1wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 794)->first()->nilai_prodi,
                    'tl1wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 795)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_8($lulusan,  $lulusanterlacak,  $tahunlulus);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.35.2m') {
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 927)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 928)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 929)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 930)->first()->nilai_prodi,
                ];
                $tahunlulus = [
                    'tl2wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 931)->first()->nilai_prodi,
                    'tl2wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 932)->first()->nilai_prodi,
                    'tl2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 933)->first()->nilai_prodi,
                    'tl1wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 934)->first()->nilai_prodi,
                    'tl1wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 935)->first()->nilai_prodi,
                    'tl1wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 936)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_8($lulusan,  $lulusanterlacak,  $tahunlulus);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.36.1') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 269)->first()->id;
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 778)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 779)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 780)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 781)->first()->nilai_prodi,
                ];
                $tahunlulus = [
                    'tl2ni' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 797)->first()->nilai_prodi,
                    'tl2nn' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 798)->first()->nilai_prodi,
                    'tl2nw' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 799)->first()->nilai_prodi,
                    'tl1ni' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 800)->first()->nilai_prodi,
                    'tl1nn' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 801)->first()->nilai_prodi,
                    'tl1nw' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 802)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_10($lulusan,  $lulusanterlacak,  $tahunlulus);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.36.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 269)->first()->id;
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 778)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 779)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 806)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 807)->first()->nilai_prodi,
                ];
                $penggunalulusan = [
                    'etika_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 809)->first()->nilai_prodi,
                    'etika_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 810)->first()->nilai_prodi,
                    'etika_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 811)->first()->nilai_prodi,
                    'etika_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 812)->first()->nilai_prodi,

                    'keahlian_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 814)->first()->nilai_prodi,
                    'keahlian_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 815)->first()->nilai_prodi,
                    'keahlian_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 816)->first()->nilai_prodi,
                    'keahlian_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 817)->first()->nilai_prodi,

                    'bahasa_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 819)->first()->nilai_prodi,
                    'bahasa_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 820)->first()->nilai_prodi,
                    'bahasa_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 821)->first()->nilai_prodi,
                    'bahasa_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 822)->first()->nilai_prodi,

                    'teknologiinformasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 824)->first()->nilai_prodi,
                    'teknologiinformasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 825)->first()->nilai_prodi,
                    'teknologiinformasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 826)->first()->nilai_prodi,
                    'teknologiinformasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 827)->first()->nilai_prodi,

                    'komunikasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 829)->first()->nilai_prodi,
                    'komunikasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 830)->first()->nilai_prodi,
                    'komunikasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 831)->first()->nilai_prodi,
                    'komunikasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 832)->first()->nilai_prodi,

                    'kerjasama_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 834)->first()->nilai_prodi,
                    'kerjasama_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 835)->first()->nilai_prodi,
                    'kerjasama_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 836)->first()->nilai_prodi,
                    'kerjasama_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 837)->first()->nilai_prodi,

                    'pengembangandiri_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 839)->first()->nilai_prodi,
                    'pengembangandiri_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 840)->first()->nilai_prodi,
                    'pengembangandiri_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 841)->first()->nilai_prodi,
                    'pengembangandiri_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 842)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_11($lulusan,  $lulusanterlacak,  $penggunalulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.36.2m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 303)->first()->id;
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 927)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 928)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 938)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 939)->first()->nilai_prodi,
                ];
                // dd($lulusan, $lulusanterlacak);
                $penggunalulusan = [
                    'etika_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 941)->first()->nilai_prodi,
                    'etika_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 942)->first()->nilai_prodi,
                    'etika_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 943)->first()->nilai_prodi,
                    'etika_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 944)->first()->nilai_prodi,

                    'keahlian_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 946)->first()->nilai_prodi,
                    'keahlian_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 947)->first()->nilai_prodi,
                    'keahlian_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 948)->first()->nilai_prodi,
                    'keahlian_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 949)->first()->nilai_prodi,

                    'bahasa_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 951)->first()->nilai_prodi,
                    'bahasa_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 952)->first()->nilai_prodi,
                    'bahasa_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 953)->first()->nilai_prodi,
                    'bahasa_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 954)->first()->nilai_prodi,

                    'teknologiinformasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 956)->first()->nilai_prodi,
                    'teknologiinformasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 957)->first()->nilai_prodi,
                    'teknologiinformasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 958)->first()->nilai_prodi,
                    'teknologiinformasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 959)->first()->nilai_prodi,

                    'komunikasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 961)->first()->nilai_prodi,
                    'komunikasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 962)->first()->nilai_prodi,
                    'komunikasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 963)->first()->nilai_prodi,
                    'komunikasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 964)->first()->nilai_prodi,

                    'kerjasama_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 966)->first()->nilai_prodi,
                    'kerjasama_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 967)->first()->nilai_prodi,
                    'kerjasama_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 968)->first()->nilai_prodi,
                    'kerjasama_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 969)->first()->nilai_prodi,

                    'pengembangandiri_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 971)->first()->nilai_prodi,
                    'pengembangandiri_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 972)->first()->nilai_prodi,
                    'pengembangandiri_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 973)->first()->nilai_prodi,
                    'pengembangandiri_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 974)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_11($lulusan,  $lulusanterlacak,  $penggunalulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.37.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 98)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 99)->first()->nilai_prodi;

                $result = $this->s11->s11_1sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.42.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 100)->first()->nilai_prodi;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 101)->first()->nilai_prodi;

                $result = $this->s16->s16_1sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else {
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

    public function komponencalculatelamteknik(Request $request)
    {
        $validated = $request->validate([
            'spmi_penilaianprodis_id' => 'numeric',
            'spmipenilaianindikatorsub_id' => 'numeric',
            'spmi_indikatorsubs_id' => 'numeric',
        ]);

        try {
            $spmi_indikatorsubs_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikatorsub_id)->first()->spmi_indikatorsubs_id;
            //dd($request);

            if ($spmi_indikatorsubs_id == 79) {
                // $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                // $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first();
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 614)->first();
                $N1 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 611)->first();
                $N2 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 612)->first();
                $N3 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 613)->first();

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s2->s2_3subkomI($N1->nilai_prodi, $N2->nilai_prodi, $N3->nilai_prodi, $NDTPS->nilai_prodi, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 80) {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 616)->first();
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 617)->first();
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 618)->first();

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s2->s2_3subkomII($NI->nilai_prodi, $NN->nilai_prodi, $NW->nilai_prodi, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 96) {

                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 713)->first();
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 714)->first();
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 715)->first();

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikatorsub_id)->first()->spmi_penilaianprodis_id;
                $indikator_ref = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first();
                $spmi_penilaianindikator_id = $indikator_ref->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first();

                $result = $this->s10->s10_1subkomI($NI->nilai_prodi, $NN->nilai_prodi, $NW->nilai_prodi, $NM->nilai_prodi);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 97) {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 719)->first();
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 720)->first();
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 721)->first();

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikatorsub_id)->first()->spmi_penilaianprodis_id;
                $indikator_ref = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first();
                $spmi_penilaianindikator_id = $indikator_ref->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first();

                $result = $this->s10->s10_1subkomII($NI->nilai_prodi, $NN->nilai_prodi, $NW->nilai_prodi, $NM->nilai_prodi);
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

    # AUDITOR
    public function penilaiancalculateauditorlamteknik(Request $request)
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
            if ($request->spmi_indikators_kode == 'LT.V2.4.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 75)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 76)->first()->nilai_auditor;
                $result = $this->s2->s2_1sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.5.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 77)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 78)->first()->nilai_auditor;
                $result = $this->s2->s2_2sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.6.1') {
                // $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->nilai_auditor;
                // $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 80)->first()->nilai_auditor;

                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 80)->first()->nilai_auditor;
                $result = $this->s2->s2_3sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.9.1') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // dd($spmi_penilaianprodis_id);
                // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $BOP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 619)->first()->nilai_auditor;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_auditor;
                // dd($BOP, $NM);
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s3->s3_2($BOP, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.9.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $DP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 622)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s3->s3_3($DP, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.9.2m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $DP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 622)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s3->s3_3($DP, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.9.3') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $DPKM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 624)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s3->s3_4($DPKM, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.9.3m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $DPKM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 624)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s3->s3_4($DPKM, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.11.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 81)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 82)->first()->nilai_auditor;
                $result = $this->s4->s4_2sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.12.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 83)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 84)->first()->nilai_auditor;
                $result = $this->s4->s4_3sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.13.1.m') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 85)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 86)->first()->nilai_auditor;
                $III = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 87)->first()->nilai_auditor;
                $result = $this->s4->s4_4msub($I, $II, $III);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.14.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 88)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 89)->first()->nilai_auditor;
                $result = $this->s4->s4_5sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.15.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 90)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 91)->first()->nilai_auditor;
                $result = $this->s4->s4_6sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.16.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $JP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 626)->first()->nilai_auditor;
                $JB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 627)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s4->s4_8($JP, $JB, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.17.1') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 629)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s4->s4_9($NA, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.19.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 92)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 93)->first()->nilai_auditor;
                $result = $this->s4->s4_11sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.20.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $NPMhs = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 630)->first()->nilai_auditor;
                $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 631)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s5->s5_2($NPMhs, $NPD, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.20.3.m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 234)->first()->id;
                $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 631)->first()->nilai_auditor;
                $NTM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 633)->first()->nilai_auditor;
                // $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 631)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s5->s5_3m($NTM, $NPD, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.21.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $NPkMhm = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 635)->first()->nilai_auditor;
                $NPkD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 636)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s6->s6_2($NPkMhm, $NPkD, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.1') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NDTT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 638)->first()->nilai_auditor;
                $NDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 639)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_3($NDTPS, $NDT, $NDTT, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.1d') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 844)->first()->nilai_auditor;

                $result = $this->s7->s7_3d($NDGB, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NDS3 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 641)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_2($NDS3, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.3m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 924)->first()->nilai_auditor;
                $NDLK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 925)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_1m($NDGB, $NDLK, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.3') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 643)->first()->nilai_auditor;
                $NDLK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 644)->first()->nilai_auditor;
                $NDL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 645)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_1($NDGB, $NDLK, $NDL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.3d') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 283)->first()->id;
                $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 844)->first()->nilai_auditor;
                $NDLK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 846)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_1m($NDGB, $NDLK, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.4v') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NDSK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 647)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_4v($NDTPS, $NDSK);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.22.5v') {
                $MKKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 649)->first()->nilai_auditor;
                $MKK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 650)->first()->nilai_auditor;

                $result = $this->s7->s7_5v($MKKI, $MKK);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.1') {
                $RBK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 652)->first()->nilai_auditor;

                $result = $this->s7->s7_7($RBK);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 653)->first()->nilai_auditor;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 654)->first()->nilai_auditor;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 655)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_8($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.3') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 659)->first()->nilai_auditor;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 660)->first()->nilai_auditor;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 661)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_9($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.4v') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;

                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 665)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 666)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 667)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 668)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 669)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 670)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 671)->first()->nilai_prodi,
                    'NC1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 672)->first()->nilai_prodi,
                    'NC2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 673)->first()->nilai_prodi,
                    'NC3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 674)->first()->nilai_prodi,
                ];

                $result = $this->s7->s7_10v($data, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.5') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;

                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 678)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 679)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 680)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 681)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 682)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 683)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 684)->first()->nilai_prodi,
                ];

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_10($data, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.6') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NPaten = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 688)->first()->nilai_auditor;
                $NHKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 689)->first()->nilai_auditor;
                $NTTG = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 690)->first()->nilai_auditor;
                $NBC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 691)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_11($NPaten, $NHKI, $NTTG, $NBC, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.7v') {
                $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 693)->first()->nilai_auditor;

                $result = $this->s7->s7_12v($NAPJ);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.8') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NKDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 694)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_13($NKDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.9') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $KIB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 696)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_14($KIB,  $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.24.10') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NRDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 698)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_15($NRDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.1m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 653)->first()->nilai_auditor;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 654)->first()->nilai_auditor;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 655)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_8($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.2m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 659)->first()->nilai_auditor;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 660)->first()->nilai_auditor;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 661)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_9($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.3m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;

                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 678)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 679)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 680)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 681)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 682)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 683)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 684)->first()->nilai_prodi,
                ];

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_10($data, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.4m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NPaten = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 688)->first()->nilai_auditor;
                $NHKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 689)->first()->nilai_auditor;
                $NTTG = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 690)->first()->nilai_auditor;
                $NBC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 691)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_11($NPaten, $NHKI, $NTTG, $NBC, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.5m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NKDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 694)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_13($NKDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.5d') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NKDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 694)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_13($NKDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.5dd') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NRDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 976)->first()->nilai_auditor;
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_16($NRDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.6m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $KIB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 696)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_14($KIB,  $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.25.7') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NRDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 698)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s7->s7_15($NRDTPS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.26.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 94)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 95)->first()->nilai_auditor;
                $result = $this->s8->s8_1sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.27.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first()->nilai_auditor;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 700)->first()->nilai_auditor;
                #$spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first()->id;
                #NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_auditor;
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s8->s8_3($NM, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.28.1') {
                $NMUPPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 702)->first()->nilai_auditor;
                $NMAFT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 703)->first()->nilai_auditor;
                $NMAPT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 704)->first()->nilai_auditor;

                $result = $this->s9->s9_1($NMUPPS, $NMAFT, $NMAPT);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.28.2') {
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 706)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 707)->first()->nilai_prodi,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 708)->first()->nilai_prodi,
                ];
                $ipk = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 709)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 710)->first()->nilai_prodi,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 711)->first()->nilai_prodi,
                ];

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s9->s9_2($lulusan,  $ipk, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.29.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 96)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 97)->first()->nilai_auditor;

                $result = $this->s10->s10_1sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.29.1d') {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 977)->first()->nilai_auditor;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 978)->first()->nilai_auditor;
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 979)->first()->nilai_auditor;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 980)->first()->nilai_auditor;
                $RI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 981)->first()->nilai_auditor;
                $RN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 982)->first()->nilai_auditor;
                $RW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 983)->first()->nilai_auditor;

                $result = $this->s10->s10_1sub($NI, $NN, $NW, $NM, $RI, $RN, $RN);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.29.2v') {
                $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 725)->first()->nilai_auditor;

                $result = $this->s10->s10_2v($NAPJ);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.30.1m') {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 726)->first()->nilai_auditor;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 727)->first()->nilai_auditor;
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 728)->first()->nilai_auditor;
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first()->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_auditor;
                // $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 729)->first()->nilai_auditor;

                $result = $this->s10->s10_1m($NI, $NN, $NW, $NM);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.31.1') {
                $lulusan = [
                    'ts7a' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 734)->first()->nilai_prodi,
                    'ts7b' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 735)->first()->nilai_prodi,
                    'ts7c' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 736)->first()->nilai_prodi,
                    'ts7d' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 737)->first()->nilai_prodi,
                    'ts6a' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 741)->first()->nilai_prodi,
                    'ts6b' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 742)->first()->nilai_prodi,
                    'ts6c' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 743)->first()->nilai_prodi,
                    'ts6d' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 744)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_3($lulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.31.1m') {
                $lulusan = [
                    'ts3a' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 849)->first()->nilai_prodi,
                    'ts3b' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 850)->first()->nilai_prodi,
                    'ts3c' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 851)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_3m($lulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.31.1d') {
                $lulusan = [
                    'ts5a' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 855)->first()->nilai_prodi,
                    'ts5b' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 856)->first()->nilai_prodi,
                    'ts5c' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 857)->first()->nilai_prodi,
                    'ts4a' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 861)->first()->nilai_prodi,
                    'ts4b' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 862)->first()->nilai_prodi,
                    'ts4c' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 863)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_3d($lulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.32.1') {
                $diterima = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 748)->first()->nilai_auditor;
                $lulusan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 749)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s10->s10_4($diterima, $lulusan, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.32.1m') {
                $diterima = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 867)->first()->nilai_auditor;
                $lulusan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 868)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s10->s10_4m($diterima, $lulusan, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.32.1d') {
                $diterima = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 870)->first()->nilai_auditor;
                $lulusan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 871)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s10->s10_4d($diterima, $lulusan, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.33.1') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first()->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_auditor;

                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 751)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 752)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 753)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 754)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 755)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 756)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 757)->first()->nilai_prodi,
                ];

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s10->s10_5($data, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.33.1v') {
                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 761)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 762)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 763)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 764)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 765)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 766)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 767)->first()->nilai_prodi,
                ];
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first()->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_auditor;
                // $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 729)->first()->nilai_auditor;

                $result = $this->s10->s10_5v($data, $NM);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.33.2') {
                $NPaten = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 873)->first()->nilai_auditor;
                $NHKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 874)->first()->nilai_auditor;
                $NTTG = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 875)->first()->nilai_auditor;
                $NBC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 876)->first()->nilai_auditor;

                $result = $this->s10->s10_6($NPaten, $NHKI, $NTTG, $NBC);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.33.2m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first()->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first()->nilai_auditor;
                // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 249)->first()->id;
                // $NPaten = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 688)->first()->nilai_auditor;
                // $NTTG = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 690)->first()->nilai_auditor;
                // $NBC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 691)->first()->nilai_auditor;

                $NPaten = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 878)->first()->nilai_auditor;
                $NHKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 879)->first()->nilai_auditor;
                $NTTG = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 880)->first()->nilai_auditor;
                $NBC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 881)->first()->nilai_auditor;

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s10->s10_6m($NPaten, $NHKI, $NTTG, $NBC, $NM, $strata->nama_strata);
                

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.35.1') {
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 778)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 779)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 780)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 781)->first()->nilai_prodi,
                ];
                $tahunlulus = [
                    'tl2wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 783)->first()->nilai_prodi,
                    'tl2wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 784)->first()->nilai_prodi,
                    'tl2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 785)->first()->nilai_prodi,
                    'tl1wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 786)->first()->nilai_prodi,
                    'tl1wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 787)->first()->nilai_prodi,
                    'tl1wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 788)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_9($lulusan,  $lulusanterlacak,  $tahunlulus);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.35.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 269)->first()->id;
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 778)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 779)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 780)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 781)->first()->nilai_prodi,
                ];
                $tahunlulus = [
                    'tl2wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 790)->first()->nilai_prodi,
                    'tl2wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 791)->first()->nilai_prodi,
                    'tl2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 792)->first()->nilai_prodi,
                    'tl1wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 793)->first()->nilai_prodi,
                    'tl1wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 794)->first()->nilai_prodi,
                    'tl1wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 795)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_8($lulusan,  $lulusanterlacak,  $tahunlulus);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.35.2m') {
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 927)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 928)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 929)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 930)->first()->nilai_prodi,
                ];
                $tahunlulus = [
                    'tl2wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 931)->first()->nilai_prodi,
                    'tl2wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 932)->first()->nilai_prodi,
                    'tl2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 933)->first()->nilai_prodi,
                    'tl1wt1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 934)->first()->nilai_prodi,
                    'tl1wt2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 935)->first()->nilai_prodi,
                    'tl1wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 936)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_8($lulusan,  $lulusanterlacak,  $tahunlulus);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.36.1') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 269)->first()->id;
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 778)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 779)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 780)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 781)->first()->nilai_prodi,
                ];
                $tahunlulus = [
                    'tl2ni' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 797)->first()->nilai_prodi,
                    'tl2nn' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 798)->first()->nilai_prodi,
                    'tl2nw' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 799)->first()->nilai_prodi,
                    'tl1ni' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 800)->first()->nilai_prodi,
                    'tl1nn' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 801)->first()->nilai_prodi,
                    'tl1nw' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 802)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_10($lulusan,  $lulusanterlacak,  $tahunlulus);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.36.2') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 269)->first()->id;
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 778)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 779)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 806)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 807)->first()->nilai_prodi,
                ];
                $penggunalulusan = [
                    'etika_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 809)->first()->nilai_prodi,
                    'etika_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 810)->first()->nilai_prodi,
                    'etika_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 811)->first()->nilai_prodi,
                    'etika_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 812)->first()->nilai_prodi,

                    'keahlian_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 814)->first()->nilai_prodi,
                    'keahlian_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 815)->first()->nilai_prodi,
                    'keahlian_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 816)->first()->nilai_prodi,
                    'keahlian_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 817)->first()->nilai_prodi,

                    'bahasa_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 819)->first()->nilai_prodi,
                    'bahasa_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 820)->first()->nilai_prodi,
                    'bahasa_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 821)->first()->nilai_prodi,
                    'bahasa_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 822)->first()->nilai_prodi,

                    'teknologiinformasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 824)->first()->nilai_prodi,
                    'teknologiinformasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 825)->first()->nilai_prodi,
                    'teknologiinformasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 826)->first()->nilai_prodi,
                    'teknologiinformasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 827)->first()->nilai_prodi,

                    'komunikasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 829)->first()->nilai_prodi,
                    'komunikasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 830)->first()->nilai_prodi,
                    'komunikasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 831)->first()->nilai_prodi,
                    'komunikasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 832)->first()->nilai_prodi,

                    'kerjasama_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 834)->first()->nilai_prodi,
                    'kerjasama_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 835)->first()->nilai_prodi,
                    'kerjasama_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 836)->first()->nilai_prodi,
                    'kerjasama_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 837)->first()->nilai_prodi,

                    'pengembangandiri_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 839)->first()->nilai_prodi,
                    'pengembangandiri_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 840)->first()->nilai_prodi,
                    'pengembangandiri_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 841)->first()->nilai_prodi,
                    'pengembangandiri_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 842)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_11($lulusan,  $lulusanterlacak,  $penggunalulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.36.2m') {
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 303)->first()->id;
                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 927)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 928)->first()->nilai_prodi,
                ];
                $lulusanterlacak = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 938)->first()->nilai_prodi,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 939)->first()->nilai_prodi,
                ];
                // dd($lulusan, $lulusanterlacak);
                $penggunalulusan = [
                    'etika_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 941)->first()->nilai_prodi,
                    'etika_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 942)->first()->nilai_prodi,
                    'etika_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 943)->first()->nilai_prodi,
                    'etika_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 944)->first()->nilai_prodi,

                    'keahlian_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 946)->first()->nilai_prodi,
                    'keahlian_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 947)->first()->nilai_prodi,
                    'keahlian_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 948)->first()->nilai_prodi,
                    'keahlian_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 949)->first()->nilai_prodi,

                    'bahasa_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 951)->first()->nilai_prodi,
                    'bahasa_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 952)->first()->nilai_prodi,
                    'bahasa_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 953)->first()->nilai_prodi,
                    'bahasa_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 954)->first()->nilai_prodi,

                    'teknologiinformasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 956)->first()->nilai_prodi,
                    'teknologiinformasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 957)->first()->nilai_prodi,
                    'teknologiinformasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 958)->first()->nilai_prodi,
                    'teknologiinformasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 959)->first()->nilai_prodi,

                    'komunikasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 961)->first()->nilai_prodi,
                    'komunikasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 962)->first()->nilai_prodi,
                    'komunikasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 963)->first()->nilai_prodi,
                    'komunikasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 964)->first()->nilai_prodi,

                    'kerjasama_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 966)->first()->nilai_prodi,
                    'kerjasama_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 967)->first()->nilai_prodi,
                    'kerjasama_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 968)->first()->nilai_prodi,
                    'kerjasama_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 969)->first()->nilai_prodi,

                    'pengembangandiri_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 971)->first()->nilai_prodi,
                    'pengembangandiri_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 972)->first()->nilai_prodi,
                    'pengembangandiri_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 973)->first()->nilai_prodi,
                    'pengembangandiri_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 974)->first()->nilai_prodi,
                ];
                $result = $this->s10->s10_11($lulusan,  $lulusanterlacak,  $penggunalulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.37.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 98)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 99)->first()->nilai_auditor;

                $result = $this->s11->s11_1sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.V2.42.1') {
                $I = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 100)->first()->nilai_auditor;
                $II = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 101)->first()->nilai_auditor;

                $result = $this->s16->s16_1sub($I, $II);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else {
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

    public function komponencalculateauditorlamteknik(Request $request)
    {
        $validated = $request->validate([
            'spmi_penilaianprodis_id' => 'numeric',
            'spmipenilaianindikatorsub_id' => 'numeric',
            'spmi_indikatorsubs_id' => 'numeric',
        ]);

        try {
            $spmi_indikatorsubs_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikatorsub_id)->first()->spmi_indikatorsubs_id;
            //dd($request);

            if ($spmi_indikatorsubs_id == 79) {
                // $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 79)->first()->id;
                // $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 614)->first();
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 614)->first();
                $N1 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 611)->first();
                $N2 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 612)->first();
                $N3 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 613)->first();

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s2->s2_3subkomI($N1->nilai_auditor, $N2->nilai_auditor, $N3->nilai_auditor, $NDTPS->nilai_auditor, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 80) {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 616)->first();
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 617)->first();
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 618)->first();

                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->s2->s2_3subkomII($NI->nilai_auditor, $NN->nilai_auditor, $NW->nilai_auditor, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 96) {

                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 713)->first();
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 714)->first();
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 715)->first();

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikatorsub_id)->first()->spmi_penilaianprodis_id;
                $indikator_ref = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first();
                $spmi_penilaianindikator_id = $indikator_ref->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first();

                $result = $this->s10->s10_1subkomI($NI->nilai_auditor, $NN->nilai_auditor, $NW->nilai_auditor, $NM->nilai_auditor);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 97) {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 719)->first();
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 720)->first();
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 721)->first();

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikatorsub_id)->first()->spmi_penilaianprodis_id;
                $indikator_ref = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 219)->first();
                $spmi_penilaianindikator_id = $indikator_ref->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 620)->first();

                $result = $this->s10->s10_1subkomII($NI->nilai_auditor, $NN->nilai_auditor, $NW->nilai_auditor, $NM->nilai_auditor);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else {
                $indikator = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)
                    ->where('spmi_indikatorkomponens_id', $request->input('spmi_indikatorsubs_id'))
                    ->first();

                $result = $indikator ? $indikator->nilai_auditor : null;
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            }

            //dd($result);

            $spmipenilaianindikator->nilai_auditor = $result;
            $spmipenilaianindikator->save();

            return redirect()->back()->with('successPenilaianCalculate', 'Data tersimpan!');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withErrors(['errorPenilaianCalculate' => 'Gagal menghitung penilaian: Data tidak lengkap.']);
        }
    }
}
