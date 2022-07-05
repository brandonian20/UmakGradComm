<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitorPageController extends Controller
{
    //Home func
    public function home(){
        return view('visitor/home');
    }

    //Home func
    public function programme(){
        return view('visitor/programme');
    }

}
