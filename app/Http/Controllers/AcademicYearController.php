<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class AcademicYearController extends Controller
{
    //

    public function index(){
        return view('cms/academicYear',  ['title' => 'Academic Year']);
    }

    public function datatable(Request $r){
        if($r->ajax()){
            
            $data = null;

            if ($r->search['value']){
                $data = AcademicYear::where([
                    ['year', '=', $r->search['value']],
                    ])->get();
            } else {
                $data = AcademicYear::get();
            }

            return  DataTables::of($data)
                    ->editColumn('theme', function($row){
                        $data = "{$row['theme']}";

                        return $data;
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $data = "";

                        //Edit Button
                        $data .= "<button type='button' data-id='".Crypt::encryptString($row["acadYrID"])."' data-bs-toggle='tooltip' title='edit' class='btn btn-edit'><i class='fa-regular fa-edit'></i></button>";

                        return $data;
                    })
                    ->rawColumns(['action','theme'])
                    ->make(true);
            
        }
    }

    public function add(Request $r){

        try{

            if(AcademicYear::where('year', strip_tags($r["year"]))->exists()){
                return response()->json(["success" => false, 'data' => "Record already exists."], 200);
            }

            $row = new AcademicYear;
            $row->year = strip_tags($r->year);
            $row->theme = strip_tags($r->theme);
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
                    $data = AcademicYear::where([['acadYrID', '=', $id]])->first();
    
                    return $data;
                case "POST":

                    //Check if it has duplicates
                    if (AcademicYear::where('year', strip_tags($r["e-year"]))->exists() 
                        && //Check if editing the same record
                        ($id != AcademicYear::select('acadYrID')->where('year', strip_tags($r["e-year"]))->first()->acadYrID )){
                        return response()->json(["success" => false, 'data' => "Record already exists."], 200);
                    }

                    $data = AcademicYear::find($id);

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
