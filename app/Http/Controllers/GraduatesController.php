<?php

namespace App\Http\Controllers;

use App\Models\Graduates;
use App\Models\Picture;
use App\Models\Pictures;
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

           $data = Pictures::where('pictureID', '=', '1')
                ->first();

            return response(base64_decode($data->pictureFile))->header("Content-type","image/{$data->fileFormat}");

        } catch(Exception $e){
            return $e;
        }
    }

    public function datatable(Request $r){
        if($r->ajax()){
            
            $data = null;

            if ($r->search['value']){

                $data = Graduates::join("academicyear", "academicyear.acadYrID" , "=", "graduates.acadYrID")
                ->join("program", "program.programID", '=', 'graduates.programID')
                ->join("semester", "semester.semID", '=', 'graduates.semID')
                ->where([
                    ['LastName', '=', $r->search['value']],
                    ['FirstName', '=', $r->search['value']],
                    ['MiddleName', '=', $r->search['value']],
                    ])
                    ->get();
                    
            } else {
                $data = Graduates::join("academicyear", "academicyear.acadYrID" , "=", "graduates.acadYrID")
                ->join("program", "program.programID", '=', 'graduates.programID')
                ->join("semester", "semester.semID", '=', 'graduates.semID')
                ->get();
            }

            return  DataTables::of($data)
                    // ->editColumn('pictureID', function($row){
                    //     $data = "<img class='img-fluid' src='/pictures/image?id=".Crypt::encryptString($row['pictureID'])."' />";

                    //     return $data;
                    // })
                    // ->editColumn('bannerID', function($row){
                    //     $data = "<img src='/pictures/banner?id=".Crypt::encryptString($row['bannerID'])."' />";

                    //     return $data;
                    // })
                    
                    ->editColumn('Lastname', function($row){
                        $data = "{$row['Lastname']}, {$row['Firstname']} {$row['Middlename']}";

                        return $data;
                    })
                    ->editColumn('Firstname', function($row){
                        $data = "{$row['programName']}";

                        return $data;
                    })
                    ->editColumn('Middlename', function($row){
                        $data = "{$row['semesterName']}";

                        return $data;
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $data = "";

                        //Edit Button
                        $data .= "<button type='button' data-id='".Crypt::encryptString($row["acadYrID"])."' data-bs-toggle='tooltip' title='edit' class='btn btn-edit'><i class='fa-regular fa-edit'></i></button>";

                        return $data;
                    })
                    ->rawColumns(['action','pictureID', 'bannerID', 'Lastname'])
                    //->rawColumns(['action'])
                    ->make(true);
            
        }
    }

    public function add(Request $r){

        try{


            $allowedExts = array("jpg", "png", "jpeg");

            //Check if it has image file, and if extension is on allowed extensions
            if ($r->hasFile('image') && !in_array($r->image->extension(), $allowedExts) ){
                return response()->json(["success" => false, 'data' => "File type not allowed."], 200);
            }

            //Check if it has banner file, and if extension is on allowed extensions
            if ($r->hasFile('banner') && !in_array($r->banner->extension(), $allowedExts) ){
                return response()->json(["success" => false, 'data' => "File type not allowed."], 200);
            }

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



            $img = new Pictures();
            $img->pictureFile = base64_encode(file_get_contents($r->image->getRealPath()));
            $img->fileFormat = $r->image->extension();
            $img->save();

            $row = new Graduates();
            $row->Lastname = strip_tags($r->lastname);
            $row->Firstname = strip_tags($r->firstname);
            $row->Middlename = strip_tags($r->middlename);
            $row->pictureID = $img->pictureID;
            $row->acadYrID = Crypt::decryptString($r->acadYear);
            $row->semID = Crypt::decryptString($r->semester);
            $row->honorID = 1;
            $row->programID = Crypt::decryptString($r->program);
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
