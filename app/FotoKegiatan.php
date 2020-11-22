<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoKegiatan extends Model
{
    //

    protected $fillable = [
        'dokumentasi_kegiatan_id', 'nama_foto_kegiatan', 'status_unggah_foto'
    ];

    public function dokumentasiKegiatan(){
        return $this->belongsTo('App\DokumentasiKegiatan');
    }
}
