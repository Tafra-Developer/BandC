<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Localizable;

class Category extends Model
{
    use Localizable;
    protected $fillable = ['name_ar', 'name_en'];
    protected $localizable = [
        'name'
    ];

    protected $append = ['name'];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
