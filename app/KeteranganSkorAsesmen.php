<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeteranganSkorAsesmen extends Model
{
    //

    public function PenjelasanAsesmen(){
        return $this->belongsTo('App\PenjelasanAsesmen');
    }
}
