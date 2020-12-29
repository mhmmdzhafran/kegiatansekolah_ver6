<?php

namespace App\Services;

use Illuminate\Support\Facades\Response;

class FileUploadService {

    public function isFileUploaded($file, $type){
        if (is_null($file)) {
            if ($type == 'dokumen') {
                return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumen, Silahkan Unggah Dokumen dengan ekstensi yang telah ditetapkan dan Total File Tidak Melebihi 5MB']], 422);
            } elseif($type == 'foto') {
                return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumentasi Kegiatan, Silahkan Unggah Dokumen Dokumentasi dengan ekstensi .png atau .jpeg dan Total File Tidak Melebihi 5MB']], 422);
            }
            return true;
        }
    }

    public function isFileSize($file){
        $calculateData  = $this->getFileSize($file);
        if ($calculateData > 5120000) {
            return Response::json(['errors' => ['Total File Size melebihi kapasitas yang sudah ditetapkan (Total Max: 5MB), Total File Ada: '.round(($calculateData / 1000) / 1000 , 2)." MB"]], 422);
        } else {
            return true;
        }
    }
    private function getFileSize($file){
        $sizeAllDokumen = 0;
        foreach ($file as $documentFile) {
            $sizeAllDokumen += $documentFile->getSize();
        }
        return $sizeAllDokumen;
    }

    public function removeKumpulanFile($arrFile , $data , $tipe_file, $optData){
        if (count($arrFile) > 0) {
            foreach ($arrFile as $files) {
                if ($tipe_file == 'dokumen' || $tipe_file == 'image') {
                    if (file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$files))) {
                        unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$files));
                        if ($tipe_file == "dokumen") {
                            $data->dokumenKegiatan()->where([
                                ["nama_dokumen" , $files],
                                ["status_unggah_dokumen" , $optData]
                            ])->delete();
                        } elseif($tipe_file == "image") {
                            $data->fotoKegiatan()->where([
                                ["nama_foto_kegiatan" , $files],
                                ["status_unggah_foto" , $optData]
                            ])->delete();   
                        }
                    } else {
                        if ($tipe_file == "dokumen") {
                            $data->dokumenKegiatan()->where([
                                ["nama_dokumen" , $files],
                                ["status_unggah_dokumen" , $optData]
                            ])->delete();
                        } elseif($tipe_file == "image") {
                            $data->fotoKegiatan()->where([
                                ["nama_foto_kegiatan" , $files],
                                ["status_unggah_foto" , $optData]
                            ])->delete();   
                        }
                    }
                } elseif($tipe_file == 'asesmen'){
                    if (file_exists(public_path('kegiatan/asesmen_internal/'.$files))) {
                        unlink(public_path('kegiatan/asesmen_internal/'.$files));
                    }
                    $data->dokumenAsesmen()->where([
                        ['nama_dokumen_asesmen' , '=', $files],
                        ['body_indikator_dokumen', '=' , $optData]
                    ])->delete();
                    
                }
            }
        }
        return true;
    }

    // public function fileNamingScheme($fileName, $type, $addAnotherType = ''){
    //     if ($type == 'Proposal') {
    //         if ($addAnotherType != '') {
    //             $name = '';
    //         }
    //         $name = '';
    //     } elseif($type == 'Laporan'){
    //         $name = '';
    //     } elseif($type == 'Admin'){
    //         $name = "USER-ACC-".$fileName;
    //         return $name;
    //     } elseif($type == 'Asesmen'){
    //         $name = '';
    //     }
    //     return $name;
    // }
}