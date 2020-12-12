<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenAsesmen extends Model
{
    //

    protected $fillable = ['assessment_internal_id' , 'nama_dokumen_asesmen', 'body_indikator_dokumen'];
    
    protected $touches = ['assessmentInternal'];

    public function assessmentInternal(){
        return $this->belongsTo('App\AssessmentInternal');
    }
}
