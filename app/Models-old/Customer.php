<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customers';
    public $timestamps = true;
    protected $fillable = array('name', 'phone' , 'email', 'activation', 'is_featured','slug');

    public function photo()
    {
        return $this->morphOne('App\Models\Photo' , 'photoable');
    }

}
