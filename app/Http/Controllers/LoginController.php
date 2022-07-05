<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //Index func
    public function index(){
        return view('login/index');
    }

    //Signin func
    public function signin(){
        return response()->json([
            'name' => 'Brandon'
        ]);
    }

}
