<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model 
{

    protected $table = 'menus';
    public $timestamps = true;
    protected $fillable = array('link', 'parent_id', 'name_en', 'name_ar', 'activation', 'is_featured');

    public function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'parent_id');
    }

    public function Children()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id');
    }

}