<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;



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

    //func
    public function list(){
        return response()->json([
            'response' => User::all()
        ]);
    }

    //func
    public function login(Request $r){
        
        $validator = Validator::make($r->all(), [
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        //This is another comment
        if ($validator->fails()){
            return response()->json([
                'response' => $validator->errors()
            ]);
        }

        //This is a comment
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
