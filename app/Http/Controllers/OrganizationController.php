<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    //Index func
    public function index(){
        return view('cms/organization', ['title' => 'Organization']);
    }
}
