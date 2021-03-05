<?php

namespace App\Services;

use App\DokumenAsesmen;
use App\DokumenKegiatan;
use App\FotoKegiatan;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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
    

    public function multipleStoreFileKegiatan($file, $kegiatan, $type, $file_type , $otherUsage = null){
        $kumpulan_dokumen  = [];
        $new_dokumen_name = "";
        foreach ($file as $file_kegiatan) {
            $dokumen_name = $file_kegiatan->getClientOriginalName();
            if ($type == "Pengajuan" || $type == "Pengajuan Historis" && is_null($otherUsage)) {
                if ($file_type == "dokumen") {
                    $new_dokumen_name = $kegiatan->mulai_kegiatan."_".$kegiatan->nama_kegiatan."_Laporan Kegiatan_".$dokumen_name;
                    $checker =  $kegiatan->dokumenKegiatan()->where([ 
                        ["nama_dokumen" , $new_dokumen_name], 
                        ["status_unggah_dokumen" , $type]
                    ])->first();
                } elseif($file_type == "image") {
                    $new_dokumen_name = $kegiatan->mulai_kegiatan."_".$kegiatan->nama_kegiatan."_Dokumentasi_".$dokumen_name;
                    $checker  = $kegiatan->fotoKegiatan()->where([
                        ["nama_foto_kegiatan" , $new_dokumen_name],
                        ["status_unggah_foto" , $type]
                    ])->first();
                }
                $exists = Storage::disk('public')->exists('dokumentasi_kegiatan/'.$new_dokumen_name);
                if($exists && !is_null($checker)){
                    if ($file_type == "dokumen") {
                        // $input["nama_dokumen"] = $new_dokumen_name;
                        $kegiatan->dokumenKegiatan()->where([
                            ["nama_dokumen", '=', $new_dokumen_name], 
                            ["status_unggah_dokumen", '=', $type]
                        ])->touch();

                    } elseif($file_type == "image") {
                        // $input["nama_foto_kegiatan"] = $new_dokumen_name;
                        $kegiatan->fotoKegiatan()->where([
                            ["nama_foto_kegiatan", '=', $new_dokumen_name], 
                            ["status_unggah_foto", '=', $type]
                        ])->touch();
                    }
                    // unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$new_dokumen_name));
                    // $simpan_file = $file_kegiatan->move('kegiatan/dokumentasi_kegiatan/', $new_dokumen_name);
                    $simpan_file = $file_kegiatan->storeAs('dokumentasi_kegiatan', $new_dokumen_name, 'public');
                    if (!$simpan_file) {
                        $this->removeKumpulanFile($kumpulan_dokumen, $kegiatan, $file_type, $type);
                        return false;
                    }
                    // $kumpulan_dokumen = [];
                    continue;
                } else {
                    $kumpulan_dokumen [] = $new_dokumen_name;
                    if ($file_type == "dokumen") {
                        $dokumen_create = new DokumenKegiatan([
                            "dokumentasi_kegiatan_id" => $kegiatan->id,
                            "nama_dokumen" => $new_dokumen_name,
                            "status_unggah_dokumen" => $type
                        ]);
                        $dokumen_final =  $kegiatan->dokumenKegiatan()->save($dokumen_create);
                    } elseif($file_type == "image") {
                        $image_create = new FotoKegiatan([
                            'dokumentasi_kegiatan_id' => $kegiatan->id,
                            'nama_foto_kegiatan' => $new_dokumen_name,
                            'status_unggah_foto' => $type
                        ]);
                        $dokumen_final =  $kegiatan->fotoKegiatan()->save($image_create);
                    }
                    // $file_uploaded = $file_kegiatan->move('kegiatan/dokumentasi_kegiatan/', $new_dokumen_name);
                    $file_uploaded = $file_kegiatan->storeAs('dokumentasi_kegiatan', $new_dokumen_name, 'public');
                    if ($file_uploaded && $dokumen_final) {
                        continue;
                    } else {
                        //delete dokumen
                        if ($file_type == "dokumen") {
                            $this->removeKumpulanFile($kumpulan_dokumen , $kegiatan, $file_type, $type);
                            // return Response::json(['errors' => ['Terjadi Kegagalan Dalam Menyimpan Dokumen, Silahkan Dicoba Kembali']], 422);
                            return false;
                        } elseif($file_type == "image"){
                            $this->removeKumpulanFile($kumpulan_dokumen, $kegiatan, $file_type, $type);
                            return false;
                        }
                    }   
                }
            } elseif($type == 'Asesmen' && !is_null($otherUsage)){
                if ($file_type == 'dokumenAsesmen') {
                    $new_dokumen_name = "Poin_Indikator_".$otherUsage."_".$kegiatan->nama_sekolah."_".$kegiatan->id."_Internal Asesmen_".$dokumen_name;
                }
                $checker  = $kegiatan->dokumenAsesmen()->where([
                    ['nama_dokumen_asesmen' , '=', $new_dokumen_name],
                    ['body_indikator_dokumen', '=' , $otherUsage]
                ])->first();
                if (file_exists(public_path('kegiatan/asesmen_internal/'.$new_dokumen_name)) && !is_null($checker)) {
                  
                    $kegiatan->dokumenAsesmen()->where([
                        ['nama_dokumen_asesmen' , '=', $new_dokumen_name],
                        ['body_indikator_dokumen', '=' , $otherUsage]
                    ])->touch();
                    $dokumen_update = $file_kegiatan->move('kegiatan/asesmen_internal', $new_dokumen_name);
                    if (!$dokumen_update) {
                        $this->removeKumpulanFile($kumpulan_dokumen, $kegiatan, 'asesmen', $otherUsage);
                        return Response::json(['message'=>'data is not valid' , 'errors' => ['File tidak berhasil diunggah, Silahkan Coba Kembali']], 422);
                    }
                   
                } 
                else {
                    $kumpulan_dokumen [] = $new_dokumen_name;
                    $dokumen = new DokumenAsesmen([
                        'assessment_internal_id' => $kegiatan->id,
                        'nama_dokumen_asesmen' => $new_dokumen_name,
                        'body_indikator_dokumen' => $otherUsage
                    ]);
                    $upload_file = $file_kegiatan->move('kegiatan/asesmen_internal/', $new_dokumen_name);
                    $add_dokumen = $kegiatan->dokumenAsesmen()->save($dokumen);
                    if ($upload_file && $add_dokumen) {
                        continue;
                    } else {
                        $this->removeKumpulanFile($kumpulan_dokumen, $kegiatan, 'asesmen', $otherUsage);
                        return Response::json(['message'=>'data is not valid' , 'errors' => ['File tidak berhasil diunggah, Silahkan Coba Kembali']], 422);
                    }
                }
            } else {
                return Response::json(['errors' => ['Tidak dapat memproses data, silahkan Coba kembali']], 422);
            }
        }
        if (count($kumpulan_dokumen) == 0) {
            $kumpulan_dokumen = true;
            return $kumpulan_dokumen;
        } else {
            return $kumpulan_dokumen;
        }
    }

    public function removeKumpulanFile($arrFile , $data , $tipe_file, $optData){
        if (count($arrFile) > 0) {
            foreach ($arrFile as $files) {
                if ($tipe_file == 'dokumen' || $tipe_file == 'image') {
                    $exists = Storage::disk('public')->exists('dokumentasi_kegiatan/'.$files);
                    if ($exists) {
                        // unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$files));
                        Storage::disk('public')->delete('dokumentasi_kegiatan/'.$files);
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
                    $exists_asesmen = Storage::disk('public')->exists('asesmen_internal_ppk/'.$files);
                    if ($exists_asesmen) {
                        // unlink(public_path('kegiatan/asesmen_internal/'.$files));
                        Storage::disk('public')->delete('asesmen_internal_ppk/'.$files);
                    }
                    if ($optData == 'all') {
                        $data->dokumenAsesmen()->where('nama_dokumen_asesmen', $files)->delete();
                    } else {
                        $data->dokumenAsesmen()->where([
                            ['nama_dokumen_asesmen' , '=', $files],
                            ['body_indikator_dokumen', '=' , $optData]
                        ])->delete();
                    }
                }
            }
        }
        return true;
    }

    public function fileArrTypeChecker($fileArr){
        if (gettype($fileArr) == 'boolean' && $fileArr) {
            $fileArr = [];
            return $fileArr;
        } elseif(gettype($fileArr) == 'array') {
            return $fileArr;
        }
    }

    private function getFileSize($file){
        $sizeAllDokumen = 0;
        foreach ($file as $documentFile) {
            $sizeAllDokumen += $documentFile->getSize();
        }
        return $sizeAllDokumen;
    }

}