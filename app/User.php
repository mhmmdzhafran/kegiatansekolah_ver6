<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username_id', 'email_user','password', 'role_id', 'photo_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function Role(){
        return $this->belongsTo('App\Role');
    }

    // public function PengajuanKegiatan(){
    //     return $this->belongsTo('App\PengajuanKegiatan');
    // }

    public function PengajuanKegiatan(){
        return $this->hasMany('App\PengajuanKegiatan', 'user_id');
    }

    public function DokumentasiKegiatan(){
        return $this->hasMany('App\DokumentasiKegiatan', 'user_id');
    }

    // public function folderDokumentasi(){
    //     return $this->hasManyThrough('App\FolderDokumentasi', 'App\DokumentasiKegiatan','user_id', 'dokumentasi_kegiatan_id');
    // }

    // public function AssessmentEksternal(){
    //     return $this->hasMany('App\AssessmentEksternal');
    // }

    public function AssessmentInternal(){
        return $this->hasMany('App\AssessmentInternal');
    }

    public function isAdmin(){
        if ($this->Role->role_title == 'Admin') {
            return true;
        }
        return false;
    }

    public function isPJ(){
        if ($this->Role->role_title == 'Penanggung Jawab Kegiatan') {
            return true;
        }
        return false;
    }

    public function isKepalaSekolah(){
        if ($this->Role->role_title == 'Kepala Sekolah') {
            return true;
        }
        return false;
    }

    public function oldestNotifications(){
        return $this->morphMany(DatabaseNotification::class, 'notifiable')->orderBy('created_at', 'asc');
    }

    public function routeNotificationForMail($notification){
        return $this->email_user;
    }

    // public function isPenilaiEksternal(){
    //     if ($this->Role->role_title == 'Penilai Eksternal') {
    //         return true;
    //     }
    //     return false;
    // }

    // public function isPenilaiInternal(){
    //     if ($this->Role->role_title == 'Penilai Internal') {
    //         return true;
    //     }
    //     return false;
    // }
}
