<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class DataPPKService{
    public function createKeteranganKegiatanPPK($type){
        if ($type == 'Proposal') {
            $keterangan_default [] = array(
                'no' => 1,
                'keterangan_opsional' => ''
            );
            $keterangan_default [] = array(
                'no' => 2,
                'keterangan_wajib_ulang' => ''
            );
            $keterangan_default [] = array(
                'no' => 3,
                'keterangan_wajib' => ''
            );
        } elseif($type == 'Laporan'){
            $keterangan_default [] = array(
                'no' => 1,
                'keterangan_opsional' => ''
            );
            $keterangan_default [] = array(
                'no' => 2,
                'keterangan_wajib_ulang' => ''
            );
        }
        return json_encode($keterangan_default);
    }

    public function showDataPPK($dataPPK){
        $id_nilai_ppk = 1;
        $data_nilai_ppk = '';
        foreach ($dataPPK as $item_ppk) {
            if ($id_nilai_ppk == count($dataPPK)) {
                $data_nilai_ppk .= $item_ppk->nilai_ppk;
            }
            else{
                $data_nilai_ppk .= $item_ppk->nilai_ppk.", ";
            }
            $id_nilai_ppk++;
        }
        return $data_nilai_ppk;
    }

    public function statusKegiatanPPK($kegiatan, $status, $type){
        if ($kegiatan === 'Pengajuan' && $type == 'Proposal Kegiatan') {
            if($status =="Belum Disetujui"){
                $status_indikator = "<h6 class='text-center alert alert-info alert-heading font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
            }
            elseif($status == "Sudah Disetujui"){
                $status_indikator ="<h6 class='text-center alert alert-success alert-heading font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
            }
            elseif($status == "Pengajuan Ulang"){
                if (Auth::user()->Role->role_title == 'Kepala Sekolah') {
                    $status_indikator = "<h6 class='text-center alert alert-warning font-weight-bolder' style='border-radius:10px;'>Diajukan Kembali</h6>";
                } else {
                    $status_indikator = "<h6 class='text-center alert alert-warning font-weight-bolder' style='border-radius:10px;'>Ajukan Ulang</h6>";
                }
            }
            elseif($status == "Menolak"){
                if (Auth::user()->Role->role_title == 'Penanggung Jawab Kegiatan') {
                    $status_indikator = "<h6 class='text-center alert alert-danger font-weight-bolder' style='border-radius:10px;'>Ditolak</h6>";
                } else {
                    $status_indikator = "<h6 class='text-center alert alert-danger font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
                }
            }
        } elseif($kegiatan == 'Dokumentasi') {
            if ($status == "Unggah Dokumentasi") {
                if (Auth::user()->Role->role_title == 'Kepala Sekolah') {
                    $status_indikator = "<h6 class='text-center alert alert-warning font-weight-bolder' style='border-radius:10px;'>Belum Unggah</h6>";
                } else {
                    $status_indikator = "<h6 class='text-center alert alert-warning font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
                }
            }
            elseif($status == "Sudah Mengunggah Dokumentasi"){
                if ($type == 'Pengajuan Historis') {
                    $status_indikator = "<h6 class='text-center alert alert-success font-weight-bolder' style='border-radius:10px;'>".$status."(".$type.")</h6>";
                } else {
                    $status_indikator = "<h6 class='text-center alert alert-success font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
                }
            } elseif($status == "Belum Disetujui"){
                $status_indikator = "<h6 class='text-center alert alert-primary font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
            } elseif($status == "Pengajuan Ulang"){
                if (Auth::user()->Role->role_title == 'Kepala Sekolah') {
                    $status_indikator = "<h6 class='text-center alert alert-warning font-weight-bolder' style='border-radius:10px;'>Diajukan Kembali</h6>";
                } else {
                    $status_indikator = "<h6 class='text-center alert alert-warning font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
                }
            }
        }
        return $status_indikator;
    }
}