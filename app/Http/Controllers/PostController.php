<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Photo;
use Auth;
use Validator;
use Image;
use File;

class PostController extends Controller
{
    public function save(Request $req)
    {
		$valid = Validator::make($req->all(),[
			'title'=>'required|between:2,100',  
            'description'=>'required|between:2,500',              
            'image'=>'required|image',
        ]);

        if($valid->fails()){
            return redirect()->back()
                    ->withErrors($valid)
                    ->withInput();
        }

        $data = Post::orderBy('id','desc')->first();
        $no = count($data) <= 0 ? 1 : $data->id + 1;

        $post_code = md5(time().$no.Auth::user()->id);
        $file_name = $post_code.'.'.$req->image->getClientOriginalExtension();
        $path = storage_path('app/images/'.Auth::user()->username.'/');
        
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        $img = Image::make($req->image->getRealPath());
        $img->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path.$file_name);

        $img_thumb = Image::make($req->image->getRealPath())->fit(150);
        $img_thumb->save($path.'thumb_'.$file_name);

        Photo::create([
            'post_code'=>$post_code,
            'file_name'=>$file_name,
        ]);

        $result = Post::create([
                'post_code'=>$post_code,
        		'id_user'=>Auth::user()->id,
        		'title'=>$req->title,
                'content'=>$req->description,
            ]);

        if($result){
            return back();
        } else {
            return back();
        }

    }

    public function read(Request $req)
    {
    	$data = Post::join('users','users.id','posts.id_user')
                ->select('posts.id as id','users.name as name',
                        'posts.*')
                ->where('posts.id',$req->id)
                ->first();
    	return view('pages.post.read',['data'=>$data]);
    }
}
