<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriAsesmen extends Model
{
    //
    public function PenjelasanAsesmen(){
        return $this->hasMany('App\PenjelasanAsesmen');
    }
}
