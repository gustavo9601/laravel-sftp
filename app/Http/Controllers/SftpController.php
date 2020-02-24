<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SftpController extends Controller
{
    public function uploadSftp()
    {


        //firt install
        //composer require league/flysystem-sftp

        $existe = \Storage::disk('public')->exists('files/SN244266.csv');
        if($existe){
            $uploadFile = \Storage::disk('sftp')->put('SN244266.csv', \Storage::disk('public')->get('files/SN244266.csv'));
            if($uploadFile){

                $archivo_subio = \Storage::disk('sftp')->exists('SN244266.csv');
                if($archivo_subio){
                    return response()->json(['status' => 'ok', 'message' => 'The file upload success'], 200);
                }
            }
        }


    }
}
