<?php


namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use Localizable;
    protected $fillable = [
        'name_ar',
        'name_en',
        'img'
    ];
    protected $localizable = [
        'name',
    ];

   
}
