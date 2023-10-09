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

    protected static function booted(): void
    {
        static::created(function ($model) {
            if (request()->has('img')) {
                request()->validate([
                    'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
                $path = request()->file('img')->store('public');
                $model->img = str_replace('public/', '', $path);
                $model->save();
            }
        });
    }
}
