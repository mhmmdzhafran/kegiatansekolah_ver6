<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    //

    protected $fillable = ['folder_dokumentasi_id' , 'user_id' , 'nama_kegiatan' , 'nilai_kegiatan_ppk' , 'keterangan_dokumentasi', 'nilai_ppk', 'kegiatan_berbasis', 'mulai_kegiatan', 'akhir_kegiatan'];


    public function folderDokumentasi(){
        return $this->belongsTo('App\FolderDokumentasi', 'folder_dokumentasi_id');
    }

    public function statusKegiatan(){
        return $this->morphToMany('App\StatusKegiatan' , 'status_kegiatanable');
    }

    public function dokumenKegiatan(){
        return $this->hasMany('App\DokumenKegiatan');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
