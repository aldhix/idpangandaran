<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Menu;
use App\Domain;

class MenuController extends Controller
{
    public function index()
    {
    	return view('pages.menu.index');
    }

    public function second($id)
    {
        $data = Domain::where('id',$id)->first();
        return view('pages.menu.second',['domain'=>$data]);
    }

    function simpan(Request $req){
    	
        $valid = Validator::make($req->all(), [
            'nama'=>'required|min:4',
        ]);

        if($valid->fails()){
            return response()->json(['status'=>0,'errors'=>$valid->errors()]);
        }

        $jum = Menu::where('id_domain',$req->iddomain)->get()->count();

    	$result = Menu::create([
                'nama_menu'=>$req->nama, 
                'url_menu'=>$req->url, 
                'type_menu'=>$req->type,
                'sort_menu'=>$jum, 
                'id_domain'=>$req->iddomain,   
        ]);

        if($result){
     		$data = Menu::where('nama_menu',$req->nama)
                    ->where('id_domain',$req->iddomain)
                    ->where('type_menu',$req->type)
     				->where('url_menu',$req->url)
     				->select('id','nama_menu','url_menu')
                    ->orderBy('id','desc')->first();   	
        	return [
				'status'=>1,
				'data'=> $data,
			];
        } else {
        	return [
				'status'=>0,
			];
        }
    }

    function edit(Request $req){
        
        $valid = Validator::make($req->all(), [
            'nama'=>'required|min:4',
        ]);

        if($valid->fails()){
            return response()->json(['status'=>0,'errors'=>$valid->errors()]);
        }

        $result = Menu::where('id',$req->id)
        ->update([
                'nama_menu'=>$req->nama, 
                'url_menu'=>$req->url, 
        ]);

        if($result){
            return [  'status'=>1 ];
        } else {
            return [ 'status'=>0 ];
        }
    }

    public function sort(Request $req)
    {
        if($req->data != ''){
            $sort = 0;
            foreach($req->data as $x){
                Menu::where('id',$x['id'])
                ->update([
                    'sort_menu'=>$sort,
                    'type_menu'=>$req->type,
                    'id_domain'=>$req->iddomain,
                    ]);
                $sort++;
            }
        }

        return 1;
    }

    public function hapus(Request $req)
    {
    	$result = Menu::where('id',$req->id)->delete();
    }
}
