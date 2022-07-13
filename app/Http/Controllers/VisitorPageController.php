<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitorPageController extends Controller
{
    //Home func
    public function home(){
        return view('visitor/home');
    }

    // //programme func
    // public function programme(){
    //     return view('visitor/programme');
    // }

    //gallery func
    public function gallery(){
        return view('visitor/gallery');
    }

     //graduates func
     public function graduates_gallery(){
        return view('visitor/graduates-gallery');
    }

     //graduates func
     public function message(){
        return view('visitor/message');
    }
}
