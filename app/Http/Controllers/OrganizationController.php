<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class OrganizationController extends Controller
{
    //Index func
    public function index(){
        return view('cms/organization', ['title' => 'Organizations']);
    }

    public function datatable(Request $r){
        if($r->ajax()){
            
            $data = null;

            if ($r->search['value']){
                $searchVal = $r->search['value'];

                $data = Organization::where('organizationName', 'LIKE', "%{$searchVal}%")
                ->get();
            } else {
                $data = Organization::orderBy('organizationName')->get();
            }

            return  DataTables::of($data)
                ->addColumn('organizationName', function($row){
                    return "{$row['organizationName']}";
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $data = "";

                    //Edit Button
                    $data .= "<button type='button' data-id='".Crypt::encryptString($row["orgID"])."' data-bs-toggle='tooltip' title='edit' class='btn btn-edit'><i class='fa-regular fa-edit'></i></button>";

                    return $data;
                })
                ->rawColumns(['action', 'organizationName'])
                ->make(true);
            
        }
    }

    public function add(Request $r){

        try{

            if(Organization::where('organizationName', strip_tags($r["organizationName"]))->exists()){
                return response()->json(["success" => false, 'data' => "Record already exists."], 200);
            }

            $row = new Organization;
            $row->organizationName = strtoupper(strip_tags($r->organizationName));
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
                    $data = Organization::where([['orgID', '=', $id]])->first();
    
                    return $data;
                case "POST":

                    //Check if it has duplicates
                    if (Organization::where('organizationName', strip_tags($r["e-organizationName"]))->exists() 
                        && //Check if editing the same record
                        ($id == Organization::select('orgID')->where('organizationName', strip_tags($r["e-organizationName"]))->first()->orgID )){
                        return response()->json(["success" => false, 'data' => "Record already exists."], 200);
                    }

                    $data = Organization::find($id);

                    $data->organizationName = strtoupper(strip_tags($r["e-organizationName"]));
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
