<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;


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
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = "";

                        //Edit Button
                        $btn .= "<button type='button' data-id='".Crypt::encryptString($row["acadYrID"])."' data-bs-toggle='tooltip' title='edit' class='btn btn-edit'><i class='fa-regular fa-edit'></i></button>";

                        return $btn;
                    })
                    ->make(true);
            
        }
    }

}
