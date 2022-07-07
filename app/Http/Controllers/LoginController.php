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

    //func signin
    public function signin(Request $r){

        if (Auth::attempt( 
            array(
                'email' => $r->email,
                'password' => $r->password
            )
        )){ //Success

            

            return response()->json([
                'response' => 'logged in'
            ]);

        } else { // Fail
            return response()->json([
                'response' => 'false credentials'
            ]);
        }

    }

}
