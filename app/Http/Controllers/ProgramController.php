<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\College;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class ProgramController extends Controller
{

    //Index func
    public function index(){
        $collegeList = College::orderBy('collegeName')->get(['collegeID', 'collegeName']);

        for ($x = 0; $x < count($collegeList); $x++){
            $collegeList[$x]->hashCollegeID = Crypt::encryptString($collegeList[$x]->collegeID);
        }

        return view('cms/program', ['title' => 'Programs', 'collegeList' => $collegeList]);
    }

    public function datatable(Request $r){
        if($r->ajax()){
            
            $data = null;

            if ($r->search['value']){
                $searchVal = $r->search['value'];

                $data = Program::join('college', 'college.collegeID', '=', 'program.collegeID')
                ->where('programName', 'LIKE', "%{$searchVal}%")
                ->orWhere('shortname', 'LIKE', "%{$searchVal}%")
                ->get();
            } else {
                $data = Program::join('college', 'college.collegeID', '=', 'program.collegeID')
                ->orderBy('shortName')->get();
            }

            return  DataTables::of($data)
                    ->addColumn('programName', function($row){
                        return "{$row['programName']}";
                    })
                    ->addColumn('shortname', function($row){
                        return "{$row['shortname']}";
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $data = "";

                        //Edit Button
                        $data .= "<button type='button' data-id='".Crypt::encryptString($row["programID"])."' data-bs-toggle='tooltip' title='edit' class='btn btn-edit'><i class='fa-regular fa-edit'></i></button>";

                        return $data;
                    })
                    ->rawColumns(['action', 'shortname', 'programName'])
                    ->make(true);
            
        }
    }

    public function add(Request $r){

        try{

            if(Program::where('programName', strip_tags($r["programName"]))->exists()){
                return response()->json(["success" => false, 'data' => "Record already exists."], 200);
            }

            $row = new Program;
            $row->programName = strtoupper(strip_tags($r->programName));
            $Id = Crypt::decryptString(strip_tags($r->collegeID));
            $row->collegeID = (int)$Id;
            $row->save();

            return response()->json(["success" => true, 'data' => "Record added."], 200);
        } catch(Exception $e){
            return $e;
        }

    }

    public function edit(Request $r){

        $id = null;

        try{
            $id = Crypt::decryptString($r->id);
        } catch(Exception $e){
            return response()->json('', 400);
            //return $e;
        }

        try{
            switch($r->method()){
                case "GET":
                    $data = Program::join('college', 'college.collegeID', '=', 'program.collegeID')
                    ->where([['programID', '=', $id]])->first();
    
                    return $data;
                case "POST":

                    //Check if it has duplicates
                    if (Program::where('programName', strip_tags($r["e-programName"]))->exists() 
                        && //Check if editing the same record
                        ($id == Program::select('programID')->where('programName', strip_tags($r["e-programName"]))->first()->programID )
                        && //Check if belong to the same college 
                        ((int)Crypt::decryptString(strip_tags($r["e-collegeName"])) == Program::find($id)->collegeID)){
                        return response()->json(["success" => false, 'data' => "Record already exists."], 200);
                    }

                    $data = Program::find($id);

                    $data->programName = strtoupper(strip_tags($r["e-programName"]));
                    $data->collegeID = (int)Crypt::decryptString(strip_tags($r["e-collegeName"]));
                    $data->updatedBy = Session::get("userData.id");
                    $data->updatedAt = \Carbon\Carbon::now();

                    $data->update();
    
                    return response()->json(["success" => true, 'data' => "Record updated."], 200);
                default:
                    return response()->json('', 405);
            }
        } catch(Exception $e){
            return $e;
        }
    }


}
