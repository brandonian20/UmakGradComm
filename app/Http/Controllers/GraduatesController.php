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

            // $data = Graduates::join("academicyear", "academicyear.acadYrID" , "=", "graduates.acadYrID")
            //     ->join("program", "program.programID", '=', 'graduates.programID')
            //     ->join("semester", "semester.semID", '=', 'graduates.semID')
            //     ->where("academicyear.acadYrID", '=', Crypt::decryptString($r->acadYear))
            //     ->get();

            //return response()->json($data, 200);
            return response()->json(Pictures::find($r->imageID), 200);

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
                ->leftJoin("honor", "honor.honorID", '=', 'graduates.honorID')
                ->where("academicyear.acadYrID", '=', Crypt::decryptString($r->acadYear))
                ->orWhere([
                    ['graduates.Lastname', 'LIKE', "%{$r->search['value']}%"],
                    ['graduates.Firstname', 'LIKE', "%{$r->search['value']}%"],
                    ['graduates.Middlename', 'LIKE', "%{$r->search['value']}%"],
                    ['program.programName', 'LIKE', "%{$r->search['value']}%"],
                    ['semester.semesterName', 'LIKE', "%{$r->search['value']}%"],
                    ['honor.honorName', 'LIKE', "{$r->search['value']}"],
                ])
                ->get();
                    
            } else {
                $data = Graduates::join("academicyear", "academicyear.acadYrID" , "=", "graduates.acadYrID")
                ->join("program", "program.programID", '=', 'graduates.programID')
                ->join("semester", "semester.semID", '=', 'graduates.semID')
                ->leftJoin("honor", "honor.honorID", '=', 'graduates.honorID')
                ->where("academicyear.acadYrID", '=', Crypt::decryptString($r->acadYear))
                ->get();
            }

            return  DataTables::of($data)
                    ->editColumn('pictureID', function($row){

                        $data = "";

                        if ($row['pictureID'] != null){
                            $data .= "<img data-bs-toggle='tooltip' title='Toga Picture' src='/pictures/image?id=".Crypt::encryptString($row['pictureID'])."' style='max-height: 53px;' />";
                        } 
                        
                        if ($row['bannerImageID'] != null){
                            $data .= "<img data-bs-toggle='tooltip' title='Slide Deck Picture' src='/pictures/image?id=".Crypt::encryptString($row['bannerImageID'])."' style='max-height: 53px;' />";
                        }

                        return "<div class='d-flex justify-content-between'>{$data}</div>";
                    })
                    ->editColumn('Lastname', function($row){
                        $data = "{$row['Lastname']}, {$row['Firstname']} {$row['Middlename']} ";

                        if ($row['honorID'] != null){
                            $data .= " <span data-bs-toggle='tooltip' title='{$row['honorName']}'><i class='fa-solid fa-award'></i></span>";
                        }

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
                        $data .= "<button type='button' data-id='".Crypt::encryptString($row["studentID"])."' data-bs-toggle='tooltip' title='edit' class='btn btn-edit'><i class='fa-regular fa-edit'></i></button>";

                        return $data;
                    })
                    ->rawColumns(['action','pictureID', 'Lastname'])
                    //->rawColumns(['action'])
                    ->make(true);
            
        }
    }

    public function add(Request $r){

        try{

            //Check if has duplicate name
            if(Graduates::where([
                ['Lastname', '=', "{$r->lastname}"],
                ['Firstname', '=', "{$r->firstname}"],
                ['Middlename', '=', "{$r->middlename}"],
            ])->exists()){
                return response()->json(["success" => false, 'data' => "Record already exists."], 200);
            }

            $allowedExts = array("jpg", "png", "jpeg");

            //Check if it has image file, and if extension is on allowed extensions
            if ($r->hasFile('image') && !in_array($r->image->extension(), $allowedExts) ){
                return response()->json(["success" => false, 'data' => "File type not allowed."], 200);
            }

            //Check if it has banner file, and if extension is on allowed extensions
            if ($r->hasFile('banner') && !in_array($r->banner->extension(), $allowedExts) ){
                return response()->json(["success" => false, 'data' => "File type not allowed."], 200);
            }

            $img = null;
            if ($r->hasFile('image')){
                $img = new Pictures();
                $img->pictureFile = base64_encode(file_get_contents($r->image->getRealPath()));
                $img->fileFormat = $r->image->extension();
                $img->save();
            }

            $banner = null;
            if ($r->hasFile('banner')){
                $banner = new Pictures();
                $banner->pictureFile = base64_encode(file_get_contents($r->banner->getRealPath()));
                $banner->fileFormat = $r->banner->extension();
                $banner->save();
            }

            $row = new Graduates();
            $row->Lastname = strip_tags($r->lastname);
            $row->Firstname = strip_tags($r->firstname);
            $row->Middlename = strip_tags($r->middlename);
            $row->pictureID = ($img != null ? $img->pictureID : null);
            $row->bannerImageID = ($banner != null ? $banner->pictureID : null);
            $row->acadYrID = Crypt::decryptString($r->acadYear);
            $row->semID = Crypt::decryptString($r->semester);
            $row->honorID = (in_array($r->honor, array(1, 2, 3)) ? $r->honor : null);
            $row->programID = Crypt::decryptString($r->program);
            $row->updatedBy = Session::get("userData.id");
            $row->updatedAt = \Carbon\Carbon::now();
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
                    $data = Graduates::where([['studentID', '=', $id]])->first();
                    
                    if ($data->pictureID != null)
                        $data["image"] = Crypt::encryptString($data->pictureID);

                    if ($data->bannerImageID != null)
                    $data["banner"] = Crypt::encryptString($data->bannerImageID);

                    return $data;

                case "POST":

                    //Check if has duplicate name
                    if(Graduates::where([
                        ['Lastname', '=', "{$r['e-lastname']}"],
                        ['Firstname', '=', "{$r['e-firstname']}"],
                        ['Middlename', '=', "{$r['e-middlename']}"],
                    ])->exists()
                    && //Check if editing the same record
                    $id != Graduates::select('studentID')->where([
                        ['Lastname', '=', "{$r['e-lastname']}"],
                        ['Firstname', '=', "{$r['e-firstname']}"],
                        ['Middlename', '=', "{$r['e-middlename']}"],
                    ])->first()->studentID
                    ){
                        return response()->json(["success" => false, 'data' => "Record already exists."], 200);
                    }

                    $allowedExts = array("jpg", "png", "jpeg");

                    //Check if it has image file, and if extension is on allowed extensions
                    if ($r->hasFile('image') && !in_array($r['image']->extension(), $allowedExts) ){
                        return response()->json(["success" => false, 'data' => "File type not allowed."], 200);
                    }

                    //Check if it has banner file, and if extension is on allowed extensions
                    if ($r->hasFile('banner') && !in_array($r['banner']->extension(), $allowedExts) ){
                        return response()->json(["success" => false, 'data' => "File type not allowed."], 200);
                    }

                    $img = null;
                    if ($r->hasFile('image')){
                        if (Pictures::find($r->imageID) != null){
                            $img = Pictures::find($r->imageID);
                            $img->pictureFile = base64_encode(file_get_contents($r->image->getRealPath()));
                            $img->fileFormat = $r->image->extension();
                            $img->update();
                        } else {
                            $img = new Pictures();
                            $img->pictureFile = base64_encode(file_get_contents($r->image->getRealPath()));
                            $img->fileFormat = $r->image->extension();
                            $img->save();
                        }
                    }

                    $banner = null;
                    if ($r->hasFile('banner')){
                        if (Pictures::find($r->bannerID) != null){
                            $banner = Pictures::find($r->bannerID);
                            $banner->pictureFile = base64_encode(file_get_contents($r->banner->getRealPath()));
                            $banner->fileFormat = $r->banner->extension();
                            $banner->update();
                        } else {
                            $banner = new Pictures();
                            $banner->pictureFile = base64_encode(file_get_contents($r->banner->getRealPath()));
                            $banner->fileFormat = $r->banner->extension();
                            $banner->save();
                        }
                    }

                    $row = Graduates::find($id);

                    
                    $row->Lastname = strip_tags($r['e-lastname']);
                    $row->Firstname = strip_tags($r['e-firstname']);
                    $row->Middlename = strip_tags($r['e-middlename']);
                    $row->semID = Crypt::decryptString($r['e-semester']);
                    $row->honorID = (in_array($r['e-honor'], array(1, 2, 3)) ? $r['e-honor'] : null);
                    $row->programID = Crypt::decryptString($r['e-program']);
                    $row->pictureID = ($img != null ? $img->pictureID : ($r['imageID'] != 'null' ? $r['imageID'] : NULL));
                    $row->bannerImageID = ($banner != null ? $banner->pictureID : ($r['bannerID'] != 'null' ? $r['bannerID'] : NULL));
                    
                    $row->updatedBy = Session::get("userData.id");
                    $row->updatedAt = \Carbon\Carbon::now();
                    $row->update();
    
                    return response()->json(["success" => true, 'data' => "Record updated."], 200);
                default:
                    return response()->json('', 405);
            }
        } catch(Exception $e){
            return $e;
        }
    }
}
