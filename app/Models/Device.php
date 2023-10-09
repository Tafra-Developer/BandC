<?php


namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use Localizable;
    protected $fillable = [
        'name_ar',
        'name_en',
        'desc_ar',
        'desc_en',
        'img'
    ];
    protected $localizable = [
        'name',
        'desc',
    ];

    
}