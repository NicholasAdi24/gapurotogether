<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Carbon\Carbon;
use App\Models\Programstudi;
use App\Models\Spmipenilaianprodi;
use App\Models\Spmiperiode;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminpenjamuController extends Controller
{
    public function adminrekappenjamu(Request $request)
    {
        if($request->ajax()) {
            $spmipenilaianprodis = Spmipenilaianprodi::with(['programstudi.getfakultas']);

            // kalau ada filter status dari dropdown
            // Filter multi-status
            if (!empty($request->status)) {
                $spmipenilaianprodis->whereIn('status', $request->status);
            }

            // filter fakultas (via relasi programstudi -> fakultas_id)
            if ($request->fakultas != '') {
                $spmipenilaianprodis->whereHas('programstudi.getfakultas', function($q) use ($request) {
                    $q->where('id', $request->fakultas);
                });
            }

            // filter periode (via relasi spmi_periodes_id)
            if ($request->periode != '') {
                $spmipenilaianprodis->where('spmi_periodes_id', $request->periode);
            }



            return DataTables::eloquent($spmipenilaianprodis)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                switch ($row->status ?? 0) {
                    case 1:
                        return '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-info">TELAH DIISI OLEH PRODI</span>';
                    case 2:
                        return '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-primary">TELAH DIKALKULASI OLEH PRODI</span>';
                    case 3:
                        return '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKUNCI NILAI OLEH PRODI</span>';
                    case 4:
                        return '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-success">TELAH DIVALIDASI OLEH WADEK 1</span>';
                    case 5:
                        return '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-info">TELAH DIVALIDASI OLEH DEKAN</span>';
                    case 6:
                        return '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-primary">PROSES AUDIT</span>';
                    case 7:
                        return '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIISI OLEH AUDITOR</span>';
                    case 8:
                        return '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKALKULASI OLEH AUDITOR</span>';
                    case 9:
                        return '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKUNCI NILAI OLEH AUDITOR</span>';
                    case 10:
                        return '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-info">PROSES AL</span>';
                    default:
                        return '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-danger">BELUM DIISI</span>';
                }
            })
            ->addColumn('action', function($row) {
                    return '';
            })
            ->rawColumns(['status','action'])
            ->make(true);
        }

        $fakultas = Fakultas::All();
        $periode = Spmiperiode::All();
        return view('pages.penjamurekap',[
        "allFakultas" => $fakultas,
        "allPeriode" => $periode,
        ]);
    }

}

