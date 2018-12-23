<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Categorie;

class NewsHomeController extends Controller
{
    public function index()
    {
    	return view('news.welcome');
    }

    public function read($url, $id)
    {
    	$data = Post::joinRead()
        ->where('domains.route','news')
        ->where('posts.url_title',$url)
        ->where('posts.id',$id)
        ->first();

        return view('news.pages.read',['data'=>$data]);
    }

    public function cat($url)
    {
        $cat = Categorie::select('nama_categorie')->where('url_categorie',$url)->first();
        $data = Post::joinSelect('news')
        ->where('domains.route','news')
        ->where('categories.url_categorie',$url)
        ->paginate(10);
        return view('news.pages.cat',['data'=>$data,'cat'=>$cat]);
    }

    public function search(Request $req)
    {
        $keyword = !empty($req->keyword) ? $req->keyword : '';
        $data = Post::joinRead()
        ->where('domains.route','news')
        ->where('posts.title','like',"%$keyword%")
        ->paginate(10);

        return view('news.pages.search',['keyword'=>$keyword,'datas'=>$data]);
    }
}
