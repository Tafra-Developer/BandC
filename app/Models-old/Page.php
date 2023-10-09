<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $table = 'pages';
    public $timestamps = true;
    protected $fillable = array('title_en', 'title_ar', 'excerpt_en', 'excerpt_ar', 'body_en', 'body_ar', 'activation', 'is_featured','slug');

    public function photo()
    {
        return $this->morphone('App\Models\Photo' , 'photoable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag' , 'taggable');
    }
}
