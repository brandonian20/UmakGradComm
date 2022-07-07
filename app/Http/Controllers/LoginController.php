<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //Index func
    public function index(){
        return view('cms/login');
    }

    //func login
    public function list(){
        return response()->json([
            'data' => DB::table('users')
        ]);
    }

    //func signin
    public function signin(Request $r){

        $user = DB::table('users')->where('email', $r->email);

        $resp = ['success' => false, 'data' => 'Invalid Credentials'];
        
        if ($user->count() > 0 && Hash::check($r->password, $user->get('password')[0]->password)){
            $resp = ['success' => true, 'data' => '/dashboard'];
        }

        return response()->json($resp);

    }

}
