<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{

    protected $table = 'validations';
    public $timestamps = true;
    protected $fillable = array('option_id', 'value');

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}