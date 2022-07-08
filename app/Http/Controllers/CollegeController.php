<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollegeController extends Controller
{
    //Index func
    public function index(){
        return view('cms/college', ['title' => 'College']);
    }
}
