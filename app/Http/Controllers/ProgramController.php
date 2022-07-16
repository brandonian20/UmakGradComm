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
            $row->programName = strip_tags($r->programName);
            $row->collegeID = (int)strip_tags($r->collegeID);
            $row->save();

            return response()->json(["success" => true, 'data' => "Record added."], 200);
        } catch(Exception $e){
            return $e;
        }

    }

}
