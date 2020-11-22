<?php

namespace App\Http\Controllers;

use App\DokumentasiKegiatan;
use App\Events\KeputusanLaporanKegiatanToPJEvent;
use App\Events\KeputusanProposalKegiatanToPJEvent;
use App\FolderDokumentasi;
use App\Http\Requests\KepalaSekolahKegiatanValidatorRequest;
use App\PengajuanKegiatan;
use App\StatusKegiatan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KepalaSekolahMengelolaKegiatanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pengajuan_all = PengajuanKegiatan::with(['statusKegiatan' ])->select('pengajuan_kegiatans.*');
        if (request()->ajax()) { 
            return datatables()->eloquent($pengajuan_all)->addColumn('statusKegiatan', function(PengajuanKegiatan $pengajuan){
                $status_pengajuan =  $pengajuan->statusKegiatan->pluck('nama')->implode('<br>');
                $status_indikator = $this->statusKegiatan("Pengajuan", $status_pengajuan, "Proposal Kegiatan");
                return $status_indikator;
            })->addColumn('data_pengajuan', function($data){
                foreach($data->statusKegiatan as $data_pengajuan){
                    if($data_pengajuan->pivot->status_kegiatanable_type == "App\PengajuanKegiatan"){
                        if ($data_pengajuan->pivot->status_kegiatan_id == 3 && $data_pengajuan->pivot->status_kegiatanable_id == $data->id) {
                            $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-danger btn-sm data_pengajuan rounded-pill" value ="belum_disetujui">Lihat Detail</button>';
                        }
                        elseif ($data_pengajuan->pivot->status_kegiatan_id == 1 && $data_pengajuan->pivot->status_kegiatanable_id == $data->id) {
                            $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm data_pengajuan rounded-pill" value ="sudah_disetujui">Lihat Detail</button>';
                        }
                        elseif ($data_pengajuan->pivot->status_kegiatan_id == 5 && $data_pengajuan->pivot->status_kegiatanable_id == $data->id) {
                            $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm data_pengajuan rounded-pill" value ="menolak">Lihat Detail</button>';
                        }
                        elseif ($data_pengajuan->pivot->status_kegiatan_id == 4 && $data_pengajuan->pivot->status_kegiatanable_id == $data->id) {
                            $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm data_pengajuan rounded-pill" value ="pengajuan_ulang">Lihat Detail</button>';
                        }
                    }
                    return $aksi;
                }
            })->editColumn('nilai_ppk', function($data){
                $json_ppk = json_decode($data->nilai_ppk);
                $data_ppk = $this->getDataPPK($json_ppk);
                return $data_ppk;
            })->editColumn('updated_at' , function($data){
                return $data->updated_at->timezone('Asia/Jakarta')->toDateTimeString();
            })
            ->rawColumns(['statusKegiatan', 'data_pengajuan', 'nilai_ppk'])->make(true);       
        }        

       return view('kepsek.kelola_kegiatan.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if (request()->ajax()) {
            try{
                $data_pengajuan_kegiatan = PengajuanKegiatan::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                return Response::json([
                    'messages' => 'Data Pengajuan Kegiatan Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id.", System Error Message: ". $e->getMessage()
                ], 404);
            } catch(\Throwable $th){
                return Response::json([
                    'messages' => $th->getMessage()
                ], 404);
            }
            if (!is_null($data_pengajuan_kegiatan->user()->first())) {
                $usersName = $data_pengajuan_kegiatan->user->name;
            } else {
                $usersName = $data_pengajuan_kegiatan->nama_pj;
            }
            $status_kegiatan =  $data_pengajuan_kegiatan->statusKegiatan()->first();
            $dokumen = json_decode($data_pengajuan_kegiatan->dokumen_kegiatan);
            $nama_dokumen = "";
            foreach ($dokumen as $isi_data_dokumen) {
                $nama_dokumen = $isi_data_dokumen->nama_dokumen;
            }
            if ($dokumen) {
                if (file_exists(public_path('kegiatan/pengajuan_kegiatan/'.$nama_dokumen))) {
                    return Response::json(['data' => $data_pengajuan_kegiatan, 'status_kegiatan' => $status_kegiatan ,'status_dokumen' => true, 'username' => $usersName], 200);
                }
                return Response::json(['data' => $data_pengajuan_kegiatan, 'status_kegiatan' => $status_kegiatan ,'status_dokumen' => false, 'username' => $usersName], 200);
            }
            else{
                return Response::json(['data' => $data_pengajuan_kegiatan, 'status_kegiatan' => $status_kegiatan ,'status_dokumen' => false, 'username' => $usersName], 200);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try{
            $pengajuan_kegiatan = PengajuanKegiatan::findOrFail($id);
        } catch(ModelNotFoundException $e){
            return Response::json([
                'messages' => 'Data Pengajuan Kegiatan Tidak Ditemukan, Silahkan Coba Kontak Admin untuk disesuaikan, ID Pengajuan Kegiatan yang diberikan: '.$id.", System Error Message: ". $e->getMessage()
            ], 404);
        } catch(\Throwable $e){
            return Response::json([
                'messages' => $e->getMessage()
            ], 422);
        }
        
        if (!is_null($pengajuan_kegiatan->user()->first())) {
            $data_user = $pengajuan_kegiatan->user->name;
        } else {
            $data_user = $pengajuan_kegiatan->nama_pj;
        }
        
        foreach($pengajuan_kegiatan->StatusKegiatan as $status){
            $status_kegiatan  = $status;
        }
        if ($status_kegiatan->id !== 3) {
            return redirect()->to('/kepala-sekolah/mengelola-kegiatan');
        }
        return view('kepsek.kelola_kegiatan.edit', compact('pengajuan_kegiatan', 'status_kegiatan', 'data_user', 'id'));
    }

    /**
     * Get pengajuan dan dokumentasi kegiatan stuffs
    */
    // public function get_data_dan_dokumen_pengajuan($id){
    //     if (request()->ajax()) {
    //         try{
    //             $pengajuan_kegiatan = PengajuanKegiatan::findOrFail($id);
    //         } catch (ModelNotFoundException $e) {
    //             return Response::json([
    //                 'messages' => 'Data Pengajuan Kegiatan Tidak Ditemukan, Silahkan Coba Kontak Admin untuk disesuaikan, ID yang diberikan: '.$id.", System Error Message: ". $e->getMessage()
    //             ], 404);
    //         } catch(\Throwable $th){
    //             return Response::json([
    //                 'messages' => $th->getMessage()
    //             ], 404);
    //         }
    //         $nama_dokumen = "";
    //         $dokumen_pengajuan = json_decode($pengajuan_kegiatan->dokumen_kegiatan);
    //         $keterangan_pengajuan = json_decode($pengajuan_kegiatan->keterangan_json);
    //         foreach ($dokumen_pengajuan as $isi_data_dokumen) {
    //             $nama_dokumen = $isi_data_dokumen->nama_dokumen;
    //         }
    //         if ($dokumen_pengajuan) {
    //             if (file_exists(public_path('kegiatan/pengajuan_kegiatan/'.$nama_dokumen))) {
    //                 return Response::json(['status_dokumen' => true, 'data_dokumen' => $dokumen_pengajuan , 'data' => $pengajuan_kegiatan, 'keterangan' => $keterangan_pengajuan], 200);
    //             } else {
    //                 return Response::json(['status_dokumen' => false, 'data_dokumen' => "Tidak terdapat Dokumen Pengajuan Kegiatan", 'data' => $pengajuan_kegiatan , 'keterangan' => $keterangan_pengajuan], 200);
    //             }
    //         }
    //         else{
    //             return Response::json(['status_dokumen' => false, 'data_dokumen' => "Tidak terdapat Dokumen Pengajuan Kegiatan"], 200);
    //         }
    //     }
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KepalaSekolahKegiatanValidatorRequest $request, $id)
    {
        //
        try{
            $pengajuan_kegiatan = PengajuanKegiatan::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'messages' => 'Data Pengajuan Kegiatan Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id.", System Error Message: ". $e->getMessage()
            ], 404);
        } catch(\Throwable $th){
            return Response::json([
                'messages' => $th->getMessage()
            ], 404);
        }
        // foreach($pengajuan_kegiatan->StatusKegiatan as $status){
        //     $status_kegiatan  = $status;
        // }
        $statusSebelumnya = 0;
        foreach($pengajuan_kegiatan->StatusKegiatan as $status){
            $statusSebelumnya = $status->pivot->status_kegiatan_id;
        }
        // if ($statusSebelumnya !== 3) {
        //     return response()->json(['messages' => 'Data Ini Sudah Dibuatkan Keputusan!', 'redirect' => true], 403);
        // } else {
            $input = $request->only([
                'PJ_nama_kegiatan',
                'nilai_ppk',
                'kegiatan_berbasis',
                'mulai_kegiatan',
                'akhir_kegiatan',
                'id_keterangan',
                'keterangan'
            ]);
            if ($request->id_keterangan == 2) {
                if (is_null($request->keterangan)) {
                    return Response::json(['errors' => ['Keterangan untuk dilakukan Pengajuan Ulang belum diisi, silahkan coba kembali']], 422);
                }
            }
            elseif($request->id_keterangan == 3){
                if (is_null($request->keterangan)) {
                    return Response::json(['errors' => ['Keterangan untuk dilakukan Penolakan belum diisi, silahkan coba kembali']], 422);
                }
            }
            switch ($input['id_keterangan']) {
                case 1:
                    $keterangan = $pengajuan_kegiatan->keterangan_json;
                    $keterangan_decode = json_decode($keterangan);
                    $tanggal_mulai = $pengajuan_kegiatan->mulai_kegiatan;
                    $tanggal_akhir = $pengajuan_kegiatan->akhir_kegiatan;
                    $user_id = $pengajuan_kegiatan->user_id;
                    $username_pj = $pengajuan_kegiatan->nama_pj;
                    foreach ($keterangan_decode as $key) {
                        if($key->no == 1){
                            // $update = $pengajuan_kegiatan->update($input);
                            $update = $this->updateKegiatan($pengajuan_kegiatan, "Proposal", $input['id_keterangan'] ,$input['keterangan'], $key, $keterangan_decode);
                            if($update){
                                $dokumentasi = $this->createDefaultDokumentasi($user_id, $username_pj, $pengajuan_kegiatan->PJ_nama_kegiatan, $pengajuan_kegiatan->nilai_ppk, $pengajuan_kegiatan->kegiatan_berbasis, $tanggal_mulai, $tanggal_akhir);
                                if (!$dokumentasi) {
                                    // restore before
                                    $key->keterangan_opsional = "";
                                    $keterangan_restore = json_encode($keterangan_decode);
                                    $input['keterangan_json'] = $keterangan_restore;
                                    $pengajuan_kegiatan->update($input);
                                    return Response::json(['errors' => ['Tidak dapat membuat data Dokumentasi Kegiatan, silahkan dicoba kembali']], 422);
                                }
                                $statusSukses = StatusKegiatan::findOrFail(1);
                                $pengajuan_kegiatan->StatusKegiatan()->updateExistingPivot($statusSebelumnya, [
                                    'status_kegiatan_id' => $statusSukses->id
                                ]);
                                if (!is_null($pengajuan_kegiatan->user()->first())) {
                                    event(new KeputusanProposalKegiatanToPJEvent($pengajuan_kegiatan->user()->first(), $pengajuan_kegiatan, $statusSukses));
                                }
                                return Response::json(['data' => 'data is valid', 'status_data'=>'Pengajuan Kegiatan Berhasil diterima!'], 200);
                                
                            }
                            else {
                                return Response::json(['errors' => ['Tidak dapat melakukan proses, silahkan coba lagi'], 'state' => true], 422);
                            }
                        }
                        else{
                            return Response::json(['errors' => ['Tidak ditemukan Data'], 'state' => false], 404);
                        }
                    }
                    break;
                //Pengajuan Ulang
                case 2:
                    $keterangan = $pengajuan_kegiatan->keterangan_json;
                    $keterangan_decode = json_decode($keterangan);
                    foreach ($keterangan_decode as $key) {
                        if ($key->no == 1) {
                            continue;
                        }
                        elseif($key->no == 2){
                            // $update = $pengajuan_kegiatan->update($input);
                            $update = $this->updateKegiatan($pengajuan_kegiatan, "Proposal", $input['id_keterangan'] ,$input['keterangan'], $key, $keterangan_decode);
                            if($update){
                                $statusSukses = StatusKegiatan::findOrFail(4);
                                $pengajuan_kegiatan->StatusKegiatan()->updateExistingPivot($statusSebelumnya, [
                                    'status_kegiatan_id' => $statusSukses->id
                                ]);
                                if (!is_null($pengajuan_kegiatan->user()->first())) {
                                    event(new KeputusanProposalKegiatanToPJEvent($pengajuan_kegiatan->user()->first(), $pengajuan_kegiatan, $statusSukses));
                                }
                                return Response::json(['data' => 'data is valid', 'status_data' => 'Kegiatan Yang Diajukan Telah Diajukan Ulang beserta Keterangan Dari Kepala Sekolah'], 200);
                            } else {
                                return Response::json(['errors' => ['Tidak dapat melakukan proses, silahkan coba lagi'], 'state' => true], 422);
                            }
                        }
                        else{
                            return Response::json(['errors' => ['Tidak ditemukan Data'], 'state' => false], 404);
                        }
                    }
                    break;
                //Menolak
                case 3:
                    $keterangan = $pengajuan_kegiatan->keterangan_json;
                    $keterangan_decode = json_decode($keterangan);
                    foreach ($keterangan_decode as $key) {
                        if ($key->no == 1) {
                            continue;
                        }
                        elseif($key->no == 2){
                            continue;
                        }
                        elseif($key->no == 3){
                            // $update = $pengajuan_kegiatan->update($input);
                            $update = $this->updateKegiatan($pengajuan_kegiatan, "Proposal", $input['id_keterangan'] ,$input['keterangan'], $key, $keterangan_decode);
                            if($update){
                                $statusSukses = StatusKegiatan::findOrFail(5);
                                $pengajuan_kegiatan->StatusKegiatan()->updateExistingPivot($statusSebelumnya, [
                                    'status_kegiatan_id' => $statusSukses->id
                                ]);                            
                                if (!is_null($pengajuan_kegiatan->user()->first())) {
                                    event(new KeputusanProposalKegiatanToPJEvent($pengajuan_kegiatan->user()->first(), $pengajuan_kegiatan, $statusSukses));
                                }
                                return Response::json(['data' => 'data is valid', 'status_data' => 'Kegiatan Yang Diajukan Telah Ditolak'], 200);
                            }
                            else{
                                return Response::json(['errors' => ['Tidak dapat melakukan proses, silahkan coba lagi'], 'state' => true], 422);
                            }
                        }
                        else{
                            return Response::json(['errors' => ['Tidak ditemukan Data'], 'state' => false], 404);
                        }
                    }
                    break;
                default:
                    return Response::json(['errors' => ['Tidak dapat melakukan proses, silahkan coba lagi']], 422);
                    break;
            }
        // }
        

    }

    /**
     * KHUSUS FUNCTION DOKUMENTASI
     */

    public function indexDokumentasi(){
        $dokumentasi_all = DokumentasiKegiatan::with(['statusKegiatan'])->select('dokumentasi_kegiatans.*');
         if (request()->ajax()) {
            return datatables()->eloquent($dokumentasi_all)->addColumn('statusKegiatan', function(DokumentasiKegiatan $dokumentasi){
                $status_indikator = $dokumentasi->statusKegiatan->pluck('nama')->implode('<br>');
                $status = $this->statusKegiatan("Dokumentasi",$status_indikator, $dokumentasi->tipe_kegiatan);
                return $status;
             })->addColumn('unggah_dokumentasi', function($data){
                foreach ($data->statusKegiatan as $item) {
                    if ($item->pivot->status_kegiatanable_type == "App\DokumentasiKegiatan") {
                        if ($item->pivot->status_kegiatan_id == 2) {
                            $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm rounded-pill status_pengajuan" value ="unggah_dokumentasi">Lihat Detail</button>';
                        } elseif($item->pivot->status_kegiatan_id == 6) {
                            $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm rounded-pill status_pengajuan" value ="sudah_unggah">Lihat Detail</button>';
                        } elseif($item->pivot->status_kegiatan_id == 3){
                            $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-danger btn-sm rounded-pill status_pengajuan" value ="belum_disetujui">Lihat Detail</button>';
                        } elseif($item->pivot->status_kegiatan_id == 4){
                            $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm rounded-pill status_pengajuan" value ="pengajuan_ulang">Lihat Detail</button>';
                        }
                        return $button;   
                    }
                }
             })->editColumn('nilai_ppk', function($data){
                $json_decode_nilai_ppk = json_decode($data->nilai_ppk);
                $nilai_ppk_kegiatan = $this->getDataPPK($json_decode_nilai_ppk);
                return $nilai_ppk_kegiatan;
             })->editColumn('updated_at' , function($data){
                return $data->updated_at->timezone('Asia/Jakarta')->toDateTimeString();
             })
             ->rawColumns(['statusKegiatan', 'unggah_dokumentasi' , 'nilai_ppk'])->make(true);
         }
        return view('kepsek.pengajuan_dokumentasi_kegiatan.index');
    }

    public function showDokumentasi($id){
        //for sukses dan Pengajuan Ulang dan belum mengunggah dokumentasi
        if (request()->ajax()) {
            try{
                $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
            } catch(ModelNotFoundException $e){
                return Response::json(['messages' => 'Terdapat Error saat pengambilan data, Silahkan Coba kembali dan Kontak Admin! id yang diberikan: '.$id.' System Error Code: '.$e->getMessage()], 404);
            } catch(\Throwable $th){
                return Response::json(['messages' => $th->getMessage()], 404);
            }
            if (!is_null($dokumentasi_kegiatan->user()->first())) {
                $userName = $dokumentasi_kegiatan->user->name;
            } else {
                $userName = $dokumentasi_kegiatan->nama_pj;
            }
            $status_kegiatan_dokumentasi = $dokumentasi_kegiatan->statusKegiatan()->first();
            $dokumen = $dokumentasi_kegiatan->dokumenKegiatan()->get();
            $image = $dokumentasi_kegiatan->fotoKegiatan()->get();
            if (count($dokumen) > 0  && count($image) > 0) {
                return Response::json(['dokumen_dokumentasi' => $dokumen, 'image_kegiatan' => $image, 'status_kegiatan' => $status_kegiatan_dokumentasi , 'data_dokumentasi' => $dokumentasi_kegiatan, 'username' => $userName], 200);
            }
            else{
                return Response::json(['status_kegiatan' => $status_kegiatan_dokumentasi, 'data_dokumentasi' => $dokumentasi_kegiatan , 'username' => $userName], 200);
            }
        }
    }   
    public function editDokumentasi($id){
        //For acc sukses dan pengajuan ulang
        try {
            $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(['messages' => $th->getMessage()], 404);
        } catch(ModelNotFoundException $e){
            return response()->json(['messages' => "Data Laporan Kegiatan Tidak Dapat Ditemukkan, Silahkan Kontak Admin! Status Error: ".$e->getMessage()], 404);
        }

        // $dokumen = $dokumentasi_kegiatan->dokumenKegiatan()->get();
        // $image = $dokumentasi_kegiatan->fotoKegiatan()->get();
        if (!is_null($dokumentasi_kegiatan->user()->first())) {
            $user_name = $dokumentasi_kegiatan->user->name;
        } else {
            $user_name = $dokumentasi_kegiatan->nama_pj;
        }
        // $nilai_ppk = json_decode($dokumentasi_kegiatan->nilai_ppk);
        foreach ($dokumentasi_kegiatan->statusKegiatan as $status) {
            $status_dokumentasi = $status;
        }
        if ($status_dokumentasi->id == 4) {
            return redirect()->to('/kepala-sekolah/dokumentasi-kegiatan');
        }
        return view('kepsek.pengajuan_dokumentasi_kegiatan.edit', compact('dokumentasi_kegiatan', 'user_name', 'status_dokumentasi'));        
        
    }

    public function updateDokumentasi(KepalaSekolahKegiatanValidatorRequest $request, $id){
        //for saving sukses dan pengajuan ulang dokumentasi kegiatan
        try {
            $dokumentasiKegiatan = DokumentasiKegiatan::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(['messages' => $th->getMessage()], 404);
        } catch(ModelNotFoundException $evt){
            return response()->json(['messages' => "Data Laporan Kegiatan Tidak Dapat Ditemukkan, Silahkan Kontak Admin! Status Error: ".$evt->getMessage()], 404);
        }
        $input = $request->only([
            "id_keterangan",
            "keterangan"
        ]);
        if ($request->id_keterangan == 2 && is_null($input['keterangan'])) {
            return response()->json(['errors' => ['Keterangan Pengajuan Ulang Belum Diisi, Silahkan Isi Keterangan Pengajuan Ulang']],422);
        }
        $keterangan = json_decode($dokumentasiKegiatan->keterangan_dokumentasi);
        foreach ($dokumentasiKegiatan->statusKegiatan as $status) {
            $statusSebelumnya = $status->pivot->status_kegiatan_id;
        }
        switch ($input['id_keterangan']) {
            case 1:          
                foreach ($keterangan as $listKeterangan) {
                    if ($listKeterangan->no == 1) {
                        $keterangan_sebelumnya = $listKeterangan->keterangan_opsional;
                        // $listKeterangan->keterangan_opsional = $input['keterangan'];
                        // $input['keterangan_dokumentasi'] = json_encode($keterangan);
                        // $updateDokumentasi = $dokumentasiKegiatan->update($input);
                        $this->updateKegiatan($dokumentasiKegiatan, "Laporan" ,$listKeterangan->no , $input['keterangan'], $listKeterangan , $keterangan);
                        $status_laporan_baru = StatusKegiatan::findOrFail(6);
                        $updateStatus = $dokumentasiKegiatan->statusKegiatan()->updateExistingPivot($statusSebelumnya, [
                            "status_kegiatan_id" => $status_laporan_baru->id
                        ]);
                        if (!$updateStatus) {
                            $this->updateKegiatan($dokumentasiKegiatan, "Laporan" ,$listKeterangan->no , $keterangan_sebelumnya, $listKeterangan , $keterangan);
                            return response()->json(['errors' => ['Terdapat Error Ketika Memberi Keputusan Pengajuan Ulang Kegiatan, Silahkan Mencoba Kembali']], 422);
                        } else {
                            if (!is_null($dokumentasiKegiatan->user()->first())) {
                                event(new KeputusanLaporanKegiatanToPJEvent($dokumentasiKegiatan->user()->first() , $dokumentasiKegiatan, $status_laporan_baru));
                            }
                            return response()->json(['data' => 'data is valid' , 'message' => 'Laporan dan Dokumentasi Kegiatan Berhasil Diterima'], 200);
                        }
                    }
                }
                break;
            case 2:
                foreach ($keterangan as $listKeterangan) {
                    if ($listKeterangan->no == 1) {
                        continue;
                    } elseif($listKeterangan->no == 2){
                        $keterangan_sebelumnya = $listKeterangan->keterangan_wajib_ulang;
                        // $listKeterangan->keterangan_wajib_ulang = $input['keterangan'];
                        // $input['keterangan_dokumentasi'] = json_encode($keterangan);
                        // $updateDokumentasi = $dokumentasiKegiatan->update($input);
                        $this->updateKegiatan($dokumentasiKegiatan, "Laporan" ,$listKeterangan->no , $input['keterangan'], $listKeterangan , $keterangan);
                        $status_laporan_baru = StatusKegiatan::findOrFail(4);
                        $statusUpdate = $dokumentasiKegiatan->statusKegiatan()->updateExistingPivot($statusSebelumnya, [
                            "status_kegiatan_id" => $status_laporan_baru->id
                        ]);
                        if (!$statusUpdate) {
                            $this->updateKegiatan($dokumentasiKegiatan, "Laporan" ,$listKeterangan->no ,  $keterangan_sebelumnya, $listKeterangan , $keterangan);
                            return response()->json(['errors' => ['Terdapat Error Ketika Memberi Keputusan Pengajuan Ulang Kegiatan, Silahkan Mencoba Kembali']], 422);
                        } else {
                            if (!is_null($dokumentasiKegiatan->user()->first())) {
                                event(new KeputusanLaporanKegiatanToPJEvent($dokumentasiKegiatan->user()->first() , $dokumentasiKegiatan, $status_laporan_baru));
                            }
                            return response()->json(['data' => 'data is valid', 'message' => 'Laporan dan Dokumentasi Kegiatan Berhasil Diajukan Ulang'], 200);
                        }
                    }
                }
                break;
            default:
                return response()->json(['messages' => 'Keterangan Not Found'], 404);
                break;
        }
    }

    public function get_data_kegiatan($id , $type){
        if (request()->ajax()) {
            try{
                if ($type == "pengajuan") {
                    $kegiatan = PengajuanKegiatan::findOrFail($id);
                } elseif($type == "dokumentasi"){
                    $kegiatan = DokumentasiKegiatan::findOrFail($id);
                }
            } catch (ModelNotFoundException $e) {
                if ($type == "pengajuan") {
                    return Response::json([
                        'messages' => 'Data Pengajuan Kegiatan Tidak Ditemukan, Silahkan Coba Kontak Admin untuk disesuaikan, ID yang diberikan: '.$id.", System Error Message: ". $e->getMessage()
                    ], 404);
                } elseif($type == "dokumentasi") {
                    return Response::json([
                        'messages' => 'Data Laporan Kegiatan Tidak Ditemukan, Silahkan Coba Kontak Admin untuk disesuaikan, ID yang diberikan: '.$id.", System Error Message: ". $e->getMessage()
                    ], 404);
                }
                
            } catch(\Throwable $th){
                return Response::json([
                    'messages' => $th->getMessage()
                ], 404);
            }
            if ($type == "pengajuan") {
                $nama_dokumen = "";
                $dokumen_pengajuan = json_decode($kegiatan->dokumen_kegiatan);
                foreach ($dokumen_pengajuan as $isi_data_dokumen) {
                    $nama_dokumen = $isi_data_dokumen->nama_dokumen;
                }
                $keterangan_pengajuan = json_decode($kegiatan->keterangan_json);
                if ($dokumen_pengajuan) {
                    if (file_exists(public_path('kegiatan/pengajuan_kegiatan/'.$nama_dokumen))) {
                        return Response::json(['status' => true, 'data_dokumen' => $dokumen_pengajuan , 'data' => $kegiatan, 'keterangan' => $keterangan_pengajuan], 200);
                    } else {
                        return Response::json(['status' => false, 'data_dokumen' => "Tidak terdapat Dokumen Pengajuan Kegiatan", 'data' => $kegiatan , 'keterangan' => $keterangan_pengajuan], 200);
                    }
                } else{
                    return Response::json(['status' => false, 'data_dokumen' => "Tidak terdapat Dokumen Pengajuan Kegiatan"], 200);
                }
            } elseif($type == "dokumentasi") {
                $dokumen = $kegiatan->dokumenKegiatan()->get();
                $image = $kegiatan->fotoKegiatan()->get();
                $keterangan = json_decode($kegiatan->keterangan_dokumentasi);
                if (count($dokumen) > 0 && count($image) > 0) {
                    return response()->json(['data' => $kegiatan,'dokumen' => $dokumen, 'image' => $image, 'keterangan_dokumentasi' => $keterangan , 'status' => true], 200);
                } else {
                    return response()->json(['data' => $kegiatan, 'dokumen' => 'Tidak Ada Laporan Kegiatan' , 'image' => 'Tidak Ada Foto Kegiatan', 'keterangan_dokumentasi' => $keterangan, 'status' => false], 200);
                }
                
            }
        }
    }

    //extra functions
    private function createDefaultDokumentasi($user_id, $username ,$namaKegiatan, $nilai_ppk, $kegiatan_berbasis, $tanggal_mulai, $tanggal_akhir){
        $inputDokumentasi['user_id'] = $user_id;
        $inputDokumentasi['nama_pj'] = $username;
        $inputDokumentasi['nama_kegiatan'] = $namaKegiatan;
        $inputDokumentasi['mulai_kegiatan'] = $tanggal_mulai;
        $inputDokumentasi['akhir_kegiatan'] = $tanggal_akhir;
        
        $keterangan_default [] = array(
            'no' => 1,
            'keterangan_opsional' => ''
        );
        $keterangan_default [] = array(
            'no' => 2,
            'keterangan_wajib_ulang' => ''
        );
        $inputDokumentasi['nilai_ppk'] = $nilai_ppk;
        $inputDokumentasi['kegiatan_berbasis'] = $kegiatan_berbasis;
        $statusDefault = StatusKegiatan::findOrFail(2);
        $keteranganDokumentasi = json_encode($keterangan_default);
        $inputDokumentasi['keterangan_dokumentasi'] = $keteranganDokumentasi;
        $inputDokumentasi['tipe_kegiatan'] = "Pengajuan";

        $dokumentasi = DokumentasiKegiatan::create($inputDokumentasi);
        if (!$dokumentasi) {
            return false;
        }
        $dokumentasi->StatusKegiatan()->save($statusDefault);
        return true;
    }

    private function updateKegiatan($dataKegiatan, $tipeKegiatan, $idKeterangan ,$keterangan, $placementKeterangan, $dataKeterangan){
        if ($tipeKegiatan == "Proposal") {
            if ($idKeterangan == 1) {
                $placementKeterangan->keterangan_opsional = $keterangan;
                $input['keterangan_json'] = json_encode($dataKeterangan);
            } elseif($idKeterangan == 2){
                $placementKeterangan->keterangan_wajib_ulang = $keterangan;
                $input['keterangan_json'] = json_encode($dataKeterangan);
            } elseif($idKeterangan == 3){
                $placementKeterangan->keterangan_wajib = $keterangan;
                $input['keterangan_json'] = json_encode($dataKeterangan);
            }
            $update = $dataKegiatan->update($input);
            if (!$update) {
                return false;
            }
            return true;
        } elseif($tipeKegiatan == "Laporan") {
            if ($idKeterangan == 1) {
                $placementKeterangan->keterangan_opsional = $keterangan;
                $input['keterangan_dokumentasi'] = json_encode($dataKeterangan);
            } elseif($idKeterangan == 2) {
                $placementKeterangan->keterangan_wajib_ulang = $keterangan;
                $input['keterangan_dokumentasi'] = json_encode($dataKeterangan);
            }
            $updateKegiatan = $dataKegiatan->update($input);
            if (!$updateKegiatan) {
                return response()->json(['errors' => ['Terdapat Error Ketika Melakukan Pembaruan Informasi Kegiatan, Silahkan Coba Kembali']], 422);
            }
            return true;
        }
    }

    private function statusKegiatan($kegiatan, $status , $type){
        if ($kegiatan == "Pengajuan" && $type == "Proposal Kegiatan") {
            if($status =="Belum Disetujui"){
                $btn_status = "<h6 class='text-center alert alert-info alert-heading font-weight-bolder'>".$status."</h6>";
            }
            elseif($status == "Sudah Disetujui"){
                $btn_status ="<h6 class='text-center alert alert-success alert-heading font-weight-bolder'>".$status."</h6>";
            }
            elseif($status == "Pengajuan Ulang"){
                $btn_status = "<h6 class='text-center alert alert-warning alert-heading font-weight-bolder'>Sedang ".$status."</h6>";
            }
            elseif($status == "Menolak"){
                $btn_status = "<h6 class='text-center alert alert-danger alert-heading font-weight-bolder'>".$status."</h6>";
            }
        } elseif($kegiatan == "Dokumentasi"){
            if ($status == "Unggah Dokumentasi") {
                if($type == "Pengajuan Historis"){
                    $btn_status = "<h6 class='text-center alert alert-warning alert-heading font-weight-bolder'>Belum ".$status."(".$type.")</h6>";
                } else {
                    $btn_status = "<h6 class='text-center alert alert-warning alert-heading font-weight-bolder'>Belum ".$status."</h6>";
                }
            } elseif($status == "Sudah Mengunggah Dokumentasi"){
                if($type == "Pengajuan Historis"){
                    $btn_status = "<h6 class='text-center alert alert-success alert-heading font-weight-bolder'>".$status."(".$type.")</h6>";
                } else {
                    $btn_status = "<h6 class='text-center alert alert-success alert-heading font-weight-bolder'>".$status."</h6>";
                }
            } elseif($status == "Belum Disetujui"){
                if($type == "Pengajuan Historis"){
                    $btn_status = "<h6 class='text-center alert alert-primary alert-heading font-weight-bolder'>".$status."(".$type.")</h6>";
                } else {
                    $btn_status = "<h6 class='text-center alert alert-primary alert-heading font-weight-bolder'>".$status."</h6>";
                }
            } elseif($status == "Pengajuan Ulang"){
                if($type == "Pengajuan Historis"){
                    $btn_status = "<h6 class='text-center alert alert-info alert-heading font-weight-bolder'>Belum ".$status."(".$type.")</h6>";
                } else {
                    $btn_status = "<h6 class='text-center alert alert-info alert-heading font-weight-bolder'>Belum ".$status."</h6>";
                }
            }
        }
        return $btn_status;
    }

    private function getDataPPK($dataPPK){
        $id_nilai_ppk = 1;
        $data_ppk = "";
        foreach ($dataPPK as $item_ppk) {
            if (count($dataPPK) == $id_nilai_ppk) {
                $data_ppk .=  $item_ppk->nilai_ppk;
            }
            else{
                $data_ppk .= $item_ppk->nilai_ppk.", ";
            }
            $id_nilai_ppk++;
        }
        return $data_ppk;
    }

    // private function updateStatusKegiatan($type, $dataKegiatan, $status, $statusSebelumnya){
    //     if ($type == 'Pengajuan') {
    //         # code...
    //     } elseif($type == 'Laporan'){
    //         # code...
    //     }
    //     return true;
    // }
}