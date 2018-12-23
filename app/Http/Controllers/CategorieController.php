<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Categorie;
use App\Domain;

class CategorieController extends Controller
{
    public function index($id)
    {
        $data = Domain::where('id',$id)->first();
    	return view('pages.categorie.index',['domain'=>$data]);
    }

    public function simpan(Request $req)
    {
    	$valid = Validator::make($req->all(), [
            'kategori'=>'required|min:4|unique:categories,nama_categorie',
        ]);

        if($valid->fails()){
            return response()->json(['status'=>0,'errors'=>$valid->errors()]);
        }

        $url = str_slug($req->kategori,"-");

        $result = Categorie::create([
                'nama_categorie'=>$req->kategori, 
                'id_domain'=>$req->iddomain, 
                'url_categorie'=>$url, 
                'sub_categorie'=>0, 
        ]);

        if($result){
        	$data = Categorie::where('nama_categorie',$req->kategori)
                    ->where('id_domain',$req->iddomain)
     				->where('url_categorie',$url)
                    ->orderBy('id','desc')
     				->select('id','nama_categorie as kategori')->first();   

       		 return response()->json(['status'=>1,'data'=>$data]); 	
        } else {
        	return response()->json(['status'=>0]);
        }
       
    }

    public function update(Request $req)
    {
    	$valid = Validator::make($req->all(), [
            'kategori'=>'required|min:4',
        ]);	

        if($valid->fails()){
            return response()->json(['status'=>0,'errors'=>$valid->errors()]);
        }

        $url = str_replace(' ','-',strtolower($req->kategori));

    	$result = Categorie::where('id',$req->id)
    	->update([
                'nama_categorie'=>$req->kategori,
                'url_categorie'=>$url,
                'sub_categorie'=>0, 
        ]);

        if($result){
        	return response()->json(['status'=>1]);
        } else {
        	return response()->json(['status'=>0]);
        }
        
    }

    public function delete(Request $req)
    {
    	$result = Categorie::where('id',$req->id)->delete();
    }

    public function addTo(Request $req)
    {
        $result = Categorie::where('id',$req->id)->update(['id_domain'=>$req->iddomain]);
    }
}
