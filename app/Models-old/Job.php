<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    protected $table = 'jobs';
    public $timestamps = true;
    protected $fillable = array( 'title_en', 'title_ar', 'details_en', 'details_ar', 'activation', 'is_featured' , 'job_type_id','slug');

    public function photo()
    {
        return $this->morphOne('App\Models\Photo' , 'photoable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag' , 'taggable');
    }



    public function job_type()
    {
        return $this->belongsTo('App\Models\Job_type');
    }
}
