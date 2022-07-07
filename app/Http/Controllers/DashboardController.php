<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //Index func
    public function index(){
        return view('cms/_layout');
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
        )){
            return response()->json([
                'response' => 'logged in'
            ]);
        } else {
            return response()->json([
                'response' => 'false credentials'
            ]);
        }

    }

}
