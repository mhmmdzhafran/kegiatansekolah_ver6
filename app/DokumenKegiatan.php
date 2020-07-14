<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenKegiatan extends Model
{
    //
    protected $fillable = ["dokumentasi_kegiatan_id", "nama_dokumen" , "status_unggah_dokumen"];

    public function dokumentasiKegiatan(){
        return $this->belongsTo('App\DokumentasiKegiatan');
    }
}
