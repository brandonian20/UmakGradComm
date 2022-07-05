<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //Index func
    public function index(){
        return view('cms/login');
    }

    //Signin func
    public function signin(){
        return response()->json([
            'name' => Crypt::encrypt('Brandon')
        ]);
    }

    //func
    public function decrypt(Request $r){
        return response()->json([
            'name' => Crypt::decrypt($r->Name)
        ]);
    }

    //func
    public function hash(Request $r){
        return response()->json([
            'hashed' => Hash::make($r->Name)
        ]);
    }

    //func
    public function hashcheck(Request $r){
        return response()->json([
            'hashcheck' => Hash::check($r->plaintext, $r->hashed)
        ]);
    }

}
