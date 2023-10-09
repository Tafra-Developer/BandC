<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model 
{
    protected $table = 'options';
    public $timestamps = true;
    protected $fillable = array('key', 'value' , 'data_type' , 'validation' , 'display_name_ar' , 'display_name_en');


    public function validation()
    {
        return $this->hasOne(Validation::class);
    }

}