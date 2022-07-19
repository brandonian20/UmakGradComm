<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\College;
use App\Models\Program;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class Select2Controller extends Controller
{
    public function academicYear(Request $r){
        if($r->ajax()){
            $data = AcademicYear::orderBy('acadYrID', 'DESC')->get();

            $select = array();

            foreach ($data as $row){
                array_push($select, 
                    [   
                        Crypt::encryptString($row['acadYrID']),
                        $row['acadYrID'],
                        $row['year'], 
                        $row['theme'],
                    ]);
            }

            return response()->json(["success" => true, 'data' => $select], 200);
        }
    }

    public function semester(Request $r){
        if($r->ajax()){
            $data = Semester::get();

            $select = array();

            foreach ($data as $row){
                array_push($select, 
                    [   
                        Crypt::encryptString($row['semID']),
                        $row['semID'],
                        $row['desc'], 
                    ]);
            }

            return response()->json(["success" => true, 'data' => $select], 200);
        }
    }

    public function college(Request $r){
        if($r->ajax()){
            $data = College::get();

            $select = array();

            foreach ($data as $row){
                array_push($select, 
                    [   
                        Crypt::encryptString($row['collegeID']),
                        $row['collegeID'],
                        "{$row['shortname']} {$row['collegeName']}", 
                    ]);
            }

            return response()->json(["success" => true, 'data' => $select], 200);
        }
    }

    public function program(Request $r){
        if($r->ajax()){
            $data = Program::get();

            $select = array();

            foreach ($data as $row){
                array_push($select, 
                    [   
                        Crypt::encryptString($row['programID']),
                        $row['programID'],
                        $row['programName'], 
                    ]);
            }

            return response()->json(["success" => true, 'data' => $select], 200);
        }
    }

}
