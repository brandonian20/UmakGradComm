<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraduatesController extends Controller
{
    //Index func
    public function index(){
        return view('cms/graduates', ['title' => 'Graduates']);
    }
}