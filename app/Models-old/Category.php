<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{

    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('name_en', 'name_ar', 'activation', 'is_featured');

    public function photo()
    {
        return $this->morphOne('App\Models\Photo' , 'photoable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag' , 'taggable');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

}