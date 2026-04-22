<?php

namespace App\Http\Controllers;

use App\Models\Spmibobot;
use Illuminate\Http\Request;
use App\Models\Spmielemen;
use App\Models\Spmiindikator;
use App\Models\Spmiindikatorsub;
use App\Models\Spmiindikatorkualitatif;
use App\Models\Spmiindikatorkomponen;

class SpmiController extends Controller
{
    public function GetSpmielemen(Request $request)
    {
        $spmielemens = Spmielemen::all();

        return view("pages.spmielemen", ['spmielemens' => $spmielemens]);
    }

    public function GetSpmielemenid($id)
    {
        $spmielemen = Spmielemen::find($id);

        $spmiindikators = Spmiindikator::where('spmi_elemens_id', $spmielemen->id)->get();
        return view("pages.spmiindikator", ['spmiindikators' => $spmiindikators]);
    }

    public function GetSpmiindikator(Request $request)
    {
        $spmielemens = Spmielemen::all();
        $spmiindikators = Spmiindikator::all();
        // foreach($spmielemens as $spmielemen) {
        //     $spmiindikators[] = Spmiindikator::where('spmi_elemens_id', $spmielemen->id)->get();
        // }

        return view("pages.spmiindikatorall", ['spmiindikators' => $spmiindikators, 'spmielemens' => $spmielemens]);
    }

    public function GetSpmibobot(Request $request)
    {
        $spmiindikators = Spmiindikator::all();

        return view("pages.spmibobot", ['spmiindikators' => $spmiindikators]);
    }



    public function GetSpmiindikatorid($id)
    {
        // indikator
        $spmiindikator = Spmiindikator::find($id);

        // sub indikator
        $spmiindikatorsubs = Spmiindikatorsub::where('spmi_indikators_id', $spmiindikator->id)->get();
        // foreach($spmiindikatorsubs as $spmiindikatorsub) {
        //     
        //     if(($spmiindikatorsub->getKomponen)->isNotEmpty()){
        //         $tes[] = $spmiindikatorsub->getKomponen;
        //     }
        //     // $tes[] = $spmiindikatorsub->getKomponen;
        // }


        return view("pages.spmiindikatordetail", [
            'spmiindikator' => $spmiindikator,
            'spmiindikatorsubs' => $spmiindikatorsubs,
        ]);
    }
}
