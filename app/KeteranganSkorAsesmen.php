<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class KeteranganSkorAsesmen extends Model
{
    //

    public function PenjelasanAsesmen(){
        return $this->belongsTo('App\PenjelasanAsesmen');
    }
}
