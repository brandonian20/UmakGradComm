<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Pictures;
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
                $searchVal = $r->search['value'];

                $data = College::where('collegeName', 'LIKE', "%{$searchVal}%")
                ->orWhere('shortname', 'LIKE', "%{$searchVal}%")
                ->orderBy('collegeName')
                ->get();
            } else {
                $data = College::orderBy('collegeName')->get();
            }

            return  DataTables::of($data)
                    ->editColumn('collegeName', function($row){
                        $data = "<img src='/pictures/image?id=".Crypt::encryptString($row->image)."' style='max-height: 53px;'> {$row['collegeName']} " . ($row['shortname'] != null ? "({$row['shortname']})" : "");

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

            $allowedExts = array("jpg", "png", "jpeg");

            //Check if it has image file, and if extension is on allowed extensions
            if ($r->hasFile('image') && !in_array($r->image->extension(), $allowedExts) ){
                return response()->json(["success" => false, 'data' => "File type not allowed."], 200);
            }

            $img = null;
            if ($r->hasFile('image')){
                $img = new Pictures();
                $img->pictureFile = base64_encode(file_get_contents($r->image->getRealPath()));
                $img->fileFormat = $r->image->extension();
                $img->save();
            }

            $row = new College;
            $row->collegeName = strtoupper(strip_tags($r->collegeName));
            $row->shortname = strtoupper(strip_tags($r->shortname));
            $row->image = ($img != null ? $img->pictureID : null);
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
                    $data = College::where([['collegeID', '=', $id]])->first();
    
                    return $data;
                case "POST":

                    //Check if it has duplicates
                    if (College::where('collegeName', strip_tags($r["e-collegeName"]))->exists() 
                        && //Check if editing the same record
                        $id != College::select('collegeID')->where('collegeName', strip_tags($r["e-collegeName"]))->first()->collegeID 
                        // &&
                        // (College::where('shortname', strip_tags($r["e-shortname"]))->exists()) 
                        ){
                        return response()->json(["success" => false, 'data' => "Record already exists."], 200);
                    }

                    $allowedExts = array("jpg", "png", "jpeg");

                    //Check if it has image file, and if extension is on allowed extensions
                    if ($r->hasFile('image') && !in_array($r['image']->extension(), $allowedExts) ){
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

                    $data = College::find($id);

                    $data->collegeName = strtoupper(strip_tags($r["e-collegeName"]));
                    $data->shortname = strtoupper(strip_tags($r["e-shortname"]));
                    $data->image = ($img != null ? $img->pictureID : ($r['imageID'] != 'null' ? $r['imageID'] : NULL));
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
