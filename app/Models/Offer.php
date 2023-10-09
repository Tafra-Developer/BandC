<?php


namespace App\Models;

use App\Traits\Localizable;
use Illuminate\Database\Eloquent\Model;


class Offer extends Model
{
    use Localizable;
    protected $fillable = [
        'name_ar',
        'name_en',
        'content_ar',
        'content_en',
        'price',
        'rate',
        'is_active',
        'category_id',
        'img'
    ];
    protected $localizable = [
        'name',
        'content',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

 
}
