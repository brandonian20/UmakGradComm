<?php

namespace App\Http\Controllers;

use App\Models\Graduates;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class GraduatesController extends Controller
{
    //Index func
    public function index(){
        return view('cms/graduates', ['title' => 'Graduates']);
    }

    public function check(Request $r){
        try{
            $this->datatable($r);
        } catch(Exception $e){
            return $e;
        }
    }

    public function datatable(Request $r){
        if($r->ajax()){
            
            $data = null;

            if ($r->search['value']){

                $data = Graduates::join("academicyear", "academicyear.acadYrID" , "=", "graduates.acadYrID")
                ->where([
                    ['LastName', '=', $r->search['value']],
                    ['FirstName', '=', $r->search['value']],
                    ['MiddleName', '=', $r->search['value']],
                    ])
                    ->get();
                    
            } else {
                $data = Graduates::join("academicyear", "academicyear.acadYrID" , "=", "graduates.acadYrID")
                ->get();
            }

            return  DataTables::of($data)
                    ->editColumn('LastName', function($row){
                        $data = "{$row['LastName']}, {$row['FirstName']} {$row['MiddleName']}";

                        return $data;
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $data = "";

                        //Edit Button
                        $data .= "<button type='button' data-id='".Crypt::encryptString($row["acadYrID"])."' data-bs-toggle='tooltip' title='edit' class='btn btn-edit'><i class='fa-regular fa-edit'></i></button>";

                        return $data;
                    })
                    ->rawColumns(['action','LastName'])
                    //->rawColumns(['action'])
                    ->make(true);
            
        }
    }

    public function add(Request $r){

        try{

            // if(Graduates::where('year', strip_tags($r["year"]))->exists()){
            //     return response()->json(["success" => false, 'data' => "Record already exists."], 200);
            // }

            // $row = new Graduates;
            // $row->year = strip_tags($r->year);
            // $row->theme = strip_tags($r->theme);
            // $row->save();

            // return response()->json(["success" => true, 'data' => "Record added."], 200);    

            // $x = "";

            // $files = $r->image;
            // foreach($files as $f){
            //     $x .= $f->getClientOriginalName();
            // }


            return response()->json($r->image->hashName(), 200);

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
                    $data = Graduates::where([['acadYrID', '=', $id]])->first();
    
                    return $data;
                case "POST":

                    //Check if it has duplicates
                    if (Graduates::where('year', strip_tags($r["e-year"]))->exists() 
                        && //Check if editing the same record
                        ($id != Graduates::select('acadYrID')->where('year', strip_tags($r["e-year"]))->first()->acadYrID )){
                        return response()->json(["success" => false, 'data' => "Record already exists."], 200);
                    }

                    $data = Graduates::find($id);

                    $data->year = strip_tags($r["e-year"]);
                    $data->theme = strip_tags($r["e-theme"]);
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
