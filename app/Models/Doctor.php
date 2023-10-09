<?php


namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use Localizable;
    protected $fillable = [
        'name_ar',
        'name_en',
        'desc_ar',
        'desc_en',
        'postion_ar',
        'postion_en',
        'facebook',
        'twitter',
        'insta',
        'img'
    ];
    protected $localizable = [
        'name',
        'desc',
    ];

   
}