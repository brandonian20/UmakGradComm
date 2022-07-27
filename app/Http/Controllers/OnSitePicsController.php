<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnSitePicsController extends Controller
{
    //Index func
    public function index(){
        return view('cms/onsitepics', ['title' => 'On Site Pictures']);
    }
}
