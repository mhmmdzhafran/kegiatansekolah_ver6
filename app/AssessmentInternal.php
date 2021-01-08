<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AssessmentInternal extends Model
{
    //
    protected  $fillable = [
        "user_id", "nama_sekolah", "alamat_sekolah", "nama_kepsek", "nomor_hp", "email_kepsek", "indikator_skor_penilaian_ppk",
        "rerata_indikator_1","rerata_indikator_2","rerata_indikator_3","rerata_indikator_4","rerata_indikator_5","rerata_indikator_6","rerata_indikator_7",
        "rerata_indikator_8","rerata_indikator_9","rerata_indikator_10", "skor_penilaian_kegiatan_akhir"
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function dokumenAsesmen(){
        return $this->hasMany('App\DokumenAsesmen');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timezone('Asia/Jakarta')->toDateTimeString();
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timezone('Asia/Jakarta')->toDateTimeString();
    }

}
