<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyController extends Controller
{
    //Index func
    public function index(){
        return view('cms/faculty', ['title' => 'Faculty']);
    }
}
