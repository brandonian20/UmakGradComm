<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //Index func
    public function index(){
        return view('visitor/index');
    }
}
