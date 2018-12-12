<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Response;

class PhotoController extends Controller
{
    public function photo(Request $req)
    {
    	$path = storage_path('app/images/'.$req->username.'/'.$req->file_name);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function thumb(Request $req)
    {
    	$path = storage_path('app/images/'.$req->username.'/thumb_'.$req->file_name);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
