<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecentCategoriesPost extends Model
{
    protected $fillable = [
        'id_categorie','id_domain','id_post'
    ];

    public function scopeJoinSelect($query)
    {
    	return $query->join('posts','posts.id','recent_categories_posts.id_post')
    	->join('users','users.id','posts.id_user')
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
	     )->where('posts.type_save','publish');
    }

}
