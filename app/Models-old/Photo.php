<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model 
{

    protected $table = 'photos';
    public $timestamps = true;
    protected $fillable = array('original', 'extension', 'photo_400', 'photo_600', 'photo_800', 'photoable_type', 'photoable_id');

    public function photoable()
    {
        return $this->morphTo();
    }

}