<?php
namespace App\Services;

class DataPPKService{
    public function countPPK($nilaiPPK){
        $id_nilai_ppk = 1;
        for ($i=0; $i < count($nilaiPPK) ; $i++) { 
            $json_ppk[] = array(
                'no' => $id_nilai_ppk,
                'nilai_ppk' => $nilaiPPK[$i]
            );
            $id_nilai_ppk++;
        }
        return json_encode($json_ppk);
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
                $status_indikator = "<h6 class='text-center alert alert-warning font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
            }
            elseif($status == "Menolak"){
                $status_indikator = "<h6 class='text-center alert alert-danger font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
            }
        } elseif($kegiatan == 'Dokumentasi') {
            if ($status == "Unggah Dokumentasi") {
                $status_indikator = "<h6 class='text-center alert alert-warning font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
            }
            elseif($status == "Sudah Mengunggah Dokumentasi"){
                if ($type == 'Pengajuan Historis') {
                    $status_indikator = "<h6 class='text-center alert alert-success font-weight-bolder' style='border-radius:10px;'>".$status."(".$type.")</h6>";
                } else {
                    $status_indikator = "<h6 class='text-center alert alert-success font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
                }
            } elseif($status == "Belum Disetujui"){
                if ($type == 'Pengajuan Historis') {
                    $status_indikator = "<h6 class='text-center alert alert-primary font-weight-bolder' style='border-radius:10px;'>".$status."(".$type.")</h6>";
                } else {
                    $status_indikator = "<h6 class='text-center alert alert-primary font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
                }
            } elseif($status == "Pengajuan Ulang"){
                if ($type == "Pengajuan Historis") {
                    $status_indikator = "<h6 class='text-center alert alert-info font-weight-bolder' style='border-radius:10px;'>".$status."(".$type.")</h6>";
                } else {
                    $status_indikator = "<h6 class='text-center alert alert-info font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
                }
            }
        }
        return $status_indikator;
    }
}