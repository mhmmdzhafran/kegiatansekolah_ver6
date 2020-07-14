<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolderAssessmentEksternal extends Model
{
    //
    protected $fillable = ["nama_folder_ppk"];

    public function assessmentEksternal(){
        return $this->belongsTo('App\AssessmentEksternal');
    }
}
