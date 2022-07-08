<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramController extends Controller
{
    //Index func
    public function index(){
        return view('cms/program', ['title' => 'Program']);
    }
}
