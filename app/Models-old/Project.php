<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $table = 'projects';
    public $timestamps = true;
    protected $fillable = array('name_en', 'name_ar', 'excerpt_en', 'excerpt_ar', 'description_en', 'description_ar', 'activation', 'is_featured','slug');

    public function photo()
    {
        return $this->morphOne('App\Models\Photo' , 'photoable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag' , 'taggable');
    }

}
