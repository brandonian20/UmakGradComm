<?php

namespace App\Http\Controllers;

use App\Models\Honor;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class HonorController extends Controller
{
    //Index func
    public function index(){
        return view('cms/honor', ['title' => 'Honor']);
    }

    public function datatable(Request $r){
        if($r->ajax()){
            
            $data = null;

            if ($r->search['value']){
                $data = Honor::where([
                    ['honorName', '=', $r->search['value']],
                    ])->get();
            } else {
                $data = Honor::get();
            }

            return  DataTables::of($data)
                    ->editColumn('honorName', function($row){
                        $data = "{$row['honorName']}";

                        return $data;
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $data = "";

                        //Edit Button
                        $data .= "<button type='button' data-id='".Crypt::encryptString($row["honorID"])."' data-bs-toggle='tooltip' title='edit' class='btn btn-edit'><i class='fa-regular fa-edit'></i></button>";

                        return $data;
                    })
                    ->rawColumns(['action','honorName'])
                    ->make(true);
            
        }
    }

    public function add(Request $r){

        try{

            if(Honor::where('honorName', strip_tags($r["honorName"]))->exists()){
                return response()->json(["success" => false, 'data' => "Record already exists."], 200);
            }

            $row = new Honor;
            $row->honorName = strip_tags($r->honorName);
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
                    $data = Honor::where([['honorID', '=', $id]])->first();
    
                    return $data;
                case "POST":

                    //Check if it has duplicates
                    if (Honor::where('honorName', strip_tags($r["e-honorName"]))->exists() 
                        && //Check if editing the same record
                        ($id != Honor::select('honorID')->where('honorName', strip_tags($r["e-honorName"]))->first()->honorID )){
                        return response()->json(["success" => false, 'data' => "Record already exists."], 200);
                    }

                    $data = Honor::find($id);

                    $data->honorName = strip_tags($r["e-honorName"]);
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
