<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\User;



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

    public function checkSession(Request $r){
        return $r->session('userData');
    }

    //func signin
    public function signin(Request $r){

        $user = DB::table('users')->where('email', $r->email);

        $resp = ['success' => false, 'data' => 'Invalid Credentials'];
        
        //Check if user exists && matches the password
        if ($user->count() > 0 && Hash::check($r->password, $user->get('password')[0]->password)){

            session(['userData' => 'logged in']);

            $resp = ['success' => true, 'data' => '/dashboard'];
        }

        return response()->json($resp);

    }

    //func signout
    public function signout(Request $r){

       $r->session()->forget('userData');

        return response()->json(['logout success']);

    }

}
