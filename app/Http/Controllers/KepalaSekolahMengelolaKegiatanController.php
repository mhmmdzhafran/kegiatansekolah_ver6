<?php

namespace App\Http\Controllers;

use App\DokumentasiKegiatan;
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
        $pengajuan_all = PengajuanKegiatan::with('statusKegiatan')->select('pengajuan_kegiatans.*');
        if (request()->ajax()) {
            return datatables()->eloquent($pengajuan_all)->addColumn('statusKegiatan', function(PengajuanKegiatan $pengajuan){
                $status_pengajuan =  $pengajuan->statusKegiatan->pluck('nama')->implode('<br>');
                if($status_pengajuan =="Belum Disetujui"){
                    $status_indikator = "<h5 class='text-center alert alert-info alert-heading font-weight-bolder'>".$status_pengajuan."</h5>";
                }
                elseif($status_pengajuan == "Sudah Disetujui"){
                    $status_indikator ="<h5 class='text-center alert alert-success alert-heading font-weight-bolder'>".$status_pengajuan."</h5>";
                }
                elseif($status_pengajuan == "Pengajuan Ulang"){
                    $status_indikator = "<h5 class='text-center alert alert-warning alert-heading font-weight-bolder'>Sedang ".$status_pengajuan."</h5>";
                }
                elseif($status_pengajuan == "Menolak"){
                    $status_indikator = "<h5 class='text-center alert alert-danger alert-heading font-weight-bolder'>".$status_pengajuan."</h5>";
                }
                return $status_indikator;
            })->addColumn('data_pengajuan', function($data){
                foreach($data->statusKegiatan as $data_pengajuan){
                    if($data_pengajuan->pivot->status_kegiatanable_type == "App\PengajuanKegiatan"){
                        if ($data_pengajuan->pivot->status_kegiatan_id == 3 && $data_pengajuan->pivot->status_kegiatanable_id == $data->id) {
                            $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm data_pengajuan rounded-pill" value ="belum_disetujui">Lihat Detail</button>';
                        }
                        elseif ($data_pengajuan->pivot->status_kegiatan_id == 1 && $data_pengajuan->pivot->status_kegiatanable_id == $data->id) {
                            $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm data_pengajuan rounded-pill" value ="sudah_disetujui">Lihat Detail</button>';
                        }
                        elseif ($data_pengajuan->pivot->status_kegiatan_id == 5 && $data_pengajuan->pivot->status_kegiatanable_id == $data->id) {
                            $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm data_pengajuan rounded-pill" value ="menolak">Lihat Detail</button>';
                        }
                        elseif ($data_pengajuan->pivot->status_kegiatan_id == 4 && $data_pengajuan->pivot->status_kegiatanable_id == $data->id) {
                            $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-info btn-sm data_pengajuan rounded-pill" value ="pengajuan_ulang">Lihat Detail</button>';
                        }
                    }
                    return $aksi;
                }
            })->editColumn('nilai_ppk', function($data){
                $json_ppk = json_decode($data->nilai_ppk);
                $id_nilai_ppk = 1;
                $data_ppk = "";
                foreach ($json_ppk as $item_ppk) {
                    if (count($json_ppk) == $id_nilai_ppk) {
                        $data_ppk .=  $item_ppk->nilai_ppk;
                    }
                    else{
                        $data_ppk .= $item_ppk->nilai_ppk.", ";
                    }
                    $id_nilai_ppk++;
                }
                return $data_ppk;
            })->addColumn('user', function($data){
                $user = $data->user()->get();
                $userName = "";
                foreach ($user as $users_proposal) {
                    $userName = $users_proposal->name;
                }
                return $userName;
            })->rawColumns(['statusKegiatan', 'data_pengajuan', 'nilai_ppk', 'user'])->make(true);
        }

       return view('kepsek.kelola_kegiatan.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $status_kegiatan =  $data_pengajuan_kegiatan->statusKegiatan()->first();
            $dokumen = json_decode($data_pengajuan_kegiatan->dokumen_kegiatan);
            $nama_dokumen = "";
            foreach ($dokumen as $isi_data_dokumen) {
                $nama_dokumen = $isi_data_dokumen->nama_dokumen;
            }
            if ($dokumen) {
                if (file_exists(public_path('kegiatan/pengajuan_kegiatan/'.$nama_dokumen))) {
                    return Response::json(['data' => $data_pengajuan_kegiatan, 'status_kegiatan' => $status_kegiatan ,'status_dokumen' => true], 200);
                }
                return Response::json(['data' => $data_pengajuan_kegiatan, 'status_kegiatan' => $status_kegiatan ,'status_dokumen' => false], 200);
            }
            else{
                return Response::json(['data' => $data_pengajuan_kegiatan, 'status_kegiatan' => $status_kegiatan ,'status_dokumen' => false], 200);
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
        
        foreach($pengajuan_kegiatan->StatusKegiatan as $status){
            $status_kegiatan  = $status;
        }
        $data_user = $pengajuan_kegiatan->user->name;
        return view('kepsek.kelola_kegiatan.edit', compact('pengajuan_kegiatan', 'status_kegiatan', 'data_user', 'id'));
    }

    public function get_data_dan_dokumen_pengajuan($id){
        if (request()->ajax()) {
            try{
                $pengajuan_kegiatan = PengajuanKegiatan::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                return Response::json([
                    'messages' => 'Data Pengajuan Kegiatan Tidak Ditemukan, Silahkan Coba Kontak Admin untuk disesuaikan, ID yang diberikan: '.$id.", System Error Message: ". $e->getMessage()
                ], 404);
            } catch(\Throwable $th){
                return Response::json([
                    'messages' => $th->getMessage()
                ], 404);
            }
            $nama_dokumen = "";
            $dokumen_pengajuan = json_decode($pengajuan_kegiatan->dokumen_kegiatan);
            $keterangan_pengajuan = json_decode($pengajuan_kegiatan->keterangan_json);
            foreach ($dokumen_pengajuan as $isi_data_dokumen) {
                $nama_dokumen = $isi_data_dokumen->nama_dokumen;
            }
            if ($dokumen_pengajuan) {
                if (file_exists(public_path('kegiatan/pengajuan_kegiatan/'.$nama_dokumen))) {
                    return Response::json(['status_dokumen' => true, 'data_dokumen' => $dokumen_pengajuan , 'data' => $pengajuan_kegiatan, 'keterangan' => $keterangan_pengajuan], 200);
                } else {
                    return Response::json(['status_dokumen' => false, 'data_dokumen' => "Tidak terdapat Dokumen Pengajuan Kegiatan", 'data' => $pengajuan_kegiatan , 'keterangan' => $keterangan_pengajuan], 200);
                }
            }
            else{
                return Response::json(['status_dokumen' => false, 'data_dokumen' => "Tidak terdapat Dokumen Pengajuan Kegiatan"], 200);
            }
        }
    }

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
        $statusSebelumnya = 0;
        $input = $request->except('nama_user');
        foreach($pengajuan_kegiatan->StatusKegiatan as $status){
            $statusSebelumnya = $status->pivot->status_kegiatan_id;
        }
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
                foreach ($keterangan_decode as $key) {
                    if($key->no == 1){
                        $key->keterangan_opsional = $input['keterangan'];
                        $keteranganUpdate = json_encode($keterangan_decode);
                        $input['keterangan_json'] = $keteranganUpdate;
                        $update = $pengajuan_kegiatan->update($input);
                        if($update){
                            $dokumentasi = $this->createDefaultDokumentasi($user_id,$pengajuan_kegiatan->PJ_nama_kegiatan, $pengajuan_kegiatan->nilai_ppk, $pengajuan_kegiatan->kegiatan_berbasis, $tanggal_mulai, $tanggal_akhir);
                            if (!$dokumentasi) {
                                // restore before
                                $key->keterangan_opsional = "";
                                $keterangan_restore = json_encode($keterangan_decode);
                                $input['keterangan_json'] = $keterangan_restore;
                                $pengajuan_kegiatan->update($input);
                                return Response::json(['errors' => ['Tidak dapat membuat data Dokumentasi Kegiatan, silahkan dicoba kembali']], 422);
                            }
                            $statusSukses = StatusKegiatan::findOrFail(1);
                            event(new KeputusanProposalKegiatanToPJEvent($pengajuan_kegiatan->user()->first(), $pengajuan_kegiatan, $statusSukses));
                            $pengajuan_kegiatan->StatusKegiatan()->updateExistingPivot($statusSebelumnya, [
                                'status_kegiatan_id' => $statusSukses->id
                            ]);
                            return Response::json(['data' => 'data is valid', 'status_data'=>'Pengajuan Kegiatan Berhasil diterima!'], 200);
                            
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
            //Pengajuan Ulang
            case 2:
                $keterangan = $pengajuan_kegiatan->keterangan_json;
                $keterangan_decode = json_decode($keterangan);
                foreach ($keterangan_decode as $key) {
                    if ($key->no == 1) {
                        continue;
                    }
                    elseif($key->no == 2){
                        $key->keterangan_wajib_ulang = $input['keterangan'];
                        $keteranganUpdate = json_encode($keterangan_decode);
                        $input['keterangan_json'] = $keteranganUpdate;
                        $statusSukses = StatusKegiatan::findOrFail(4);

                        $update = $pengajuan_kegiatan->update($input);
                        if($update){
                            event(new KeputusanProposalKegiatanToPJEvent($pengajuan_kegiatan->user()->first(), $pengajuan_kegiatan, $statusSukses));
                            $pengajuan_kegiatan->StatusKegiatan()->updateExistingPivot($statusSebelumnya, [
                                'status_kegiatan_id' => $statusSukses->id
                            ]);
                            return Response::json(['data' => 'data is valid', 'status_data' => 'Kegiatan Yang Diajukan Telah Diajukan Ulang beserta Keterangan Dari Kepala Sekolah'], 200);
                        }
                        else{
                            return Response::json(['errors' => ['Tidak dapat melakukan proses, silahkan coba lagi']], 422);
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
                        $key->keterangan_wajib = $input['keterangan'];
                        $keteranganUpdate = json_encode($keterangan_decode);
                        $input['keterangan_json'] = $keteranganUpdate;
                        $statusSukses = StatusKegiatan::findOrFail(5);
                        $update = $pengajuan_kegiatan->update($input);
                        if($update){
                            event(new KeputusanProposalKegiatanToPJEvent($pengajuan_kegiatan->user()->first(), $pengajuan_kegiatan, $statusSukses));
                            $pengajuan_kegiatan->StatusKegiatan()->updateExistingPivot($statusSebelumnya, [
                                'status_kegiatan_id' => $statusSukses->id
                            ]);                            
                            return Response::json(['data' => 'data is valid', 'status_data' => 'Kegiatan Yang Diajukan Telah Ditolak'], 200);
                        }
                        else{
                            return Response::json(['errors' => ['Tidak dapat melakukan proses, silahkan coba lagi']], 422);
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

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * KHUSUS FUNCTION DOKUMENTASI
     */

    public function indexDokumentasi(){
        $dokumentasi_all = DokumentasiKegiatan::with('statusKegiatan')->select('dokumentasi_kegiatans.*');
         if (request()->ajax()) {
            return datatables()->eloquent($dokumentasi_all)->addColumn('statusKegiatan', function(DokumentasiKegiatan $dokumentasi){
                $status_indikator = $dokumentasi->statusKegiatan->pluck('nama')->implode('<br>');
                if ($status_indikator == "Unggah Dokumentasi") {
                    $status = "<h5 class='text-center alert alert-warning alert-heading font-weight-bolder'>".$status_indikator."</h5>";
                }
                elseif($status_indikator == "Sudah Mengunggah Dokumentasi"){
                    $status = "<h5 class='text-center alert alert-success alert-heading font-weight-bolder'>".$status_indikator."</h5>";
                }
                return $status;
             })->addColumn('unggah_dokumentasi', function($data){
                foreach ($data->statusKegiatan as $item) {
                    if ($item->pivot->status_kegiatanable_type == "App\DokumentasiKegiatan") {
                        if ($item->pivot->status_kegiatan_id == 2) {
                            $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-info btn-sm rounded-pill status_pengajuan" value ="unggah_dokumentasi">Lihat Detail</button>';
                        } elseif($item->pivot->status_kegiatan_id == 6) {
                            $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm rounded-pill status_pengajuan" value ="sudah_unggah">Lihat Detail</button>';
                        }
                        return $button;   
                    }
                }
             })->editColumn('nilai_ppk', function($data){
                $json_decode_nilai_ppk = json_decode($data->nilai_ppk);
                $nilai_ppk_kegiatan = "";
                $id_nilai_ppk = 1;
                foreach ($json_decode_nilai_ppk as $item_ppk) {
                    if (count($json_decode_nilai_ppk) == $id_nilai_ppk) {
                        $nilai_ppk_kegiatan .= $item_ppk->nilai_ppk;
                    }
                    else{
                        $nilai_ppk_kegiatan .= $item_ppk->nilai_ppk." , ";
                    }
                    $id_nilai_ppk++;
                }
                return $nilai_ppk_kegiatan;
             })->addColumn('user', function($data){
                 $user_data = $data->user()->get();
                 $nama_user = "";
                 foreach ($user_data as $userInfo) {
                     $nama_user = $userInfo->name;
                 }
                 return $nama_user;
             })->rawColumns(['statusKegiatan', 'unggah_dokumentasi' , 'nilai_ppk', 'user'])->make(true);
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
            $status_kegiatan_dokumentasi = $dokumentasi_kegiatan->statusKegiatan()->first();
            $dokumen = $dokumentasi_kegiatan->dokumenKegiatan()->get();
            $user_name = $dokumentasi_kegiatan->user->name;
            if (count($dokumen) > 0) {
                return Response::json(['dokumen_dokumentasi' => $dokumen, 'status_kegiatan' => $status_kegiatan_dokumentasi , 'data_dokumentasi' => $dokumentasi_kegiatan, 'user' => $user_name], 200);
            }
            else{
                return Response::json(['status_kegiatan' => $status_kegiatan_dokumentasi, 'data_dokumentasi' => $dokumentasi_kegiatan , 'user' => $user_name], 200);
            }
        }
    }   
    // public function editDokumentasi($id){
    //     //code here..
    //     //For acc sukses, pengajuan ulang => belum disetujui

    //     $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
    //     $dokumen = $dokumentasi_kegiatan->dokumenKegiatan()->get();
        
    //     foreach ($dokumentasi_kegiatan->statusKegiatan as $status) {
    //         $data_pengajuan_kegiatan = $dokumentasi_kegiatan->nilai_ppk_kegiatan_berbasis_json;
    //         $nilai_kegiatan_berbasis = json_decode($data_pengajuan_kegiatan);
    //         $status_dokumentasi = $status;
    //         $keterangan_dokumentasi = json_decode($dokumentasi_kegiatan->keterangan_dokumentasi);
    //     }
    //     // $dokumen = json_decode($dokumentasi_kegiatan->dokumentasi_kegiatan_ppk);
    //     return view('kepsek.pengajuan_dokumentasi_kegiatan.edit', compact('dokumen','status_dokumentasi', 'nilai_kegiatan_berbasis', 'dokumentasi_kegiatan', 'keterangan_dokumentasi'));
        
    // }

    // public function updateDokumentasi(KepalaSekolahKegiatanValidatorRequest $request, $id){
    //     //for saving sukses dan pengajuan ulang
    //     //jangan lupa sekalian bikin folder dokumentasi

    //     $dokumentasiKegiatan = DokumentasiKegiatan::findOrFail($id);
    //     $input = $request->all();
    //     foreach ($dokumentasiKegiatan->statusKegiatan as $status) {
    //         $statusSebelumnya = $status->pivot->status_kegiatan_id;
    //     }
    //     $statusSukses = StatusKegiatan::findOrFail(1);
    //     switch ($input['id_keterangan']) {
    //         case 1:
    //             $keterangan_dokumentasi = json_decode($dokumentasiKegiatan->keterangan_dokumentasi);
    //             foreach ($keterangan_dokumentasi as $keterangan) {
    //                 if ($keterangan->no == 1) {
    //                     $keterangan->keterangan_opsional = $input['keterangan'];
    //                     $input['keterangan_dokumentasi'] = json_encode($keterangan_dokumentasi);                        
    //                     $update = $dokumentasiKegiatan->update($input);
    //                     if ($update) {
    //                         $nama_dokumentasi = "[DOK]".$dokumentasiKegiatan->mulai_kegiatan."_".$dokumentasiKegiatan->akhir_kegiatan."_".$dokumentasiKegiatan->nama_kegiatan;
    //                         $pembuatan_folder = FolderDokumentasi::create([
    //                             "nama_folder_dokumentasi" => $nama_dokumentasi
    //                         ]);
    //                         if ($pembuatan_folder) {

    //                             $searchFolder = FolderDokumentasi::all();
    //                             foreach ($searchFolder as $ambil_folder) {
    //                                 $search = $ambil_folder->where('nama_folder_dokumentasi', $nama_dokumentasi)->get();
    //                                 if ($search) {
    //                                     foreach ($search as $id_folder) {
    //                                         $folder_dokumentasi_id = $id_folder->id;
    //                                         $input['folder_dokumentasi_id'] = $folder_dokumentasi_id;
    //                                     }
    //                                 } else {
    //                                     //kalo gaada searchnya batal pembuatan folder sama update dokumentasi kegiatan terkait keterangan
    //                                     $ambil_folder->where('nama_folder_dokumentasi', $nama_dokumentasi)->delete();

    //                                     $keterangan->keterangan_opsional = '';
    //                                     $input['keterangan_dokumentasi'] = json_encode($keterangan_dokumentasi);

    //                                     $dokumentasiKegiatan->update($input);

    //                                     Session::flash('warning', 'Folder Dokumentasi yang dibuat sistem tidak berhasil dibentuk, silahkan dicoba kembali');
    //                                     return redirect()->back();
    //                                 }
    //                             }
    //                             $update_folder_id = $dokumentasiKegiatan->update($input);
    //                             if ($update_folder_id) {
    //                                 $dokumentasiKegiatan->statusKegiatan()->updateExistingPivot($statusSebelumnya, [
    //                                     'status_kegiatan_id' => $statusSukses->id
    //                                 ]);
    //                                 Session::flash('sukses', 'Dokumentasi Sukses Diterima dan dapat dilihat dalam laman Dokumentasi Kegiatan!');
    //                                 return redirect('/kepala-sekolah/mengelola-kegiatan/dokumentasi-kegiatan');
    //                             }
    //                             else{
    //                                 //set folder_dokumentasi_id to null
    //                                 //delete folder with the same name
    //                                 //revert keterangan menjadi yang terdahulu

    //                                 foreach ($searchFolder as $ambil_folder) {
    //                                     $ambil_folder->where('nama_folder_dokumentasi', $nama_dokumentasi)->delete();
    //                                 }
    //                                 $input['folder_dokumentasi_id'] = null;
    //                                 $keterangan->keterangan_opsional = '';
    //                                 $input['keterangan_dokumentasi'] = json_encode($keterangan->keterangan_opsional);
    //                                 $dokumentasiKegiatan->update($input);
    //                                 Session::flash('warning', 'Sistem Gagal Menyimpan Keputusan Dokumentasi Yang Dibuat, Silahkan Mencoba Ulang Kembali');
    //                                 return redirect()->back();
    //                             }
    //                         }
    //                         else{
    //                             //revert back to original
    //                             $keterangan->keterangan_opsional = '';
    //                             $input['keterangan_dokumentasi'] = json_encode($keterangan->keterangan_opsional);
    //                             $update = $dokumentasiKegiatan->update($input);
    //                             Session::flash('warning', 'Sistem Gagal Membuat Folder Dokumentasi, Silahkan mencoba Persetujuan Dokumentasi Kembali');
    //                             return redirect()->back();
    //                         } 
    //                     } else {
    //                         Session::flash('gagal', 'Tidak dapat memproses data, silahkan coba ulang kembali');
    //                         return redirect()->back();
    //                     }       
    //                 }
    //             }
    //             break;
    //         case 2:
    //             $keterangan_dokumentasi = json_decode($dokumentasiKegiatan->keterangan_dokumentasi);
    //             foreach ($keterangan_dokumentasi as $keterangan) {
    //                 if ($keterangan->no == 1) {
    //                     continue;
    //                 }
    //                 elseif($keterangan->no == 2){
    //                     $keterangan->keterangan_wajib_ulang = $input['keterangan_wajib_ulang'];
    //                     $input['keterangan_dokumentasi'] = json_encode($keterangan_dokumentasi);
    //                     $statusUlang = StatusKegiatan::findOrFail(4);
    //                     $update = $dokumentasiKegiatan->update($input);
    //                     if ($update) {
    //                         $dokumentasiKegiatan->statusKegiatan()->updateExistingPivot($statusSebelumnya, [
    //                             'status_kegiatan_id' => $statusUlang->id
    //                         ]);
    //                         Session::flash('sukses_ulang', 'Dokumentasi Sukses Diajukan Ulang Kepada Penanggung Jawab');
    //                         return redirect('/kepala-sekolah/mengelola-kegiatan/dokumentasi-kegiatan');
    //                     }
    //                     else{
    //                         Session::flash('gagal', 'Tidak dapat memproses data, silahkan coba ulang kembali');
    //                         return redirect()->back();
    //                     }
    //                 }
    //             }
    //             break;
    //         default:
    //             return redirect(404);
    //             break;
    //     }
    // }

    //extra functions
    protected function createDefaultDokumentasi($user_id,$namaKegiatan, $nilai_ppk, $kegiatan_berbasis, $tanggal_mulai, $tanggal_akhir){
        $inputDokumentasi['user_id'] = $user_id;
        $inputDokumentasi['nama_kegiatan'] = $namaKegiatan;
        // $inputDokumentasi['dokumentasi_kegiatan_ppk'] = null;
        $inputDokumentasi['mulai_kegiatan'] = $tanggal_mulai;
        $inputDokumentasi['akhir_kegiatan'] = $tanggal_akhir;
        // return $inputDokumentasi;
        
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

        $dokumentasi = DokumentasiKegiatan::create($inputDokumentasi);
        if (!$dokumentasi) {
            return false;
        }
        $dokumentasi->StatusKegiatan()->save($statusDefault);
        return true;
    }
}
