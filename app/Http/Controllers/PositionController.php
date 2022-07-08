<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PositionController extends Controller
{
    //Index func
    public function index(){
        return view('cms/position', ['title' => 'Position']);
    }
}
