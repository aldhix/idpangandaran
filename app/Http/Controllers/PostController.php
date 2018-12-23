<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Photo;
use Auth;
use Validator;
use Image;
use File;
use App\Domain;
use App\RecentCategoriesPost;

class PostController extends Controller
{
    public function data(Request $req)
    {
        $keyword = $req->keyword;
        $kategori = $req->kategori;
        $data = Post::joinSelectAdmin()
        ->where('domains.id',$req->iddomain)
        ->where('posts.title','like',"%$keyword%")
        ->where('categories.id','like',"%$kategori%")
        ->orderBy('posts.id','desc')
        ->paginate(5);

        return $data;
    }
    public function index($id)
    {
       $data = Domain::where('id',$id)->first();
       return view('pages.post.index',['domain'=>$data]);
    }

    public function add($id)
    {
       $data = Domain::where('id',$id)->first();
       return view('pages.post.add',['domain'=>$data]);
    }

    public function edit(Request $req)
    {
       $domain = Domain::where('id',$req->iddomain)->first();
       $data = Post::where('id',$req->id)
                    ->first(); 
       return view('pages.post.edit',['post'=>$data,'domain'=>$domain]);
    }

    public function save(Request $req)
    {
        if($req->button == 'simpan'){
            return $this->simpan($req);
        } else if($req->button == 'update') {
            return $this->update($req);
        }
    }

    public function simpan($req)
    {
		$valid = Validator::make($req->all(),[
			'title'=>'nullable',  
            'content'=>'nullable',
        ]);

        if($valid->fails()){
            return response()->json(['status'=>0,'errors'=>$valid->errors()]);
        }

        $title = !empty($req->title) ? $req->title : 'Untitled';
        $url = str_slug($title,"-");

        $result = Post::create([
                'meta_description'=>$req->meta,
        		'id_user'=>Auth::user()->id,
        		'title'=>$title,
                'url_title'=>$url,
                'content'=>$req->content,
                'id_categorie'=>$req->kategori,
                'featured_image'=>$req->featured_img,
                'code_time'=>$req->code_time,
                'type_save'=>$req->type_save,
            ]);

        if($result){  

            $data = Post::where('title',$title)
                    ->where('id_user',Auth::user()->id)
                    ->where('code_time',$req->code_time)
                    ->where('id_categorie',$req->kategori)
                    ->select('id')->orderBy('id','desc')->first(); 

            RecentCategoriesPost::updateOrCreate(
                ['id_domain' => $req->iddomain, 'id_categorie' => $req->kategori],
                ['id_post' => $data->id]
            );

            return [
                'status'=>1,
                'id'=> $data->id,
            ];
        } else {
            return [
                'status'=>0,
            ];
        }

    }

    public function update($req)
    {
        $valid = Validator::make($req->all(),[
            'title'=>'nullable',  
            'content'=>'nullable',
        ]);

        if($valid->fails()){
            return response()->json(['status'=>0,'errors'=>$valid->errors()]);
        }

        $title = !empty($req->title) ? $req->title : 'Untitled';
        $url = str_slug($title,"-");

        $result = Post::where('id',$req->id)
            ->update([
                'meta_description'=>$req->meta,
                'id_user'=>Auth::user()->id,
                'title'=>$title,
                'url_title'=>$url,
                'content'=>$req->content,
                'id_categorie'=>$req->kategori,
                'featured_image'=>$req->featured_img,
                'code_time'=>$req->code_time,
                'type_save'=>$req->type_save,
            ]);

        if($result){ 
            
            RecentCategoriesPost::updateOrCreate(
                ['id_domain' => $req->iddomain, 'id_categorie' => $req->kategori],
                ['id_post' => $req->id]
            );

            return [
                'status'=>1,
                'id'=> $req->id,
            ];
        } else {
            return [
                'status'=>0,
            ];
        }
    }

    public function delete(Request $req)
    {
        $result = Post::where('id',$req->id)->delete();

        $keyword = $req->keyword;
        $kategori = $req->kategori;
        $data = Post::joinSelectAdmin()
        ->where('domains.id',$req->iddomain)
        ->where('posts.title','like',"%$keyword%")
        ->where('categories.id','like',"%$kategori%")
        ->orderBy('posts.id','desc')
        ->paginate(5);

        return $data;
    }
}
