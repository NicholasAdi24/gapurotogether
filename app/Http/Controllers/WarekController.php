<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Userrole;

use App\Models\Programstudi;
use Illuminate\Http\Request;
use App\Models\Spmeakreditasi;
use App\Models\Userprogramstudi;
use App\Models\Spmipenilaianprodi;
use App\Models\Spmiperiode;
use App\Models\Spmipenilaianindikatorscalc;
use App\Models\Fakultas;
use App\Models\Usersfakultas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class WarekController extends Controller
{

    public function monitorpenilaianwarek(Request $request)
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

        return view('monitorpenilaianwarek', compact('userroles', 'data', 'allFakultas', 'allPeriode'));
    }


    public function penjaminanmutuprodiwarek(Request $request)
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
