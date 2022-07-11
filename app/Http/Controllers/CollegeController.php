<?php

namespace App\Http\Controllers;

use App\Models\College;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class CollegeController extends Controller
{
    //Index func
    public function index(){
        return view('cms/college', ['title' => 'College']);
    }

    public function datatable(Request $r){
        if($r->ajax()){
            
            $data = null;

            if ($r->search['value']){
                $data = College::where([
                    ['collegeName', '=', $r->search['value']],
                    ['shortname', '=', $r->search['value']],
                    ])->get();
            } else {
                $data = College::get();
            }

            return  DataTables::of($data)
                    ->editColumn('collegeName', function($row){
                        $data = "{$row['collegeName']} " . ($row['shortname'] != null ? "({$row['shortname']})" : "");

                        return $data;
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $data = "";

                        //Edit Button
                        $data .= "<button type='button' data-id='".Crypt::encryptString($row["collegeID"])."' data-bs-toggle='tooltip' title='edit' class='btn btn-edit'><i class='fa-regular fa-edit'></i></button>";

                        return $data;
                    })
                    ->rawColumns(['action','collegeName'])
                    ->make(true);
            
        }
    }

    public function add(Request $r){

        try{

            if(College::where('collegeName', strip_tags($r["collegeName"]))->exists()){
                return response()->json(["success" => false, 'data' => "Record already exists."], 200);
            }

            $row = new College;
            $row->collegeName = strip_tags($r->collegeName);
            $row->shortname = strip_tags($r->shortname);
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
                    $data = College::where([['collegeID', '=', $id]])->first();
    
                    return $data;
                case "POST":

                    //Check if it has duplicates
                    if (College::where('collegeName', strip_tags($r["e-collegeName"]))->exists() 
                        && //Check if editing the same record
                        ($id != College::select('collegeID')->where('collegeName', strip_tags($r["e-collegeName"]))->first()->collegeID )){
                        return response()->json(["success" => false, 'data' => "Record already exists."], 200);
                    }

                    $data = College::find($id);

                    $data->collegeName = strip_tags($r["e-collegeName"]);
                    $data->shortname = strip_tags($r["e-shortname"]);
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
