<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job_type extends Model
{

    protected $table = 'job_types';
    public $timestamps = true;
    protected $fillable = array('type');


    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }


}