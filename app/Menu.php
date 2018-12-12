<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['nama_menu','type_menu','url_menu','sort_menu'];
}
