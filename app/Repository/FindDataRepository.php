<?php

namespace App\Repository;

use App\AssessmentInternal;
use App\DokumentasiKegiatan;
use App\PengajuanKegiatan;
use App\PenjelasanAsesmen;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FindDataRepository{
    public function findDataModel($data, $type){
        if ($type == 'Proposal') {
            try{
                $data_pengajuan = PengajuanKegiatan::findOrFail($data);
            } catch(ModelNotFoundException $e){
                return $e->getMessage();
            } catch(\Throwable $th){
                return $th->getMessage();
            }
            return $data_pengajuan;
        } elseif($type == 'Laporan'){
            try{
                $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($data);
            } catch(ModelNotFoundException $e){
                return $e->getMessage();
            } catch(\Throwable $th){
                return $th->getMessage();
            } 
            return $dokumentasi_kegiatan;
        } elseif($type == 'User'){
            try{
                $user = User::findOrFail($data);
            } catch(ModelNotFoundException $e){
                return $e->getMessage();
            } catch(\Throwable $th){
                return $th->getMessage();
            }
            return $user;
        } elseif($type == 'Asesmen'){
            try{
                $assessmen_internal = AssessmentInternal::findOrFail($data);
            } catch(ModelNotFoundException $e){
                return $e->getMessage();
            } catch(\Throwable $th){
                return $th->getMessage();
            }
            return $assessmen_internal;
        } elseif($type == 'Penjelasan'){
            try {
                $penjelasan_asesmen = PenjelasanAsesmen::findOrFail(intval($data));
            } catch(ModelNotFoundException $e){
                return $e->getMessage();
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
            return $penjelasan_asesmen;
        }
    }
}