<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = 'tags';
    public $timestamps = true;
    protected $fillable = array('title_en', 'title_ar');

    public function posts()
    {
        return $this->morphedByMany('App\Models\Post'  , 'taggable');
    }

    public function sliders()
    {
        return $this->morphedByMany('App\Models\Slider'   , 'taggable');
    }

    public function pages()
    {
        return $this->morphedByMany('App\Models\Page'  , 'taggable');
    }

    public function jobs()
    {
        return $this->morphedByMany('App\Models\Job'  , 'taggable');
    }

    public function categories()
    {
        return $this->morphedByMany('App\Models\Category'  , 'taggable');
    }

    public function products()
    {
        return $this->morphedByMany('App\Models\Product'  , 'taggable');
    }

    public function customers()
    {
        return $this->morphedByMany('App\Models\Customer'  , 'taggable');
    }

    public function projects()
    {
        return $this->morphedByMany('App\Models\Project'  , 'taggable');
    }

    public function services()
    {
        return $this->morphedByMany('App\Models\Service'  , 'taggable');
    }

}
