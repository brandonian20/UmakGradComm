<?php

namespace App\Http\Controllers;

use App\Models\Pictures;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PicturesController extends Controller
{
    
    public function image(Request $r){

        $id = null;

        try{
            $id = Crypt::decryptString($r->id);
        } catch(Exception $e){
            return response()->json('Invalid ID', 400);
            //return $e;
        }

        $data = Pictures::where('pictureID', '=', $id)
        ->first();

        return response(base64_decode($data->pictureFile))->header("Content-type","image/{$data->fileFormat}");
    }

}
