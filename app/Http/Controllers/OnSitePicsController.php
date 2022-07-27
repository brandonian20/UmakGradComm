<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OnSitePics;
use App\Models\Pictures;
use Exception;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class OnSitePicsController extends Controller
{
    //Index func
    public function index(){
        return view('cms/onsitepics', ['title' => 'On Site Pictures']);
    }
    
    public function datatable(Request $r){
        if($r->ajax()){
            
            $data = null;

            if ($r->search['value']){

                $data = OnSitePics::join("academicyear", "academicyear.acadYrID" , "=", "OnSitePics.acadYrID")
                ->where([
                    ["academicyear.acadYrID", '=', Crypt::decryptString($r->acadYear)],
                    ['OnSitePics.title', 'LIKE', "%{$r->search['value']}%"],
                    ['OnSitePics.subtitle', 'LIKE', "%{$r->search['value']}%"],
                ])
                ->get();
                    
            } else {
                $data = OnSitePics::join("academicyear", "academicyear.acadYrID" , "=", "OnSitePics.acadYrID")
                ->where("academicyear.acadYrID", '=', Crypt::decryptString($r->acadYear))
                ->get();
            }

            return  DataTables::of($data)
                    ->editColumn('image', function($row){

                        $data = "";

                        if ($row['image'] != null){
                            $data .= "<img data-bs-toggle='tooltip' title='Image' src='/pictures/image?id=".Crypt::encryptString($row['image'])."' style='max-height: 53px;' />";
                        }

                        return "<div class='d-flex justify-content-between'>{$data}</div>";
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $data = "";

                        //Edit Button
                        $data .= "<button type='button' data-id='".Crypt::encryptString($row["siteID"])."' data-bs-toggle='tooltip' title='edit' class='btn btn-edit'><i class='fa-regular fa-edit'></i></button>";

                        return $data;
                    })
                    ->rawColumns(['action','image'])
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

            $img = null;
            if ($r->hasFile('image')){
                $img = new Pictures();
                $img->pictureFile = base64_encode(file_get_contents($r->image->getRealPath()));
                $img->fileFormat = $r->image->extension();
                $img->save();
            }

            $row = new OnSitePics();
            $row->title = strip_tags($r->title);
            $row->subtitle = strip_tags($r->subtitle);
            $row->image = ($img != null ? $img->pictureID : null);
            $row->acadYrID = Crypt::decryptString($r->acadYear);
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
                    $data = onsitepics::where([['siteID', '=', $id]])->first();
                    

                    return $data;

                case "POST":

                    //Check if has duplicate name

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

                    $row = onsitepics::find($id);

                    
                    $row->title = strip_tags($r['e-title']);
                    $row->subtitle = strip_tags($r['e-subtitle']);
                    $row->image = ($img != null ? $img->pictureID : ($r['imageID'] != 'null' ? $r['imageID'] : NULL));
                    
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
