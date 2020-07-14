<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    protected $fillable = ['role_title'];

    public function Users(){
        return $this->hasMany('App\User');
    }
}
