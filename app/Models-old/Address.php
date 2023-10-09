<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $table = 'address';
    public $timestamps = true;
    protected $fillable = array('address_ar','address_en', 'latitude', 'longitude');

}
