<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriAsesmen extends Model
{
    //
    public function PenjelasanAsesmen(){
        return $this->hasOne('App\PenjelasanAsesmen');
    }
}
