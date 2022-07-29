<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;
use App\Models\AcademicYear;
use App\Models\Program;
use App\Models\Graduates;
use App\Models\Semester;
use App\Models\Messages;
use App\Models\OnSitePics;

use Illuminate\Support\Facades\Crypt;

class VisitorPageController extends Controller
{

    //Home func
    public function home()
    {
        //return response()->json($this->dataMessages(), 200);
        return view('visitor/home', ["colleges" => $this->dataColleges(), "messages" => $this->dataMessages(), "onsitepics" => $this->dataOnSitePics(6)]);
    }

    //gallery func
    public function gallery()
    {
        return view('visitor/gallery', ["colleges" => $this->dataColleges()]);
    }

    //gallery func
    public function gallery_dev($yr)
    {

        //Check if College and AcadYear Exists on Database
        if (!AcademicYear::where("year", "=", "{$yr}")->exists()) {
            return redirect("/");
        }

        return view('visitor/gallery-dev', ["colleges" => $this->dataColleges(), "onsitepics" => $this->dataOnSitePics()]);
    }

    //graduates func
    public function graduates_gallery()
    {
        return view('visitor/graduates-gallery', ["colleges" => $this->dataColleges()]);
    }

    //graduates func
    public function graduates_gallery_dev($yr, $college)
    {

        //Check if College and AcadYear Exists on Database
        if (!College::where("shortname", "=", "{$college}")->exists() || !AcademicYear::where("year", "=", "{$yr}")->exists()) {
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
        foreach ($programs as $prog) {

            $semester = Semester::orderBy("semesterName", "ASC")->get();

            //Initialize blank row
            $row = [];

            //O(n) where n = length of semester array
            foreach ($semester as $sem) {

                $graduates = Graduates::leftJoin('honor', 'honor.honorID', '=', 'graduates.honorID')
                    ->where([
                        ["semID", "=", $sem->semID],
                        ["programID", "=", $prog->programID],
                    ])->orderBy("Lastname", "ASC")->get();
                $graduate = [];

                //O(n) where n = length of graduates array
                foreach ($graduates as $grad) {
                    array_push($graduate, ["lname" => "{$grad["Lastname"]},", "fname" => "{$grad["Firstname"]} " . (strlen($grad["Middlename"]) > 0 ? substr($grad["Middlename"], 0, 1) . "." : ""), "image" => ($grad->pictureID == null ? null : Crypt::encryptString($grad->pictureID)), "banner" => ($grad->bannerImageID == null ? null : Crypt::encryptString($grad->bannerImageID)), 'honor' => $grad->honorName]);
                }

                if ($graduate != null)
                    array_push($row, ["name" => $sem['semesterName'], "graduates" => $graduate]);
            }

            if ($row != null)
                array_push($data["program"], ["name" => $prog->programName, "semester" => $row]);
        }

        // return response()->json($data, 200);
        return view('visitor/graduates-gallery-dev', ["data" => $data, "colleges" => $this->dataColleges()]);
    }

    //message func
    public function message()
    {
        return view('visitor/message', ["colleges" => $this->dataColleges()]);
    }

    //message func
    public function message_dev($yr, $name)
    {
        //Check if College and AcadYear Exists on Database
        if (!AcademicYear::where("year", "=", "{$yr}")->exists() || !Messages::where("name", "=", "{$name}")->exists()) {
            return redirect("/");
        }

        $data = Messages::where("name", "=", "{$name}")->first();
        
        $data['image'] = Crypt::encryptString($data['image']);
        
        return view('visitor/message-dev', ["data" => $data, "colleges" => $this->dataColleges()]);
    }

    public function dataColleges()
    {

        $data = College::orderBy('collegeName', 'ASC')->get();

        foreach ($data as $row) {

            $programs = Program::where('collegeID', '=', $row['collegeID'])->orderBy('programName', 'ASC')->get();

            $row['image'] = ($row['image'] != null ? Crypt::encryptString($row['image']) : null);
            $row['programs'] = $programs;
        }

        return $data;
    }

    public function dataMessages()
    {

        $data = Messages::get();

        foreach ($data as $row) {
            $row['image'] = ($row['image'] != null ? Crypt::encryptString($row['image']) : null);
        }

        return $data;
    }

    public function dataOnSitePics($limit = null)
    {

        $data = null;

        if ($limit != null){
            $data = OnSitePics::take($limit)->get();
        } else {
            $data = OnSitePics::get();
        }


        foreach ($data as $row) {
            $row['image'] = ($row['image'] != null ? Crypt::encryptString($row['image']) : null);
        }

        return $data;
    }

}
