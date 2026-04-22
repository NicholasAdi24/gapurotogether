<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;

use App\Models\Fakultas;
use App\Models\Userrole;
use App\Models\Spmiperiode;
use App\Models\Programstudi;
use Illuminate\Http\Request;
use App\Models\Usersfakultas;
use App\Models\Spmeakreditasi;
use App\Models\Userprogramstudi;
use App\Models\Spmipenilaianprodi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Spmipenilaianindikatorscalc;


class AuthController extends Controller
{
    public function loginattempt(Request $request)
    {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|min:6',
            'captcha' => 'required|captcha', // validate captcha
        ], [
            'captcha.required' => 'Please enter the captcha.',
            'captcha.captcha'  => 'Captcha is incorrect, please try again.',
        ]);



        if ($validator->fails()) {
             // 👇 add a new captcha to the error response
            return back()
            ->withErrors($validator)
            ->withInput()
            ->with('captcha_reload', captcha_src());
        }

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $users = User::where('email', $request->input('email'))->first();
            $users->last_login = Carbon::now('Asia/Jakarta');
            $users->save();
            
            $request->session()->put('user', $users);



            return redirect()->route('chooserole');
            // return redirect()->intended('dashboard')
            //             ->withSuccess('Signed in');
        }
        $validator2['emailPassword'] = 'Email address or password is incorrect.';
        return redirect("login")->withErrors($validator2);
    }

    public function chooserole(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where('users_id', $users->id)->get();
        
        // return view("chooserole",['userroles' => $userroles]);
        return view("chooserole", ['users' => $users, 'userroles' => $userroles]);
    }

    public function chooseroleattempt(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where(['users_id' => $users->id, 'roles_id' => $request->input('roles_id')])->get();
        $roles = Role::where(['id' => $request->input('roles_id')])->first();
        //dd($userroles);
        if ($userroles) {
            $request->session()->put('roles', $roles);
            $validator['roles'] = 'Roles is correct.';
            if ($request->input('roles_id') == 1) {
                return view("pages.dashboard", ['users' => $users, 'userroles' => $userroles]);
            } else if ($request->input('roles_id') == 7 || $request->input('roles_id') == 13 || $request->input('roles_id') == 8) {
                $spmiperiodes = Spmiperiode::where('status', 1)->get();
                $fakultasIds = Usersfakultas::where('users_id', $users->id)
                    ->pluck('fakultas_id');
                $prodis = Programstudi::with(['spmipenilaianprodi.spmiperiode'])
                    ->whereIn('fakultass_id', $fakultasIds)
                    ->get();

                return view("pagesprodi.dashboard", ['userroles' => $userroles, 'users' => $users, 'spmiperiodes' => $spmiperiodes, 'fakultas_id' => $fakultasIds->first(), 'prodis' => $prodis]);
            } else {
                $prodis = Userprogramstudi::where(['users_id' => $users->id])->get();
                $spmiperiodes = Spmiperiode::all();
                //dd($spmiperiodes);
                // Di sini
                return view("pagesprodi.dashboard", ['userroles' => $userroles, 'users' => $users, 'prodis' => $prodis]);
            }
            return view("chooserole", ['users' => $users]);
        } else {
            $validator['roles'] = 'Roles is incorrect.';
            return view("chooserole", ['users' => $users, 'userroles' => $userroles]);
        }
    }



    public function chooseprodiattempt(Request $request)
    {

        $programstudi = Programstudi::where(['id' => $request->input('prodi_id')])->first();
        if ($programstudi) {

            $request->session()->put('programstudi', $programstudi);
            $validator['programstudi'] = 'Roles is correct.';

            

            return redirect("dashboardprodi2");
            // return view("pagesprodi.dashboard",['programstudi' => $programstudi, 'akreditasis' => $akreditasis]);

        } else {
            $validator['programstudi'] = 'Prodi is incorrect.';
            return back();
        }
    }

    public function dashboardprodi2(Request $request)
    {
        $users = User::where('email', session()->get('user')->email)->first();
        $userroles = Userrole::where(['users_id' => $users->id, 'roles_id' => $request->input('roles_id')])->get();
        
        if (session()->get('programstudi') != NULL) {
            $akreditasis = Spmeakreditasi::where('programstudis_id', session()->get('programstudi')->id)->get();
        }

        return view("pagesprodi.dashboard", ['akreditasis' => $akreditasis, 'userroles' => $userroles]);
    }


    public function logoutattempt(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user');
        $request->session()->forget('programstudi');
        return redirect("/");
    }

    public function logoutprodi(Request $request)
    {
        $request->session()->forget('programstudi');
        return redirect("chooserole");
    }

    public function GetUser(Request $request)
    {
        if($request->ajax()) {
            $users = User::where('id', '!=', 1)->get();

            //  // Optional: filter by role if filter is sent
            // if ($request->has('role') && $request->role != '') {
            //     $users->where('roles_id', $request->role);
            // }

            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                    return '
                        <button data-id="'.$row->id.'" class="btn btn-sm btn-warning editBtn">Edit</button>
                        <button data-id="'.$row->id.'" class="btn btn-sm btn-danger deleteBtn">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
            ->make(true);
        }
        $roles = Role::where('id', '!=', 1)->get();
        
        return view("pages.user", ['roles' => $roles]);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->email_verified_at = NULL;
        $user->password = $request->password;
        $user->image = $request->image;
        $user->status = $request->status;
        $user->last_login = NULL;
        $user->remember_token = NULL;
        $user->created_at = Carbon::now('Asia/Jakarta');
        $user->updated_at = NULL;
        $user->save();

        return redirect()->back()->with('success', 'Users created successfully!');
    }

    public function edit(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        if($request->password){
            $user->password = $request->password;
        }

        $user->image = $request->image;
        $user->status = $request->status;
        $user->updated_at = Carbon::now('Asia/Jakarta');
        
        $user->save();

        return response()->json(['success' => true, 'message' => 'User updated successfully']);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }

    public function GetRole(Request $request)
    {
        $roles = Role::all();
        
        return view("pages.role", ['roles' => $roles]);
    }

    public function GetUserrole(Request $request)
    {

        if($request->ajax()) {
            $userroles = DB::table('users_roles')
                    ->join('users', 'users_roles.users_id','=', 'users.id')
                    ->join('roles', 'users_roles.roles_id','=', 'roles.id')
                    ->where('users_roles.id', '!=', 1)
                    ->orderBy('users_roles.id', 'asc')
                    ->select(
                'users_roles.id as id',
                        'users.id as users_id',
                        'roles.id as roles_id',
                        'users.email',
                        'roles.name as roles',
                        'users_roles.status as status',
                        'users_roles.updated_at as updated',
                    )
                    ->get();

            return DataTables::of($userroles)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                    return '
                        <button data-id="'.$row->id.'" class="btn btn-sm btn-warning editBtn">Edit</button>
                        <button data-id="'.$row->id.'" class="btn btn-sm btn-danger deleteBtn">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
            ->make(true);
        }
        $users = User::where('id', '!=', 1)->get();
        $roles = Role::where('id', '!=', 1)->get();
        // $roles = Role::where('id', '!=', 1)->get();
        
        return view("pages.userrole",['roles' => $roles, 'users' => $users]);
    }

    public function userrolesstore(Request $request)
    {
        $userrole = new Userrole;
        $userrole->users_id = $request->email;
        $userrole->roles_id = $request->role;
        $userrole->status = $request->status;
        $userrole->created_at = Carbon::now('Asia/Jakarta');
        $userrole->updated_at = NULL;
        $userrole->save();

        return redirect()->back()->with('success', 'User roles created successfully!');
    }

    public function userrolesdestroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }

    public function userrolesshow($id)
    {
        $userrole = DB::table('users_roles')
                    ->join('users', 'users_roles.users_id','=', 'users.id')
                    ->join('roles', 'users_roles.roles_id','=', 'roles.id')
                    ->where('users_roles.id', '=', $id)
                    ->orderBy('users_roles.id', 'asc')
                    ->select(
                'users_roles.id as id',
                        'users.id as users_id',
                        'roles.id as roles_id',
                        'users.email',
                        'roles.name as roles',
                        'users_roles.status as status',
                        'users_roles.updated_at as updated',
                    )
                    ->get();

        return $userrole[0];
    }

    public function userrolesedit(Request $request,$id)
    {
        $userrole = Userrole::findOrFail($id);
        $userrole->users_id = $request->email;
        $userrole->roles_id = $request->role;
        $userrole->status = $request->status;
        $userrole->created_at = NULL;
        $userrole->updated_at = Carbon::now('Asia/Jakarta');
        $userrole->save();

        return response()->json(['success' => true, 'message' => 'User updated successfully']);
    }

    public function GetUserprodi(Request $request)
    {
        if($request->ajax()) {
            $userprodis = DB::table('users_programstudis')
                    ->join('users', 'users_programstudis.users_id','=', 'users.id')
                    ->join('programstudis', 'users_programstudis.programstudis_id','=', 'programstudis.id')
                    ->where('users_programstudis.users_id', '!=', 1)
                    ->orderBy('users_programstudis.id', 'asc')
                    ->select(
                'users_programstudis.id as id',
                        'users.id as users_id',
                        'programstudis.id as programstudis_id',
                        'users.email',
                        'programstudis.nama_prodi as nama_prodi',
                        'users_programstudis.status as status',
                        'users_programstudis.updated_at as updated',
                    )
                    ->get();

            return DataTables::of($userprodis)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                    return '
                        <button data-id="'.$row->id.'" class="btn btn-sm btn-warning editBtn">Edit</button>
                        <button data-id="'.$row->id.'" class="btn btn-sm btn-danger deleteBtn">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
            ->make(true);
        }
        $users = User::where('id', '!=', 1)->get();
        $programstudis = Programstudi::where('id', '!=', 1)->get();
        // $prodis = Role::where('id', '!=', 1)->get();
        
        return view("pages.userprodi",['programstudis' => $programstudis, 'users' => $users]);
    }

    public function userprodisstore(Request $request)
    {
        $userprodi = new Userprogramstudi();
        $userprodi->users_id = $request->email;
        $userprodi->programstudis_id = $request->programstudi;
        $userprodi->status = $request->status;
        $userprodi->created_at = Carbon::now('Asia/Jakarta');
        $userprodi->updated_at = NULL;
        $userprodi->save();

        return redirect()->back()->with('success', 'User prodis created successfully!');
    }

    public function userprodisdestroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }

    public function userprodisshow($id)
    {
        $userprodi = DB::table('users_programstudis')
                    ->join('users', 'users_programstudis.users_id','=', 'users.id')
                    ->join('programstudis', 'users_programstudis.programstudis_id','=', 'programstudis.id')
                    ->where('users_programstudis.id', '=', $id)
                    ->orderBy('users_programstudis.id', 'asc')
                    ->select(
                'users_programstudis.id as id',
                        'users.id as users_id',
                        'programstudis.id as programstudis_id',
                        'users.email',
                        'programstudis.nama_prodi as nama_prodi',
                        'users_programstudis.status as status',
                        'users_programstudis.updated_at as updated',
                    )
                    ->get();

        return $userprodi[0];
    }

    public function userprodisedit(Request $request,$id)
    {
        $userprodi = Programstudi::findOrFail($id);
        $userprodi->users_id = $request->email;
        $userprodi->programstudis_id = $request->programstudi;
        $userprodi->status = $request->status;
        $userprodi->created_at = NULL;
        $userprodi->updated_at = Carbon::now('Asia/Jakarta');
        $userprodi->save();

        return response()->json(['success' => true, 'message' => 'User updated successfully']);
    }

    public function GetUserfakultas(Request $request)
    {


        if($request->ajax()) {
            $userfakultass = DB::table('users_fakultas')
                    ->join('users', 'users_fakultas.users_id','=', 'users.id')
                    ->join('fakultass', 'users_fakultas.fakultas_id','=', 'fakultass.id')
                    // ->where('users_fakultas.users_id', '!=', 1)
                    ->orderBy('users_fakultas.id', 'asc')
                    ->select(
                'users_fakultas.id as id',
                        'users.id as users_id',
                        'fakultass.id as fakultas_id',
                        'users.email',
                        'fakultass.nama_fakultas as nama_fakultas',
                    )
                    ->get();

            return DataTables::of($userfakultass)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                    return '
                        <button data-id="'.$row->id.'" class="btn btn-sm btn-warning editBtn">Edit</button>
                        <button data-id="'.$row->id.'" class="btn btn-sm btn-danger deleteBtn">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
            ->make(true);
        }
        $users = User::where('id', '!=', 1)->get();
        $fakultass = Fakultas::all();
        // $fakultass = Role::where('id', '!=', 1)->get();
        
        return view("pages.userfakultas",['fakultass' => $fakultass, 'users' => $users]);
    }

    public function userfakultassstore(Request $request)
    {
        $userfakultas = new Usersfakultas;
        $userfakultas->users_id = $request->email;
        $userfakultas->fakultas_id = $request->fakultas;
        $userfakultas->timestamps = false; // ✅ nonaktifkan timestamp hanya untuk object ini

        $userfakultas->save();

        return redirect()->back()->with('success', 'User fakultass created successfully!');
    }

    public function userfakultassdestroy($id)
    {
        Usersfakultas::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }

    public function userfakultassshow($id)
    {
        $userfakultas = DB::table('users_fakultas')
                    ->join('users', 'users_fakultas.users_id','=', 'users.id')
                    ->join('fakultass', 'users_fakultas.fakultas_id','=', 'fakultass.id')
                    ->where('users_fakultas.id', '=', $id)
                    ->orderBy('users_fakultas.id', 'asc')
                    ->select(
                'users_fakultas.id as id',
                        'users.id as users_id',
                        'fakultass.id as fakultas_id',
                        'users.email',
                        'fakultass.nama_fakultas as nama_fakultas',
                    )
                    ->get();

        return $userfakultas[0];
    }

    public function userfakultassedit(Request $request,$id)
    {
        $userfakultas = Usersfakultas::findOrFail($id);
        $userfakultas->users_id = $request->email;
        $userfakultas->fakultas_id = $request->fakultas;
        $userfakultas->timestamps = false; // ✅ nonaktifkan timestamp hanya untuk object ini
        $userfakultas->save();

        return response()->json(['success' => true, 'message' => 'User updated successfully']);
    }

    public function changepassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:6|confirmed',
            ],[
                'old_password.required' => 'Password lama wajib diisi.',
                'new_password.required' => 'Password baru wajib diisi.',
                'new_password.min'      => 'Password baru minimal harus 6 karakter.',
                'new_password.confirmed'=> 'Konfirmasi password baru tidak cocok, silakan periksa kembali.',
            ]
            );

            $user = User::findOrFail(session()->get('user')->id);

            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Password lama salah']);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return back()->with('status', 'Password berhasil diubah!');
        }

        return view("pagesprodi.changepassword");
    }






}
