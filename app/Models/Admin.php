<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;



class Admin  extends Authenticatable
{
    use HasRoles;
    protected $table = 'admins';
    public $timestamps = true;
    protected $guard_name = 'admin';
    protected $guarded=['id'];
    protected $hidden = array('password');



}
