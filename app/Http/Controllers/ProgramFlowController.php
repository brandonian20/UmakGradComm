<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramFlowController extends Controller
{
    //Index func
    public function index(){
        return view('programflow/index');
    }
}
