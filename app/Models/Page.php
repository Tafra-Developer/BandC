<?php

namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Localizable;
    protected $fillable = [
        'name_ar',
        'name_en',
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
        'number',
        'img'
    ];
    protected $localizable = [
        'name',
        'title',
        'content',
    ];

   
}
