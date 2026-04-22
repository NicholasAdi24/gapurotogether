<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class AuthAdminController extends Controller
{
    public function role(Request $request)
    {


        return view('role');
    }
}
