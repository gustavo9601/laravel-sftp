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

        $existe = \Storage::disk('public')->exists('files_upload/SN244266.csv');

        if($existe){
            $date = date('dmYHIs');
            $name_file = $date . '.csv';

            $uploadFile = \Storage::disk('sftp')->put($name_file, \Storage::disk('public')->get('files_upload/SN244266.csv'));

            if($uploadFile){
                $archivo_subio = \Storage::disk('sftp')->exists($name_file);
                if($archivo_subio){
                    return response()->json(['status' => 'ok', 'message' => 'The file upload success'], 200);
                }
            }
        }
    }


    public function donwloadFile(){
        $existe = \Storage::disk('sftp')->exists('SN244266.csv');

        //si existe en el disco del sftp
        if($existe){



            //vamos a obtener el archivo
            $file_get = \Storage::disk('sftp')->get('SN244266.csv');

            if($file_get){
                $movimiento = \Storage::disk('public')->put('/files_download/SN244266.csv', $file_get);
                if($movimiento){
                    return response()->json([
                        'status' => 'ok',
                        'message' => 'The file download in directory files_upload'
                    ]);
                }

            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'No se pudo obtener el fichero del SFTP'
                ]);
            }


        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'El archivo no existe en l directorio'
            ]);
        }
    }
}
