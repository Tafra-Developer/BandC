<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';
    public $timestamps = true;
    protected $fillable = array('name', 'body');

    public function photo()
    {
        return $this->morphOne('App\Models\Photo' , 'photoable');
    }
}
