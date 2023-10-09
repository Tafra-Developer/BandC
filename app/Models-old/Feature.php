<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model

{
    protected $table = 'features';
    public $timestamps = true;



    protected $dates = ['deleted_at'];
    protected $fillable = array('title_en','title_ar', 'body_en' , 'body_ar'  , 'service_id');



    public function photo()
    {
        return $this->morphOne('App\Models\Photo' , 'photoable');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}