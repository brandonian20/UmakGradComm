<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;
use App\Models\Program;

use Illuminate\Support\Facades\Crypt;

class VisitorPageController extends Controller
{
    //Home func
    public function home(){
        return view('visitor/home');
    }

    public function colleges(){
        $data = College::orderBy('collegeName', 'ASC')->get();

        foreach($data as $row){

            $programs = Program::where('collegeID', '=', $row['collegeID'])->orderBy('programName', 'ASC')->get();

            $row['image'] = ($row['image'] != null ? Crypt::encryptString($row['image']) : null);
            $row['programs'] = $programs;
        }

        //$data = Program::where('collegeID', '=', '4')->get();

        return response()->json(['success' => true, 'data' => $data], 200);
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
