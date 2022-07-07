<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //Index func
    public function index(){
        return view('cms/dashboard', ['title' => 'Dashboard | UMak Commencement']);
    }
    
}
