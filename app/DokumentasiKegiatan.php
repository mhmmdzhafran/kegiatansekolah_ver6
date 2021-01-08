<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    //

    protected $fillable = ['folder_dokumentasi_id' , 'user_id' , 'nama_pj','nama_kegiatan' , 'nilai_kegiatan_ppk' , 'keterangan_dokumentasi', 'nilai_ppk', 'kegiatan_berbasis', 'mulai_kegiatan', 'akhir_kegiatan' , 'tipe_kegiatan', 'add_link_video', 'add_link_article'];


    public function folderDokumentasi(){
        return $this->belongsTo('App\FolderDokumentasi', 'folder_dokumentasi_id');
    }

    public function statusKegiatan(){
        return $this->morphToMany('App\StatusKegiatan' , 'status_kegiatanable');
    }

    public function dokumenKegiatan(){
        return $this->hasMany('App\DokumenKegiatan');
    }

    public function fotoKegiatan(){
        return $this->hasMany('App\FotoKegiatan');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timezone('Asia/Jakarta')->toDateTimeString();
    }
}
