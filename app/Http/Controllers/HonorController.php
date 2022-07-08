<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HonorController extends Controller
{
    //Index func
    public function index(){
        return view('cms/honor', ['title' => 'Honor']);
    }
}
