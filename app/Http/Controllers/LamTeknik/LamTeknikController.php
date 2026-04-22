<?php

namespace App\Http\Controllers\LamTeknik;

use App\Http\Controllers\Controller;

use App\Models\Strata;
use App\Services\LamTeknik\V1\C2Service;
use App\Services\LamTeknik\V1\C3Service;
use App\Services\LamTeknik\V1\C4Service;
use App\Services\LamTeknik\V1\C5Service;
use App\Services\LamTeknik\V1\C6Service;
use App\Services\LamTeknik\V1\C7Service;
use App\Services\LamTeknik\V1\C8Service;
use App\Services\LamTeknik\V1\C9Service;
use Illuminate\Http\Request;
use App\Models\Spmipenilaianindikator;
use App\Models\Spmipindikatorkomponen;
use App\Models\Spmipenilaianindikatorscalc;

class LamTeknikController extends Controller
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
            if ($request->spmi_indikators_kode == 'LT.C.2.4.a') {
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 38)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 39)->first()->nilai_prodi;
                $result = $this->c2->c24asub($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.2.4.b') {
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 40)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 41)->first()->nilai_prodi;
                $result = $this->c2->c24bsub($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.2.4.c') {
                // rev: add LT.C.2.4.c
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikators_id', 134)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikators_id', 134)->first()->nilai_prodi;
                $result = $this->c2->c24bsub($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.2.4.d') {
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 43)->first()->nilai_prodi;

                $result = $this->c2->c24d($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.3.4.a') {
                $spmipenilaianindikators_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 44)->first()->id;
                $Pilihan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmipenilaianindikators_id)->where('spmi_indikatorkomponens_id', 331)->first()->nilai_prodi;
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 45)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 46)->first()->nilai_prodi;

                $result = $this->c3->c34a($Pilihan, $a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.3.4.b') {

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 47)->first();
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 48)->first();


                $result = $this->c3->c34b($a->nilai_prodi, $b->nilai_prodi);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.3.4.c') {

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 49)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 50)->first()->nilai_prodi;

                $result = $this->c3->c34c($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            // rev: S2 S3
            // else if ($request->spmi_indikators_kode == 'LT.C.3.4.d') {

            //     $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 68)->first()->nilai_prodi;
            //     $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 69)->first()->nilai_prodi;
            //     $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 70)->first()->nilai_prodi;
            //     
            //     $result = $this->c3->c34d($a, $b, $c);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } else if ($request->spmi_indikators_kode == 'LT.C.3.4.e') {

            //     $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 71)->first()->nilai_prodi;
            //     $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 70)->first()->nilai_prodi;
            //     
            //     $result = $this->c3->c34e($a, $b);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // }
            else if ($request->spmi_indikators_kode == 'LT.C.4.4.a1') {
                // rev: add spmi_indikators_id
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 140)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44a1($NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.a2') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 141)->first()->id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NDS3 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 342)->first()->nilai_prodi;
                $result = $this->c4->c44a2($NDS3, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.a3') {


                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 345)->first()->nilai_prodi;
                $NDLK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 346)->first()->nilai_prodi;
                $NDL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 347)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c4->c44a3($NDGB, $NDLK, $NDL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.a4') {
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                if ($strata->nama_strata == "S1") {
                    $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                    $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                    $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                    $spmi_penilaianindikator_id_pilihan = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 44)->first()->id;
                    $pilihan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id_pilihan)->where('spmi_indikatorkomponens_id', 331)->first()->nilai_prodi;
                    $rendah = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 46)->first()->nilai_prodi;
                    $kelompok = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 349)->first()->nilai_prodi;
                    $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_prodi;

                    $result = $this->c4->c44a4($kelompok, $NM, $NDTPS, $pilihan, $rendah);
                } else if ($strata->nama_strata == "D4") {
                    $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                    $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                    $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                    $kelompok = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 349)->first()->nilai_prodi;
                    $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_prodi;

                    $result = $this->c4->c44a4v($kelompok, $NM, $NDTPS);
                }
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.a5') {

                $RDPU = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 353)->first()->nilai_prodi;
                $RDPUL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 24)->first()->nilai_prodi;
                $result = $this->c4->c44a5($RDPU, $RDPUL);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.a6') {

                $EWMPDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 26)->first()->nilai_prodi;
                $EWMPDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 27)->first()->nilai_prodi;
                $result = $this->c4->c44a6($EWMPDT, $EWMPDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }

            // rev : D4
            // else if ($request->spmi_indikators_kode == 'LT.C.4.4.a6v') {

            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            //     $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
            //     $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
            //     $NDSK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 272)->first()->nilai_prodi;
            //     $result = $this->c4->c44a6v($NDTPS, $NDSK);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } 

            // rev: .C.4.4.a7 tidak ada di excel
            // else if ($request->spmi_indikators_kode == 'LT.C.4.4.a7') {

            //     $NDTT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 355)->first()->nilai_prodi;
            //     $NDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 356)->first()->nilai_prodi;
            //     $result = $this->c4->c44a7($NDTT, $NDT);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // }

            // rev: D4
            // else if ($request->spmi_indikators_kode == 'LT.C.4.4.a7v') {

            //     $MKKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 273)->first()->nilai_prodi;
            //     $MKK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 274)->first()->nilai_prodi;
            //     $result = $this->c4->c44a7v($MKKI, $MKK);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // }  
            else if ($request->spmi_indikators_kode == 'LT.C.4.4.b1') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NRD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 359)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b1($NRD, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.b2') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 362)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 362)->first()->nilai_prodi;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 364)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b2($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.b3') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 369)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 370)->first()->nilai_prodi;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 371)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b3($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            // rev : D4
            // else if ($request->spmi_indikators_kode == 'LT.C.4.4.b3v') {

            //     
            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            //     $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
            //     $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
            //     $NRD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 283)->first()->nilai_prodi;
            //     $result = $this->c4->c44b3v($NRD, $NDTPS);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } 
            else if ($request->spmi_indikators_kode == 'LT.C.4.4.b4') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 375)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 376)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 377)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 368)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 379)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 380)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 381)->first()->nilai_prodi,
                    'NC1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 382)->first()->nilai_prodi,
                    'NC2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 183)->first()->nilai_prodi,
                    'NC3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 384)->first()->nilai_prodi,
                ];
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b4($data, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.b5') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 388)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c4->c44b5($NAS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.b6') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 391)->first()->nilai_prodi;
                $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 392)->first()->nilai_prodi;
                $NC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 393)->first()->nilai_prodi;
                $ND = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 394)->first()->nilai_prodi;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c4->c44b6($NA, $NB, $NC, $ND, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            // rev : D4
            // else if ($request->spmi_indikators_kode == 'LT.C.4.4.b7v') {

            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            //     $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
            //     $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
            //     $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 275)->first()->nilai_prodi;
            //     $result = $this->c4->c44a6v($NDTPS, $NAPJ);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } else if ($request->spmi_indikators_kode == 'LT.C.4.4.b6m') {

            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            //     $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
            //     $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
            //     $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 278)->first()->nilai_prodi;
            //     $result = $this->c4->c44b6m($NDTPS, $NAS);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } 
            // rev: LT.C.4.4.c dihapus karena kualitatif
            else if ($request->spmi_indikators_kode == 'LT.C.4.4.d') {

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 51)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 52)->first()->nilai_prodi;

                $result = $this->c4->c44d($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.5.4.a1') {

                // $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 20)->first()->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_prodi;
                $BOP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 398)->first()->nilai_prodi;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c5->c54a1($BOP, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.5.4.a2') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $DP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 401)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c5->c54a2($DP, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.5.4.a3') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $DPKM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 404)->first()->nilai_prodi;

                $result = $this->c5->c54a3($DPKM, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.a') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 53)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 54)->first()->nilai_prodi;
                $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 55)->first()->nilai_prodi;


                $result = $this->c6->c64a($a, $b, $c);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.c') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 56)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 57)->first()->nilai_prodi;


                $result = $this->c6->c64c($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.d1') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 58)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 59)->first()->nilai_prodi;
                $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 60)->first()->nilai_prodi;
                $d = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 61)->first()->nilai_prodi;
                $e = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 62)->first()->nilai_prodi;


                $result = $this->c6->c64d1($a, $b, $c, $d, $e);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.d2') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $JP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 407)->first()->nilai_prodi;
                $JB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 408)->first()->nilai_prodi;


                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c6->c64d2($JP, $JB, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.f') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 63)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 64)->first()->nilai_prodi;
                $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 65)->first()->nilai_prodi;



                $result = $this->c6->c64f($a, $b, $c);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.g') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // rev: delete $MK karena tidak ada di excel
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 410)->first()->nilai_prodi;


                $result = $this->c6->c64g($NA);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.j') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // rev: delete MKI MK, add $NMKI
                $NMKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 411)->first()->nilai_prodi;



                $result = $this->c6->c64j($NMKI);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.l') {
                // rev: ganti LT.C.6.4.i ke LT.C.6.4.l
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 66)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 67)->first()->nilai_prodi;


                $result = $this->c6->c64i($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.7.4.b') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // rev: delete NPKMD,  add NPD gak ada di excel
                $NPM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 438)->first()->nilai_prodi;
                $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 439)->first()->nilai_prodi;


                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c7->c74b($NPM, $NPD, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            // rev: S2 S3
            // else if ($request->spmi_indikators_kode == 'LT.C.7.4.cm') {

            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            //     $NPM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 281)->first()->nilai_prodi;
            //     $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 282)->first()->nilai_prodi;
            //     
            //     
            //     // Get strata bcs difer threshold
            //     $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            //     $result = $this->c7->c74cm($NPM, $NPD, $strata->nama_strata);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } 
            else if ($request->spmi_indikators_kode == 'LT.C.8.4.b') {

                $NPKMM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 441)->first()->nilai_auditor;
                $NPKMD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 442)->first()->nilai_auditor;

                $result = $this->c8->c84b($NPKMM, $NPKMD);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a2') {

                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 444)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 445)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 446)->first()->nilai_auditor,
                ];

                $ipk = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 447)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 448)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 449)->first()->nilai_auditor,
                ];

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c9->c94a2($lulusan, $ipk, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a3') {

                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 451)->first()->nilai_auditor;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 452)->first()->nilai_auditor;
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 453)->first()->nilai_auditor;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_auditor;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c9->c94a3($NI, $NN, $NW, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a4') {

                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 451)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 452)->first()->nilai_prodi;
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 453)->first()->nilai_prodi;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_prodi;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c9->c94a4($NI, $NN, $NW, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a5') {
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

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
                        // rev: add ts6, ts3ts6, ts2ts6, ts1ts6, ts1ts6, tMS 
                        'ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 465)->first()->nilai_prodi,
                        'ts3ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 466)->first()->nilai_prodi,
                        'ts2ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 467)->first()->nilai_prodi,
                        'ts1ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 468)->first()->nilai_prodi,
                        'tsts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 469)->first()->nilai_prodi,
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 470)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 471)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 472)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 473)->first()->nilai_prodi,
                    ];
                }

                $result = $this->c9->c94a5($lulusan, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a6') {
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
                        'ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 465)->first()->nilai_prodi,
                        'ts5' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 466)->first()->nilai_prodi,
                        'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 467)->first()->nilai_prodi,
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 468)->first()->nilai_prodi,
                    ];
                    $lulusan = [
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 470)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 471)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 472)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 473)->first()->nilai_prodi,
                    ];
                }


                $result = $this->c9->c94a6($diterima, $lulusan, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a7') {
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                // rev: delete ts3, ts2, ts1
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
                    $dt = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 478)->first()->nilai_prodi;
                    // $dt = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 479)->first()->nilai_prodi; // Jumlah mahasiswa terdaftar pada TS	
                    $lulusan = [
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 480)->first()->nilai_prodi,
                    ];
                }
                $result = $this->c9->c94a7($lulusan, $dt, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a9') {

                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 482)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 483)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 484)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 485)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 486)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 487)->first()->nilai_prodi,
                ];

                $tahunlulus = [
                    'tlts4wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 491)->first()->nilai_prodi,
                    'tlts4wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 492)->first()->nilai_prodi,
                    'tlts4wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 493)->first()->nilai_prodi,
                    'tlts3wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 494)->first()->nilai_prodi,
                    'tlts3wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 495)->first()->nilai_prodi,
                    'tlts3wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 496)->first()->nilai_prodi,
                    'tlts2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 497)->first()->nilai_prodi,
                    'tlts2wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 498)->first()->nilai_prodi,
                    'tlts2wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 499)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a9($lulusan, $lulusanterlacak, $tahunlulus);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a10') {
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 501)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 502)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 503)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 504)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 505)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 506)->first()->nilai_prodi,
                ];

                $kesesuaianlulusan = [
                    'tlts4wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 510)->first()->nilai_prodi,
                    'tlts4wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 511)->first()->nilai_prodi,
                    'tlts4wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 512)->first()->nilai_prodi,
                    'tlts3wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 513)->first()->nilai_prodi,
                    'tlts3wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 514)->first()->nilai_prodi,
                    'tlts3wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 515)->first()->nilai_prodi,
                    'tlts2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 516)->first()->nilai_prodi,
                    'tlts2wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 517)->first()->nilai_prodi,
                    'tlts2wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 518)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a10($lulusan, $lulusanterlacak, $kesesuaianlulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a11') {
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 520)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 521)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 522)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 523)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 524)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 525)->first()->nilai_prodi,
                ];

                $lulusantingkat = [
                    'NIts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 529)->first()->nilai_prodi,
                    'NNts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 530)->first()->nilai_prodi,
                    'NWts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 531)->first()->nilai_prodi,
                    'NIts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 532)->first()->nilai_prodi,
                    'NNts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 533)->first()->nilai_prodi,
                    'NWts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 534)->first()->nilai_prodi,
                    'NIts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 535)->first()->nilai_prodi,
                    'NNts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 536)->first()->nilai_prodi,
                    'NWts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 537)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a11($lulusan, $lulusanterlacak, $lulusantingkat);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a12') {
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 541)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 542)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 543)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 544)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 545)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 546)->first()->nilai_prodi,
                ];

                $penggunalulusan = [
                    'etika_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 550)->first()->nilai_prodi,
                    'etika_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 551)->first()->nilai_prodi,
                    'etika_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 552)->first()->nilai_prodi,
                    'etika_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 553)->first()->nilai_prodi,

                    'keahlian_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 555)->first()->nilai_prodi,
                    'keahlian_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 556)->first()->nilai_prodi,
                    'keahlian_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 557)->first()->nilai_prodi,
                    'keahlian_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 558)->first()->nilai_prodi,

                    'bahasa_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 560)->first()->nilai_prodi,
                    'bahasa_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 561)->first()->nilai_prodi,
                    'bahasa_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 562)->first()->nilai_prodi,
                    'bahasa_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 563)->first()->nilai_prodi,

                    'teknologiinformasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 565)->first()->nilai_prodi,
                    'teknologiinformasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 567)->first()->nilai_prodi,
                    'teknologiinformasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 568)->first()->nilai_prodi,
                    'teknologiinformasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 569)->first()->nilai_prodi,

                    'komunikasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 571)->first()->nilai_prodi,
                    'komunikasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 572)->first()->nilai_prodi,
                    'komunikasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 573)->first()->nilai_prodi,
                    'komunikasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 574)->first()->nilai_prodi,

                    'kerjasama_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 576)->first()->nilai_prodi,
                    'kerjasama_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 577)->first()->nilai_prodi,
                    'kerjasama_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 578)->first()->nilai_prodi,
                    'kerjasama_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 579)->first()->nilai_prodi,

                    'pengembangandiri_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 581)->first()->nilai_prodi,
                    'pengembangandiri_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 582)->first()->nilai_prodi,
                    'pengembangandiri_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 583)->first()->nilai_prodi,
                    'pengembangandiri_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 584)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a12($lulusan, $lulusanterlacak, $penggunalulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.b1') {
                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 586)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 587)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 588)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 589)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 590)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 591)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 592)->first()->nilai_prodi,
                    'NC1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 593)->first()->nilai_prodi,
                    'NC2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 594)->first()->nilai_prodi,
                    'NC3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 585)->first()->nilai_prodi,
                ];

                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_prodi;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c9->c94b1($data, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.b2') {

                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 600)->first()->nilai_prodi;
                $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 601)->first()->nilai_prodi;
                $NC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 602)->first()->nilai_prodi;
                $ND = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 603)->first()->nilai_prodi;

                $result = $this->c9->c94b2($NA, $NB, $NC, $ND);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            // else if ($request->spmi_indikators_kode == 'LT.C.9.4.b3v') {

            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            //     $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
            //     // $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
            //     $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 276)->first()->nilai_prodi;
            //     // Get strata bcs difer threshold
            //     $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            //     $result = $this->c9->c94b3v($NAPJ, $strata->nama_strata);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } else if ($request->spmi_indikators_kode == 'LT.C.9.4.b3') {

            //     $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 277)->first()->nilai_prodi;
            //     // Get strata bcs difer threshold
            //     $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            //     $result = $this->c9->c94b3($NAS, $strata->nama_strata);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } else if ($request->spmi_indikators_kode == 'LT.C.9.4.b1d') {

            //     $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 284)->first()->nilai_prodi;
            //     $result = $this->c9->c94b1d($NAS);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // }
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

    public function komponencalculatelamteknik(Request $request)
    {
        $validated = $request->validate([
            'spmi_penilaianprodis_id' => 'numeric',
            'spmipenilaianindikatorsub_id' => 'numeric',
            'spmi_indikatorsubs_id' => 'numeric'
        ]);

        try {
            $spmi_indikatorsubs_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikatorsub_id)->first()->spmi_indikatorsubs_id;
            //dd($request);
            if ($spmi_indikatorsubs_id == 42) {
                $N1 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 324)->first();
                $N2 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 325)->first();
                $N3 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 326)->first();
                $NDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 327)->first();
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c2->c24dsubkoma($N1->nilai_prodi, $N2->nilai_prodi, $N3->nilai_prodi, $NDT->nilai_prodi, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 43) {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 328)->first();
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 329)->first();
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 330)->first();
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c2->c24dsubkomb($NI->nilai_prodi, $NN->nilai_prodi, $NW->nilai_prodi, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 45) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',331)->first()->nilai_prodi;
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 332)->first();
                $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 333)->first();

                // $result = $this->c3->c34asub1($NA, $NB);
                $result = $this->c3->c34asub1($NA->nilai_prodi, $NB->nilai_prodi);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 48) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',331)->first()->nilai_prodi;
                $NMUPPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 334)->first();
                $NMAFT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 335)->first();
                $NMAPT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 336)->first();
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c3->c34bsubb($NMUPPS->nilai_prodi, $NMAFT->nilai_prodi, $NMAPT->nilai_prodi, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 66) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',331)->first()->nilai_prodi;
                // rev: delete $kepuasan karena double
                $kepuasan = [
                    'reliability_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 412)->first()->nilai_prodi,
                    'reliability_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 413)->first()->nilai_prodi,
                    'reliability_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 414)->first()->nilai_prodi,
                    'reliability_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 415)->first()->nilai_prodi,

                    'responsiveness_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 417)->first()->nilai_prodi,
                    'responsiveness_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 418)->first()->nilai_prodi,
                    'responsiveness_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 419)->first()->nilai_prodi,
                    'responsiveness_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 420)->first()->nilai_prodi,

                    'assurance_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 422)->first()->nilai_prodi,
                    'assurance_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 423)->first()->nilai_prodi,
                    'assurance_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 424)->first()->nilai_prodi,
                    'assurance_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 425)->first()->nilai_prodi,

                    'empathy_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 427)->first()->nilai_prodi,
                    'empathy_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 428)->first()->nilai_prodi,
                    'empathy_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 429)->first()->nilai_prodi,
                    'empathy_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 430)->first()->nilai_prodi,

                    'tangible_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 432)->first()->nilai_prodi,
                    'tangible_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 433)->first()->nilai_prodi,
                    'tangible_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 434)->first()->nilai_prodi,
                    'tangible_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 435)->first()->nilai_prodi,
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
            if ($request->spmi_indikators_kode == 'LT.C.2.4.a') {
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 38)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 39)->first()->nilai_prodi;
                $result = $this->c2->c24asub($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.2.4.b') {
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 40)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 41)->first()->nilai_prodi;
                $result = $this->c2->c24bsub($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.2.4.c') {
                // rev: add LT.C.2.4.c
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikators_id', 134)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikators_id', 134)->first()->nilai_prodi;
                $result = $this->c2->c24bsub($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.2.4.d') {
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 43)->first()->nilai_prodi;

                $result = $this->c2->c24d($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.3.4.a') {
                $spmipenilaianindikators_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 44)->first()->id;
                $Pilihan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmipenilaianindikators_id)->where('spmi_indikatorkomponens_id', 331)->first()->nilai_prodi;
                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 45)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 46)->first()->nilai_prodi;

                $result = $this->c3->c34a($Pilihan, $a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.3.4.b') {

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 47)->first();
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 48)->first();


                $result = $this->c3->c34b($a->nilai_prodi, $b->nilai_prodi);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.3.4.c') {

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 49)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 50)->first()->nilai_prodi;

                $result = $this->c3->c34c($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            // rev: S2 S3
            // else if ($request->spmi_indikators_kode == 'LT.C.3.4.d') {

            //     $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 68)->first()->nilai_prodi;
            //     $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 69)->first()->nilai_prodi;
            //     $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 70)->first()->nilai_prodi;
            //     
            //     $result = $this->c3->c34d($a, $b, $c);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } else if ($request->spmi_indikators_kode == 'LT.C.3.4.e') {

            //     $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 71)->first()->nilai_prodi;
            //     $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 70)->first()->nilai_prodi;
            //     
            //     $result = $this->c3->c34e($a, $b);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // }
            else if ($request->spmi_indikators_kode == 'LT.C.4.4.a1') {
                // rev: add spmi_indikators_id
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 140)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44a1($NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.a2') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 141)->first()->id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NDS3 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 342)->first()->nilai_prodi;
                $result = $this->c4->c44a2($NDS3, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.a3') {


                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NDGB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 345)->first()->nilai_prodi;
                $NDLK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 346)->first()->nilai_prodi;
                $NDL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 347)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c4->c44a3($NDGB, $NDLK, $NDL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.a4') {
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                if ($strata->nama_strata == "S1") {
                    $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                    $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                    $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                    $spmi_penilaianindikator_id_pilihan = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 44)->first()->id;
                    $pilihan = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id_pilihan)->where('spmi_indikatorkomponens_id', 331)->first()->nilai_prodi;
                    $rendah = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 46)->first()->nilai_prodi;
                    $kelompok = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 349)->first()->nilai_prodi;
                    $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_prodi;

                    $result = $this->c4->c44a4($kelompok, $NM, $NDTPS, $pilihan, $rendah);
                } else if ($strata->nama_strata == "D4") {
                    $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                    $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                    $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                    $kelompok = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 349)->first()->nilai_prodi;
                    $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_prodi;

                    $result = $this->c4->c44a4v($kelompok, $NM, $NDTPS);
                }
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.a5') {

                $RDPU = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 353)->first()->nilai_prodi;
                $RDPUL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 24)->first()->nilai_prodi;
                $result = $this->c4->c44a5($RDPU, $RDPUL);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.a6') {

                $EWMPDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 26)->first()->nilai_prodi;
                $EWMPDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 27)->first()->nilai_prodi;
                $result = $this->c4->c44a6($EWMPDT, $EWMPDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }

            // rev : D4
            // else if ($request->spmi_indikators_kode == 'LT.C.4.4.a6v') {

            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            //     $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
            //     $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
            //     $NDSK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 272)->first()->nilai_prodi;
            //     $result = $this->c4->c44a6v($NDTPS, $NDSK);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } 

            // rev: .C.4.4.a7 tidak ada di excel
            // else if ($request->spmi_indikators_kode == 'LT.C.4.4.a7') {

            //     $NDTT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 355)->first()->nilai_prodi;
            //     $NDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 356)->first()->nilai_prodi;
            //     $result = $this->c4->c44a7($NDTT, $NDT);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // }

            // rev: D4
            // else if ($request->spmi_indikators_kode == 'LT.C.4.4.a7v') {

            //     $MKKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 273)->first()->nilai_prodi;
            //     $MKK = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 274)->first()->nilai_prodi;
            //     $result = $this->c4->c44a7v($MKKI, $MKK);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // }  
            else if ($request->spmi_indikators_kode == 'LT.C.4.4.b1') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NRD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 359)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b1($NRD, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.b2') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 362)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 362)->first()->nilai_prodi;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 364)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b2($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.b3') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 369)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 370)->first()->nilai_prodi;
                $NL = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 371)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b3($NI, $NN, $NL, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            // rev : D4
            // else if ($request->spmi_indikators_kode == 'LT.C.4.4.b3v') {

            //     
            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            //     $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
            //     $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
            //     $NRD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 283)->first()->nilai_prodi;
            //     $result = $this->c4->c44b3v($NRD, $NDTPS);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } 
            else if ($request->spmi_indikators_kode == 'LT.C.4.4.b4') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 375)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 376)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 377)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 368)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 379)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 380)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 381)->first()->nilai_prodi,
                    'NC1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 382)->first()->nilai_prodi,
                    'NC2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 183)->first()->nilai_prodi,
                    'NC3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 384)->first()->nilai_prodi,
                ];
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c4->c44b4($data, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.b5') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 388)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c4->c44b5($NAS, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.4.4.b6') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 391)->first()->nilai_prodi;
                $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 392)->first()->nilai_prodi;
                $NC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 393)->first()->nilai_prodi;
                $ND = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 394)->first()->nilai_prodi;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c4->c44b6($NA, $NB, $NC, $ND, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            // rev : D4
            // else if ($request->spmi_indikators_kode == 'LT.C.4.4.b7v') {

            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            //     $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
            //     $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
            //     $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 275)->first()->nilai_prodi;
            //     $result = $this->c4->c44a6v($NDTPS, $NAPJ);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } else if ($request->spmi_indikators_kode == 'LT.C.4.4.b6m') {

            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            //     $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
            //     $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
            //     $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 278)->first()->nilai_prodi;
            //     $result = $this->c4->c44b6m($NDTPS, $NAS);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } 
            // rev: LT.C.4.4.c dihapus karena kualitatif
            else if ($request->spmi_indikators_kode == 'LT.C.4.4.d') {

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 51)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $request->spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 52)->first()->nilai_prodi;

                $result = $this->c4->c44d($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.5.4.a1') {

                // $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikators_id', 20)->first()->id;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_prodi;
                $BOP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 398)->first()->nilai_prodi;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c5->c54a1($BOP, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.5.4.a2') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $DP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 401)->first()->nilai_prodi;
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c5->c54a2($DP, $NDTPS, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.5.4.a3') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
                $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
                $DPKM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 404)->first()->nilai_prodi;

                $result = $this->c5->c54a3($DPKM, $NDTPS);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.a') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 53)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 54)->first()->nilai_prodi;
                $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 55)->first()->nilai_prodi;


                $result = $this->c6->c64a($a, $b, $c);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.c') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 56)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 57)->first()->nilai_prodi;


                $result = $this->c6->c64c($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.d1') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 58)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 59)->first()->nilai_prodi;
                $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 60)->first()->nilai_prodi;
                $d = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 61)->first()->nilai_prodi;
                $e = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 62)->first()->nilai_prodi;


                $result = $this->c6->c64d1($a, $b, $c, $d, $e);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.d2') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $JP = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 407)->first()->nilai_prodi;
                $JB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 408)->first()->nilai_prodi;


                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c6->c64d2($JP, $JB, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.f') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 63)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 64)->first()->nilai_prodi;
                $c = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 65)->first()->nilai_prodi;



                $result = $this->c6->c64f($a, $b, $c);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.g') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // rev: delete $MK karena tidak ada di excel
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 410)->first()->nilai_prodi;


                $result = $this->c6->c64g($NA);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.j') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // rev: delete MKI MK, add $NMKI
                $NMKI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 411)->first()->nilai_prodi;



                $result = $this->c6->c64j($NMKI);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.6.4.l') {
                // rev: ganti LT.C.6.4.i ke LT.C.6.4.l
                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

                $a = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 66)->first()->nilai_prodi;
                $b = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 67)->first()->nilai_prodi;


                $result = $this->c6->c64i($a, $b);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.7.4.b') {

                $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
                // rev: delete NPKMD,  add NPD gak ada di excel
                $NPM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 438)->first()->nilai_prodi;
                $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 439)->first()->nilai_prodi;


                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c7->c74b($NPM, $NPD, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            // rev: S2 S3
            // else if ($request->spmi_indikators_kode == 'LT.C.7.4.cm') {

            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;

            //     $NPM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 281)->first()->nilai_prodi;
            //     $NPD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 282)->first()->nilai_prodi;
            //     
            //     
            //     // Get strata bcs difer threshold
            //     $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            //     $result = $this->c7->c74cm($NPM, $NPD, $strata->nama_strata);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } 
            else if ($request->spmi_indikators_kode == 'LT.C.8.4.b') {

                $NPKMM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 441)->first()->nilai_auditor;
                $NPKMD = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 442)->first()->nilai_auditor;

                $result = $this->c8->c84b($NPKMM, $NPKMD);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a2') {

                $lulusan = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 444)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 445)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 446)->first()->nilai_auditor,
                ];

                $ipk = [
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 447)->first()->nilai_auditor,
                    'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 448)->first()->nilai_auditor,
                    'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 449)->first()->nilai_auditor,
                ];

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c9->c94a2($lulusan, $ipk, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a3') {

                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 451)->first()->nilai_auditor;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 452)->first()->nilai_auditor;
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 453)->first()->nilai_auditor;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_auditor;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c9->c94a3($NI, $NN, $NW, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a4') {

                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 451)->first()->nilai_prodi;
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 452)->first()->nilai_prodi;
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 453)->first()->nilai_prodi;
                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_prodi;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c9->c94a4($NI, $NN, $NW, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a5') {
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

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
                        // rev: add ts6, ts3ts6, ts2ts6, ts1ts6, ts1ts6, tMS 
                        'ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 465)->first()->nilai_prodi,
                        'ts3ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 466)->first()->nilai_prodi,
                        'ts2ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 467)->first()->nilai_prodi,
                        'ts1ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 468)->first()->nilai_prodi,
                        'tsts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 469)->first()->nilai_prodi,
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 470)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 471)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 472)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 473)->first()->nilai_prodi,
                    ];
                }

                $result = $this->c9->c94a5($lulusan, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a6') {
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
                        'ts6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 465)->first()->nilai_prodi,
                        'ts5' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 466)->first()->nilai_prodi,
                        'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 467)->first()->nilai_prodi,
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 468)->first()->nilai_prodi,
                    ];
                    $lulusan = [
                        'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 470)->first()->nilai_prodi,
                        'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 471)->first()->nilai_prodi,
                        'ts1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 472)->first()->nilai_prodi,
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 473)->first()->nilai_prodi,
                    ];
                }


                $result = $this->c9->c94a6($diterima, $lulusan, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a7') {
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                // rev: delete ts3, ts2, ts1
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
                    $dt = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 478)->first()->nilai_prodi;
                    // $dt = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 479)->first()->nilai_prodi; // Jumlah mahasiswa terdaftar pada TS	
                    $lulusan = [
                        'ts' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 480)->first()->nilai_prodi,
                    ];
                }
                $result = $this->c9->c94a7($lulusan, $dt, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a9') {

                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 482)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 483)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 484)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 485)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 486)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 487)->first()->nilai_prodi,
                ];

                $tahunlulus = [
                    'tlts4wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 491)->first()->nilai_prodi,
                    'tlts4wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 492)->first()->nilai_prodi,
                    'tlts4wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 493)->first()->nilai_prodi,
                    'tlts3wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 494)->first()->nilai_prodi,
                    'tlts3wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 495)->first()->nilai_prodi,
                    'tlts3wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 496)->first()->nilai_prodi,
                    'tlts2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 497)->first()->nilai_prodi,
                    'tlts2wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 498)->first()->nilai_prodi,
                    'tlts2wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 499)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a9($lulusan, $lulusanterlacak, $tahunlulus);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a10') {
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 501)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 502)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 503)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 504)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 505)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 506)->first()->nilai_prodi,
                ];

                $kesesuaianlulusan = [
                    'tlts4wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 510)->first()->nilai_prodi,
                    'tlts4wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 511)->first()->nilai_prodi,
                    'tlts4wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 512)->first()->nilai_prodi,
                    'tlts3wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 513)->first()->nilai_prodi,
                    'tlts3wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 514)->first()->nilai_prodi,
                    'tlts3wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 515)->first()->nilai_prodi,
                    'tlts2wt3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 516)->first()->nilai_prodi,
                    'tlts2wt36' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 517)->first()->nilai_prodi,
                    'tlts2wt6' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 518)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a10($lulusan, $lulusanterlacak, $kesesuaianlulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a11') {
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 520)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 521)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 522)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 523)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 524)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 525)->first()->nilai_prodi,
                ];

                $lulusantingkat = [
                    'NIts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 529)->first()->nilai_prodi,
                    'NNts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 530)->first()->nilai_prodi,
                    'NWts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 531)->first()->nilai_prodi,
                    'NIts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 532)->first()->nilai_prodi,
                    'NNts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 533)->first()->nilai_prodi,
                    'NWts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 534)->first()->nilai_prodi,
                    'NIts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 535)->first()->nilai_prodi,
                    'NNts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 536)->first()->nilai_prodi,
                    'NWts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 537)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a11($lulusan, $lulusanterlacak, $lulusantingkat);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.a12') {
                $lulusan = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 541)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 542)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 543)->first()->nilai_prodi,
                ];

                $lulusanterlacak = [
                    'ts4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 544)->first()->nilai_prodi,
                    'ts3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 545)->first()->nilai_prodi,
                    'ts2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 546)->first()->nilai_prodi,
                ];

                $penggunalulusan = [
                    'etika_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 550)->first()->nilai_prodi,
                    'etika_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 551)->first()->nilai_prodi,
                    'etika_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 552)->first()->nilai_prodi,
                    'etika_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 553)->first()->nilai_prodi,

                    'keahlian_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 555)->first()->nilai_prodi,
                    'keahlian_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 556)->first()->nilai_prodi,
                    'keahlian_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 557)->first()->nilai_prodi,
                    'keahlian_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 558)->first()->nilai_prodi,

                    'bahasa_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 560)->first()->nilai_prodi,
                    'bahasa_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 561)->first()->nilai_prodi,
                    'bahasa_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 562)->first()->nilai_prodi,
                    'bahasa_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 563)->first()->nilai_prodi,

                    'teknologiinformasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 565)->first()->nilai_prodi,
                    'teknologiinformasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 567)->first()->nilai_prodi,
                    'teknologiinformasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 568)->first()->nilai_prodi,
                    'teknologiinformasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 569)->first()->nilai_prodi,

                    'komunikasi_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 571)->first()->nilai_prodi,
                    'komunikasi_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 572)->first()->nilai_prodi,
                    'komunikasi_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 573)->first()->nilai_prodi,
                    'komunikasi_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 574)->first()->nilai_prodi,

                    'kerjasama_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 576)->first()->nilai_prodi,
                    'kerjasama_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 577)->first()->nilai_prodi,
                    'kerjasama_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 578)->first()->nilai_prodi,
                    'kerjasama_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 579)->first()->nilai_prodi,

                    'pengembangandiri_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 581)->first()->nilai_prodi,
                    'pengembangandiri_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 582)->first()->nilai_prodi,
                    'pengembangandiri_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 583)->first()->nilai_prodi,
                    'pengembangandiri_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 584)->first()->nilai_prodi,
                ];

                $result = $this->c9->c94a12($lulusan, $lulusanterlacak, $penggunalulusan);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.b1') {
                $data = [
                    'NA1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 586)->first()->nilai_prodi,
                    'NA2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 587)->first()->nilai_prodi,
                    'NA3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 588)->first()->nilai_prodi,
                    'NA4' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 589)->first()->nilai_prodi,
                    'NB1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 590)->first()->nilai_prodi,
                    'NB2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 591)->first()->nilai_prodi,
                    'NB3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 592)->first()->nilai_prodi,
                    'NC1' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 593)->first()->nilai_prodi,
                    'NC2' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 594)->first()->nilai_prodi,
                    'NC3' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 585)->first()->nilai_prodi,
                ];

                $NM = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 350)->first()->nilai_prodi;

                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();

                $result = $this->c9->c94b1($data, $NM, $strata->nama_strata);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            } else if ($request->spmi_indikators_kode == 'LT.C.9.4.b2') {

                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 600)->first()->nilai_prodi;
                $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 601)->first()->nilai_prodi;
                $NC = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 602)->first()->nilai_prodi;
                $ND = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 603)->first()->nilai_prodi;

                $result = $this->c9->c94b2($NA, $NB, $NC, $ND);

                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            }
            // else if ($request->spmi_indikators_kode == 'LT.C.9.4.b3v') {

            //     $spmi_penilaianprodis_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikator_id)->first()->spmi_penilaianprodis_id;
            //     $spmi_penilaianindikator_id = Spmipenilaianindikator::where('spmi_penilaianprodis_id', $spmi_penilaianprodis_id)->where('spmi_indikatorsubs_id', 42)->first()->id;
            //     // $NDTPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $spmi_penilaianindikator_id)->where('spmi_indikatorkomponens_id', 327)->first()->nilai_prodi;
            //     $NAPJ = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 276)->first()->nilai_prodi;
            //     // Get strata bcs difer threshold
            //     $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            //     $result = $this->c9->c94b3v($NAPJ, $strata->nama_strata);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } else if ($request->spmi_indikators_kode == 'LT.C.9.4.b3') {

            //     $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 277)->first()->nilai_prodi;
            //     // Get strata bcs difer threshold
            //     $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
            //     $result = $this->c9->c94b3($NAS, $strata->nama_strata);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // } else if ($request->spmi_indikators_kode == 'LT.C.9.4.b1d') {

            //     $NAS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikator_id)->where('spmi_indikatorkomponens_id', 284)->first()->nilai_prodi;
            //     $result = $this->c9->c94b1d($NAS);

            //     $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikator_id);
            // }
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

    public function komponencalculateauditorlamteknik(Request $request)
    {
        $validated = $request->validate([
            'spmi_penilaianprodis_id' => 'numeric',
            'spmipenilaianindikatorsub_id' => 'numeric',
            'spmi_indikatorsubs_id' => 'numeric'
        ]);

        try {
            $spmi_indikatorsubs_id = Spmipenilaianindikator::where('id', $request->spmipenilaianindikatorsub_id)->first()->spmi_indikatorsubs_id;
            //dd($request);
            if ($spmi_indikatorsubs_id == 42) {
                $N1 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 324)->first();
                $N2 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 325)->first();
                $N3 = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 326)->first();
                $NDT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 327)->first();
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c2->c24dsubkoma($N1->nilai_prodi, $N2->nilai_prodi, $N3->nilai_prodi, $NDT->nilai_prodi, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 43) {
                $NI = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 328)->first();
                $NN = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 329)->first();
                $NW = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 330)->first();
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c2->c24dsubkomb($NI->nilai_prodi, $NN->nilai_prodi, $NW->nilai_prodi, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 45) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',331)->first()->nilai_prodi;
                $NA = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 332)->first();
                $NB = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 333)->first();

                // $result = $this->c3->c34asub1($NA, $NB);
                $result = $this->c3->c34asub1($NA->nilai_prodi, $NB->nilai_prodi);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 48) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',331)->first()->nilai_prodi;
                $NMUPPS = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 334)->first();
                $NMAFT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 335)->first();
                $NMAPT = Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 336)->first();
                // Get strata bcs difer threshold
                $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                $result = $this->c3->c34bsubb($NMUPPS->nilai_prodi, $NMAFT->nilai_prodi, $NMAPT->nilai_prodi, $strata->nama_strata);
                $spmipenilaianindikator = Spmipenilaianindikator::findOrFail($request->spmipenilaianindikatorsub_id);
            } else if ($spmi_indikatorsubs_id == 66) {
                // $Prodi = Spmipindikatorkomponen::where('spmi_penilaianindikators_id',$request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id',331)->first()->nilai_prodi;
                // rev: delete $kepuasan karena double
                $kepuasan = [
                    'reliability_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 412)->first()->nilai_prodi,
                    'reliability_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 413)->first()->nilai_prodi,
                    'reliability_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 414)->first()->nilai_prodi,
                    'reliability_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 415)->first()->nilai_prodi,

                    'responsiveness_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 417)->first()->nilai_prodi,
                    'responsiveness_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 418)->first()->nilai_prodi,
                    'responsiveness_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 419)->first()->nilai_prodi,
                    'responsiveness_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 420)->first()->nilai_prodi,

                    'assurance_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 422)->first()->nilai_prodi,
                    'assurance_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 423)->first()->nilai_prodi,
                    'assurance_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 424)->first()->nilai_prodi,
                    'assurance_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 425)->first()->nilai_prodi,

                    'empathy_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 427)->first()->nilai_prodi,
                    'empathy_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 428)->first()->nilai_prodi,
                    'empathy_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 429)->first()->nilai_prodi,
                    'empathy_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 430)->first()->nilai_prodi,

                    'tangible_sangatbaik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 432)->first()->nilai_prodi,
                    'tangible_baik' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 433)->first()->nilai_prodi,
                    'tangible_cukup' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 434)->first()->nilai_prodi,
                    'tangible_kurang' => Spmipindikatorkomponen::where('spmi_penilaianindikators_id', $request->spmipenilaianindikatorsub_id)->where('spmi_indikatorkomponens_id', 435)->first()->nilai_prodi,
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
}
