<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class SemesterController extends Controller
{
    //

    public function index(){
        return view('cms/semester',  ['title' => 'Semester']);
    }

    public function datatable(Request $r){
        if($r->ajax()){
            
            $data = null;

            if ($r->search['value']){
                $data = Semester::where([
                    ['semesterName', '=', $r->search['value']],
                    ])->get();
            } else {
                $data = Semester::get();
            }

            return  DataTables::of($data)
                    ->editColumn('theme', function($row){
                        $data = "{$row['semesterName']}";

                        return $data;
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $data = "";

                        //Edit Button
                        $data .= "<button type='button' data-id='".Crypt::encryptString($row["semID"])."' data-bs-toggle='tooltip' title='edit' class='btn btn-edit'><i class='fa-regular fa-edit'></i></button>";

                        return $data;
                    })
                    ->rawColumns(['action','theme'])
                    ->make(true);
            
        }
    }

    public function add(Request $r){

        try{

            if(Semester::where('semesterName', strip_tags($r["semesterName"]))->exists()){
                return response()->json(["success" => false, 'data' => "Record already exists."], 200);
            }

            $row = new Semester;
            $row->semesterName = strip_tags($r->semesterName);
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
                    $data = Semester::where([['semID', '=', $id]])->first();
    
                    return $data;
                case "POST":

                    //Check if it has duplicates
                    if (Semester::where('semesterName', strip_tags($r["e-semesterName"]))->exists() 
                        && //Check if editing the same record
                        ($id != Semester::select('semID')->where('semesterName', strip_tags($r["e-semesterName"]))->first()->semID )){
                        return response()->json(["success" => false, 'data' => "Record already exists."], 200);
                    }

                    $data = Semester::find($id);

                    $data->semesterName = strip_tags($r["e-semesterName"]);
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
