<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenjelasanAsesmen extends Model
{
    //
    public function KeteranganSkor(){
        return $this->hasMany('App\KeteranganSkorAsesmen');
    }

    public function KategoriAsesmen(){
        return $this->belongsTo('App\KategoriAsesmen');
    }
}
