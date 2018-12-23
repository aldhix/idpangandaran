<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Categorie;

class HomeController extends Controller
{
    public function index()
    {   
        return view('welcome');
    }
    public function read($url, $id)
    {
        $data = Post::joinRead()
        ->where('posts.url_title',$url)
        ->where('posts.id',$id)
        ->first();

        return view('template.pages.read',['data'=>$data]);
    }

    public function cat($url)
    {
        $cat = Categorie::select('nama_categorie')->where('url_categorie',$url)->first();
        $data = Post::joinSelect()
        ->where('categories.url_categorie',$url)
        ->paginate(10);
        return view('template.pages.cat',['data'=>$data,'cat'=>$cat]);
    }

    public function search(Request $req)
    {
        $keyword = !empty($req->keyword) ? $req->keyword : '';
        $data = Post::joinRead()
        ->where('posts.title','like',"%$keyword%")
        ->paginate(10);

        return view('template.pages.search',['keyword'=>$keyword,'datas'=>$data]);
    }
}
