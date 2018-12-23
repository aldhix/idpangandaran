<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain;
use Validator;
use Auth;

class DomainController extends Controller
{
    public function index()
    {
    	return view('pages.domain.index');
    }

    public function simpan(Request $req)
    {
    	$result = Domain::create([
                'domain'=>$req->domain,
                'route'=>$req->route,    
        ]);

    	if($result){
     		$data = Domain::where('domain',$req->domain)
     				->select('id','domain','route')
     				->orderBy('id','desc')->first();   	
        	return [ 'status'=>1, 'data'=> $data];
        } else {
        	return [ 'status'=>0 ];
        }
    }

    public function edit(Request $req)
    {
    	$result = Domain::where('id',$req->id)
    	->update([
    			'domain'=>$req->domain,
                'route'=>$req->route,
    		]);
    }

    public function hapus(Request $req)
    {
    	$result = Domain::where('id',$req->id)->delete();
    }
}
