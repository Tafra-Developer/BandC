<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{

    protected $fillable =   [
        'name',
        'phone',
        'email',
        'notes',
        'category_id',
        'date',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
