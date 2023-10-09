<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title_en', 'title_ar', 'excerpt_en', 'excerpt_ar', 'body_en', 'body_ar', 'activation', 'is_featured', 'published_at','slug');

    public function photo()
    {
        return $this->morphone('App\Models\Photo' , 'photoable');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag' , 'taggable');
    }

    public function scopePublished($query)
    {
        return $query->where('published_at','<=',Carbon::now()->toDateString());
    }

}
