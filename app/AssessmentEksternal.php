<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentEksternal extends Model
{
    //
    protected $fillable = [
        "nama_assessment", "user_id","nama_sekolah","alamat_sekolah","nama_kepsek","nomor_hp","email_kepsek",
        "indikator_skor_penilaian_ppk", "skor_penilaian_kegiatan_akhir","rerata_indikator_1", 'rerata_indikator_2','rerata_indikator_3',
        'rerata_indikator_4', 'rerata_indikator_5', 'rerata_indikator_6', 'rerata_indikator_7', 'rerata_indikator_8','rerata_indikator_9',
        'rerata_indikator_10'
    ];

    public function folderAssessmentEx(){
        return $this->hasOne('App\FolderAssessmentEksternal');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
