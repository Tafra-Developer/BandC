<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Model 
{

    protected $table = 'taggables';
    public $timestamps = true;
    protected $fillable = array('tag_id', 'taggable_type', 'taggable_id');

}