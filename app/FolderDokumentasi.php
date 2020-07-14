<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolderDokumentasi extends Model
{
    //

    protected $fillable  = ['nama_folder_dokumentasi'];

    public function dokumentasiKegiatan(){
        return $this->hasOne('App\DokumentasiKegiatan');
    }

    public function dokumenKegiatan(){
        return $this->hasManyThrough(
            'App\DokumenKegiatan',
            'App\DokumentasiKegiatan',
            'folder_dokumentasi_id', // Foreign key on dokumentasi_kegiatan table...
            'dokumentasi_kegiatan_id' // Foreign key on dokumen_kegiatan table...
        );
    }
}
