<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Menu;

class MenuController extends Controller
{
    public function index()
    {
    	return view('pages.menu.index');
    }

    function simpan(Request $req){
        $type = $req->type != 2 ? 1:2;
    	$valid = Validator::make($req->all(), [
            'nama'=>'required|min:4',
            'url'=>'required|min:10'
        ]);

        if($valid->fails()){
            return response()->json(['status'=>0,'errors'=>$valid->errors()]);
        }

        $jum = Menu::get()->count();

    	$result = Menu::create([
                'nama_menu'=>$req->nama, 
                'url_menu'=>$req->url, 
                'type_menu'=>$type,
                'sort_menu'=>$jum,    
        ]);

        if($result){
     		$data = Menu::where('nama_menu',$req->nama)
     				->where('url_menu',$req->url)
     				->select('id','nama_menu','url_menu','type_menu')->first();   	
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

    public function sort(Request $req)
    {
        if($req->data != ''){
            $sort = 0;
            foreach($req->data as $x){
                Menu::where('id',$x['id'])->update(['sort_menu'=>$sort,'type_menu'=>1]);
                $sort++;
            }
        }

        if($req->data2 != ''){
            $sort = 0;
            foreach($req->data2 as $x){
                Menu::where('id',$x['id'])->update(['sort_menu'=>$sort,'type_menu'=>2]);
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
