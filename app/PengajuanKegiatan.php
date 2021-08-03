<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PengajuanKegiatan extends Model
{
    //

    protected $fillable = ['user_id', 'nama_pj', 'PJ_nama_kegiatan', 'nilai_ppk', 
    'dokumen_kegiatan', 'mulai_kegiatan', 'akhir_kegiatan', 'kegiatan_berbasis', 'keterangan_json'];

    public function StatusKegiatan(){
        return $this->morphToMany('App\StatusKegiatan' , 'status_kegiatanable');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timezone('Asia/Jakarta')->toDateTimeString();
    }
}
