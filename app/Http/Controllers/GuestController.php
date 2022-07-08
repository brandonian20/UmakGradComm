<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    //Index func
    public function index(){
        return view('cms/guest', ['title' => 'Guest']);
    }
}
