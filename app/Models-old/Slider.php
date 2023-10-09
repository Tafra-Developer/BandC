<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $table = 'sliders';
    public $timestamps = true;
    protected $fillable = array('title_en', 'title_ar', 'body_en', 'body_ar', 'activation', 'is_featured', 'action_url','slug');

    public function photo()
    {
        return $this->morphOne('App\Models\Photo' , 'photoable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag' , 'taggable');
    }

}
