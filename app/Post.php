<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['id_user','id_categorie','title','content','meta_description',
    'featured_image','url_title','code_time','type_save'];

    
    public function scopeJoinSelectAdmin($query)
    {

    	return $query->join('users','users.id','posts.id_user')
        ->join('categories','categories.id','posts.id_categorie')
        ->join('domains','domains.id','categories.id_domain')
	    ->select(
	    	'posts.id as id',
	        'title',
	        'categories.nama_categorie as kategori',
	        'posts.meta_description as description',
	        'users.name as name',
	        'featured_image as filename',
	        'type_save',
	        'posts.created_at as create',
	        'domains.route as route',
	        'url_title',
	        'url_categorie'
	     );
    }

    public function scopeJoinSelect($query)
    {

    	return $query->join('users','users.id','posts.id_user')
        ->join('categories','categories.id','posts.id_categorie')
        ->join('domains','domains.id','categories.id_domain')
	    ->select(
	    	'posts.id as id',
	        'title',
	        'categories.nama_categorie as kategori',
	        'posts.meta_description as description',
	        'users.name as name',
	        'featured_image as filename',
	        'type_save',
	        'posts.created_at as create',
	        'domains.route as route',
	        'url_title',
	        'url_categorie'
	     )
	    ->where('posts.type_save','publish');
    }

    public function scopeJoinRead($query)
    {
    
    	 return $query->join('users','users.id','posts.id_user')
        ->join('categories','categories.id','posts.id_categorie')
        ->join('domains','domains.id','categories.id_domain')
	    ->select(
	    	'posts.id as id',
	        'title',
	        'categories.nama_categorie as kategori',
	        'posts.meta_description as description',
	        'users.name as name',
	        'featured_image as filename',
	        'type_save',
	        'posts.created_at as create',
	        'domains.route as route',
	        'url_title',
	        'url_categorie',
	        'content'
	     )
	    ->where('posts.type_save','publish');
    }
}
