<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusKegiatan extends Model
{
    //

    protected $fillable = ['nama'];

    // public function pengajuanKegiatan(){
    //     return $this->hasMany('App\PengajuanKegiatan');
    // }

    public function pengajuanKegiatan(){
        return $this->morphedByMany('App\PengajuanKegiatan', 'status_kegiatanable');
    }
    
    public function dokumentasiKegiatan(){
        return $this->morphedByMany('App\DokumentasiKegiatan', 'status_kegiatanable');
    }
}
