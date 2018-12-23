<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['nama_categorie','url_categorie','sub_categorie','id_domain'];
}
