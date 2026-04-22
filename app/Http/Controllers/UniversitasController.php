<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fakultas;
use App\Models\Programstudi;

class UniversitasController extends Controller
{
    public function GetFakultas(Request $request)
    {
        $fakultass = Fakultas::all();

        return view("pages.fakultas", ['fakultass' => $fakultass]);
    }

    public function GetProgramstudi(Request $request)
    {
        $programstudis = Programstudi::all();

        return view("pages.programstudi", ['programstudis' => $programstudis]);
    }
}
