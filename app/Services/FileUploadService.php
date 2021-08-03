<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
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

    public function storeSingleFile($file, $file_name = '', $type){
        $directory = '';
        if ($type == 'upload_img_user') {
            $directory = 'photo_user_simppk';
        } elseif($type == 'upload_proposal') {
            $directory = 'pengajuan_kegiatan';
        } elseif($type == 'update_single_dokumen_asesmen'){
            $directory = 'asesmen_internal';
        }
        $store_file = $file->storeAs($directory, $file_name, 'public');
        if (!$store_file) {
            return false;
        }
        return $file_name;
    }

    public function removeSingleFile($file_name, $type){
        $directory = '';
        if ($type == 'delete_user_img') {
            $directory = 'photo_user_simppk';
        } elseif($type == 'delete_upload_proposal') {
            $directory = 'pengajuan_kegiatan';
        } elseif($type == 'delete_single_asesmen_file'){
            $directory = 'asesmen_internal';
        }
        $exists = Storage::disk('public')->exists($directory.'/'.$file_name);
        if ($exists) {
            Storage::disk('public')->delete($directory.'/'.$file_name);
        }
        return true;
    }

    public function multipleStoreDataFileKegiatan($file, $kegiatan, $type, $file_type , $otherUsage = null){
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
                        $kegiatan->dokumenKegiatan()->where([
                            ["nama_dokumen", '=', $new_dokumen_name], 
                            ["status_unggah_dokumen", '=', $type]
                        ])->touch();

                    } elseif($file_type == "image") {
                        $kegiatan->fotoKegiatan()->where([
                            ["nama_foto_kegiatan", '=', $new_dokumen_name], 
                            ["status_unggah_foto", '=', $type]
                        ])->touch();
                    }
                    $simpan_file = $file_kegiatan->storeAs('dokumentasi_kegiatan', $new_dokumen_name, 'public');
                    if (!$simpan_file) {
                        $this->removeKumpulanDataFile($kumpulan_dokumen, $kegiatan, $file_type, $type);
                        return false;
                    }
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
                    $file_uploaded = $file_kegiatan->storeAs('dokumentasi_kegiatan', $new_dokumen_name, 'public');
                    if ($file_uploaded && $dokumen_final) {
                        continue;
                    } else {
                        if ($file_type == "dokumen") {
                            $this->removeKumpulanDataFile($kumpulan_dokumen , $kegiatan, $file_type, $type);
                            return false;
                        } elseif($file_type == "image"){
                            $this->removeKumpulanDataFile($kumpulan_dokumen, $kegiatan, $file_type, $type);
                            return false;
                        }
                    }   
                }
            } elseif($type == 'Asesmen' && !is_null($otherUsage)){
                if ($file_type == 'dokumenAsesmen') {
                    $new_dokumen_name = "Poin_Indikator_".$otherUsage."_".$kegiatan->nama_sekolah."_".$kegiatan->id."_Internal Asesmen_".$dokumen_name;
                }
                $checker  = $kegiatan->dokumenAsesmen()->where([
                    ['nama_dokumen_asesmen' , $new_dokumen_name],
                    ['body_indikator_dokumen',  $otherUsage]
                ])->first();
                if (Storage::disk('public')->exists('asesmen_internal/'.$new_dokumen_name) && !is_null($checker)) {
                  
                    $kegiatan->dokumenAsesmen()->where([
                        ['nama_dokumen_asesmen' , $new_dokumen_name],
                        ['body_indikator_dokumen',  $otherUsage]
                    ])->touch();
                    $dokumen_update = $file_kegiatan->storeAs('asesmen_internal', $new_dokumen_name, 'public');
                    if (!$dokumen_update) {
                        $this->removeKumpulanDataFile($kumpulan_dokumen, $kegiatan, 'asesmen', $otherUsage);
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
                    $add_dokumen = $kegiatan->dokumenAsesmen()->save($dokumen);
                    $upload_file = $file_kegiatan->storeAs('asesmen_internal', $new_dokumen_name, 'public');
                    if ($upload_file && $add_dokumen) {
                        continue;
                    } else {
                        $this->removeKumpulanDataFile($kumpulan_dokumen, $kegiatan, 'asesmen', $otherUsage);
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

    public function removeKumpulanDataFile($arrFile , $data , $tipe_file, $optData){
        if (count($arrFile) > 0) {
            foreach ($arrFile as $files) {
                if ($tipe_file == 'dokumen' || $tipe_file == 'image') {
                    $exists = Storage::disk('public')->exists('dokumentasi_kegiatan/'.$files);
                    if ($exists) {
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
                        Storage::disk('public')->delete('asesmen_internal_ppk/'.$files);
                    }
                    if ($optData == 'all') {
                        $data->dokumenAsesmen()->where('nama_dokumen_asesmen', $files)->delete();
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