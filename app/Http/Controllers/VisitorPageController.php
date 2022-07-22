<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;
use App\Models\AcademicYear;
use App\Models\Program;
use App\Models\Graduates;
use App\Models\Semester;

use Illuminate\Support\Facades\Crypt;

class VisitorPageController extends Controller
{
    //Home func
    public function home(){
        
        $data = College::orderBy('collegeName', 'ASC')->get();

        foreach($data as $row){

            $programs = Program::where('collegeID', '=', $row['collegeID'])->orderBy('programName', 'ASC')->get();

            $row['image'] = ($row['image'] != null ? Crypt::encryptString($row['image']) : null);
            $row['programs'] = $programs;
        }

        return view('visitor/home', ["data" => $data]);
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
    public function graduates_gallery_dev($yr, $college){

        //Check if College and AcadYear Exists on Database
        if (!College::where("shortname", "=", "{$college}")->exists() || !AcademicYear::where("year", "=", "{$yr}")->exists()){
            return redirect("/");
        }

        $data = null;

        $college = College::where("shortname", "=", "{$college}")->first();

        $data["collegeName"] = $college->collegeName;
        $data["insignia"] = Crypt::encryptString($college->image);

        $programs = Program::where("collegeID", "=", "{$college->collegeID}")->orderBy("programName", "ASC")->get();

        //Initialize Blank array to be pushed on the next loop segment
        $data["program"] = [];

        //O(n) where n = length of programs array
        foreach($programs as $prog){
            
            $semester = Semester::orderBy("semesterName", "ASC")->get();
            
            //Initialize blank row
            $row = [];

            //O(n) where n = length of semester array
            foreach($semester as $sem){
                
                $graduates = Graduates::leftJoin('honor', 'honor.honorID', '=', 'graduates.honorID')
                                        ->where([ ["semID", "=", $sem->semID],
                                            ["programID", "=", $prog->programID],
                                        ])->orderBy("Lastname", "ASC")->get();
                $graduate = [];

                //O(n) where n = length of graduates array
                foreach($graduates as $grad){
                    array_push($graduate, ["name" => "{$grad["Lastname"]}, {$grad["Firstname"]} " . $grad["Middlename"][0] . ".", "image" => ($grad->pictureID == null ? null : Crypt::encryptString($grad->pictureID)), "banner" => ($grad->bannerImageID == null ? null : Crypt::encryptString($grad->bannerImageID)), 'honor' => $grad->honorName ]);    
                }

                if ($graduate != null)
                    array_push($row, ["name" => $sem['semesterName'], "graduates" => $graduate]);
            }
            
            if ($row != null)
                array_push($data["program"], ["name" => $prog->programName, "semester" => $row]);
        }

        // return response()->json($data, 200);
        return view('visitor/graduates-gallery-dev', ["data" => $data]);
    }

     //graduates func
     public function message(){
        return view('visitor/message');
    }
}
