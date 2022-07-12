<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //Index func
    public function index(){

        if (Session::get('userData') != null){
            return redirect('/dashboard');
        }

        return view('cms/login');
    }

    //func signin
    public function signin(Request $r){

        $user = DB::table('users')->where('email', $r->email);

        $resp = ['success' => false, 'data' => 'Invalid Credentials'];
        
        //Check if user exists && matches the password
        if ($user->count() > 0 && Hash::check($r->password, $user->get('password')[0]->password)){

            Session::put('userData', 
                ['email' => $user->get('email')[0]->email,
                'name' => $user->get('name')[0]->name,
                'id' => $user->get('userID')[0]->userID]
            );

            $resp = ['success' => true, 'data' => '/dashboard'];
        }

        return response()->json($resp);
    }

    //func signout
    public function signout(Request $r){
        Session::forget('userData');

        return redirect('/login');
    }

}