<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Response;
use App\Photo;
use Image;
use Auth;

class PhotoController extends Controller
{
    public function upload(Request $req)
    {
        $file = $req->file('file');
        $filename = md5(Auth::user()->id).'_'.time().'.'.$file->getClientOriginalExtension();
        
        $img = Image::make($file);
        $img->fit(810,512);
        $img->save('images/photos/'.$filename,60);

        $img_thumbs = Image::make($file);
        $img_thumbs->fit('150');
        $img_thumbs->save('images/photos/thumbs/thumb_'.$filename);

        $img_origins = Image::make($file);
        $img_origins->save('images/photos/origins/ori_'.$filename,60);

        $result = Photo::create([
                'filename'=>$filename,
        ]);

        $data = Photo::select('filename')->orderBy('id','desc')->paginate(10);
        return response()->json(['status'=>1,'data'=>$data]);
    }

    public function data(Request $req)
    {
        return Photo::select('filename')->orderBy('id','desc')->paginate(10);
    }
    
}
