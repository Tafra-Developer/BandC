<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('category_id', 'name_en', 'name_ar', 'body_en', 'body_ar', 'excerpt_en', 'excerpt_ar', 'price', 'offer_price', 'activation', 'is_featured','slug');

    public function photo()
    {
        return $this->morphone('App\Models\Photo' , 'photoable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag' , 'taggable');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
