<?php

namespace App\Http\Controllers;

use App\DokumenKegiatan;
use App\DokumentasiKegiatan;
use App\Events\AjukanProposalKegiatanToKepalaSekolahEvent;
use App\Events\UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent;
use App\Http\Requests\PengajuanDokumentasiBaruRequest;
use App\Http\Requests\PengajuanDokumentasiKegiatanRequest;
use App\Http\Requests\PengajuanKegiatanUlangValidationRequest;
use App\Http\Requests\PengajuanKegiatanValidationRequest;
use App\Http\Requests\uploadDokumenDokumentasiBaruValidationRequest;
use App\Http\Requests\uploadEditedDokumenDokumentasiValidationRequest;
use App\PengajuanKegiatan;
use App\StatusKegiatan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PJMengelolaKegiatanController extends Controller
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
        $user_id = Auth::user()->id;
        $pengajuan_kegiatan = PengajuanKegiatan::with('statusKegiatan')->select('pengajuan_kegiatans.*')->where("user_id" , "=" , $user_id);        
        if (request()->ajax()) {        
            return datatables()->eloquent($pengajuan_kegiatan)->addColumn('statusKegiatan', function(PengajuanKegiatan $post){
                $status = $post->StatusKegiatan->pluck('nama')->implode('<br>');
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
                return $status_indikator;
            })
            ->addColumn('pengajuan', function($data){
                foreach ($data->StatusKegiatan as $status) {
                    if ($status->pivot->status_kegiatanable_type == "App\PengajuanKegiatan") {
                      if ($status->pivot->status_kegiatanable_id == $data->id && $status->pivot->status_kegiatan_id == 3) {
                        $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm status_pengajuan rounded-pill" value ="belum_disetujui">Lihat Detail</button>';
                      } elseif($status->pivot->status_kegiatanable_id == $data->id && $status->pivot->status_kegiatan_id == 4) {
                        $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-danger btn-sm status_pengajuan rounded-pill" value ="pengajuan_ulang">Lakukan Pengajuan Ulang</button>';
                      }
                      elseif($status->pivot->status_kegiatanable_id == $data->id && $status->pivot->status_kegiatan_id == 1){
                        $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm status_pengajuan rounded-pill" value ="sudah_disetujui">Lihat Detail</button>';
                      }
                      elseif($status->pivot->status_kegiatanable_id == $data->id && $status->pivot->status_kegiatan_id == 5){
                        $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm status_pengajuan rounded-pill" value ="menolak">Lihat Detail</button>';
                      }
                      return $aksi;    
                    } 
                }
            })->editColumn('nilai_ppk', function($data){
                $data_ppk = "";
                $count_ppk = 1;
                $nilai_ppk_kegiatan = json_decode($data->nilai_ppk);
                foreach ($nilai_ppk_kegiatan as $item_ppk) {
                    if (count($nilai_ppk_kegiatan) == $count_ppk) {
                        $data_ppk.= $item_ppk->nilai_ppk;
                    } else {
                        $data_ppk .= $item_ppk->nilai_ppk.", ";
                    }
                    $count_ppk++;
                }
                return $data_ppk;
            })->editColumn('updated_at' , function($data){
                return $data->updated_at->timezone('Asia/Jakarta')->toDateTimeString();
            })
            ->rawColumns(['pengajuan', 'statusKegiatan'])->make(true);
        }
        // $nilai_ppk_kegiatan = false;
        return view('pj.kelola_kegiatan.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $currentTime = Carbon::now();
        
        // return view('pj.kelola_kegiatan.create', compact('currentTime'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengajuanKegiatanValidationRequest $request)
    {
        //
        $id_nilai_ppk = 1;
        $dateMulai = Carbon::parse($request->mulai_kegiatan);
        $dateAkhir = Carbon::parse($request->akhir_kegiatan);
        if($dateAkhir < $dateMulai){
            return Response::json(['errors' => ['Tanggal Akhir Kegiatan Lampau Dibandingkan Tanggal Mulai Kegiatan, Silahkan Masukkan Kembali']], 422);
        }
        else{
            $input = $request->only([
                'PJ_nama_kegiatan',
                'nilai_ppk',
                'kegiatan_berbasis',
                'dokumen_kegiatan',
                'mulai_kegiatan',
                'akhir_kegiatan'
            ]);                
            $file =  $request->file('dokumen_kegiatan');
                $name = $file->getClientOriginalName();
                $json_dokumen_kegiatan[] = array(
                        "dokumen_id" => 1,
                        "nama_dokumen" => $request->mulai_kegiatan."_Pengajuan-".$input['PJ_nama_kegiatan']."-".$name
                );
                $nama_dokumen_baru = $request->mulai_kegiatan."_Pengajuan-".$input['PJ_nama_kegiatan']."-".$name;
                $input['dokumen_kegiatan'] = json_encode($json_dokumen_kegiatan);
                $masuk_file = $file->move('kegiatan/pengajuan_kegiatan/',$nama_dokumen_baru);
                    if($masuk_file){
                        for ($i=0; $i < count($request->nilai_ppk) ; $i++) { 
                            $json_ppk [] = array(
                                "no" => $id_nilai_ppk,
                                "nilai_ppk" => $request->nilai_ppk[$i]
                            );
                            $id_nilai_ppk++;
                        }
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
                        $input['nilai_ppk'] = json_encode($json_ppk);
                        $keterangan = json_encode($keterangan_default);
                        $user_id = Auth::user()->id;
                        $input['user_id'] = $user_id;
                        $input['keterangan_json'] = $keterangan;
                        $statusDefault = StatusKegiatan::findOrFail(3);
                        $kegiatan = PengajuanKegiatan::create($input);
                        if (!$kegiatan) {
                            //unlink dokumen
                            unlink(public_path('kegiatan/pengajuan_kegiatan/'.$nama_dokumen_baru));
                            return Response::json(['errors' => ['Tidak dapat membentuk data Pengajuan Kegiatan, Silahkan coba kembali']], 422);
                        }
                        event(new AjukanProposalKegiatanToKepalaSekolahEvent($kegiatan, $statusDefault));
                        $kegiatan->StatusKegiatan()->save($statusDefault);
                        return Response::json(['data' => 'data is valid'], 200);
                    }
                    else{
                        return Response::json(['errors' => ['Sistem gagal menyimpan File Dokumen, Silahkan Coba Lagi']], 422);
                    }   
        }
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
                $pengajuan_kegiatan = PengajuanKegiatan::findOrFail($id);
            } catch(ModelNotFoundException $e){
                return Response::json(['messages' => 'Data Pengajuan Kegiatan tidak dapat ditemukan, Silahkan coba refresh dan Kontak Admin! id yang diberikan:'.$id.' System Error Code: '.$e->getMessage() ], 404);
            } catch(\Throwable $th){
                return Response::json(['messages' => $th->getMessage()], 404);
            }
            $status_proposal = $pengajuan_kegiatan->statusKegiatan()->first();
            $dokumen = json_decode($pengajuan_kegiatan->dokumen_kegiatan);
            foreach ($dokumen as $item) {
                if (file_exists(public_path('kegiatan/pengajuan_kegiatan/'.$item->nama_dokumen))) {
                    return Response::json(['data' => $pengajuan_kegiatan, 'status_dokumen' => true , 'status_proposal' => $status_proposal ], 200);   
                } else {
                    return Response::json(['data' => $pengajuan_kegiatan, 'status_dokumen' => false , 'status_proposal' => $status_proposal], 200);      
                }
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
        //for pengajuan ulang
        if (request()->ajax()) {
            try{
                $pengajuan_kegiatan = PengajuanKegiatan::findOrFail($id);
            } catch(ModelNotFoundException $e){
                return Response::json(['messages' => 'Data Pengajuan Kegiatan tidak dapat ditemukan, Silahkan coba refresh dan Kontak Admin! id yang diberikan:'.$id.' System Error Code: '.$e->getMessage() ], 404);
            } catch(\Throwable $th){
                return Response::json(['messages' => $th->getMessage()], 404);
            }
            $dokumen = json_decode($pengajuan_kegiatan->dokumen_kegiatan);
            foreach ($dokumen as $item) {
                if (file_exists(public_path('kegiatan/pengajuan_kegiatan/'.$item->nama_dokumen))) {
                    return Response::json(['data' => $pengajuan_kegiatan, 'status_dokumen' => true], 200);   
                } else {
                    return Response::json(['data' => $pengajuan_kegiatan, 'status_dokumen' => false], 200);      
                }
            }
        }
        // foreach ($pengajuan_kegiatan->StatusKegiatan as $status_kegiatan) {
        //     $status = $status_kegiatan->nama;
        // }
        // if (is_null($pengajuan_kegiatan->dokumen_kegiatan)) {
        //     $dokumen_kegiatan = false;
        //     return view('pj.kelola_kegiatan.edit', compact('dokumen_kegiatan','pengajuan_kegiatan', 'status', 'keterangan_pengajuan'));    
        // }
        // else{
        //     //jika dokumen ada => not tested
        //     $dokumen_kegiatan = json_decode($pengajuan_kegiatan->dokumen_kegiatan);
        //     $keterangan_pengajuan = json_decode($pengajuan_kegiatan->keterangan_json);
        //     return view('pj.kelola_kegiatan.edit', compact('pengajuan_kegiatan', 'status', 'dokumen_kegiatan' , 'keterangan_pengajuan'));    
        // }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PengajuanKegiatanUlangValidationRequest $request, $id)
    {
        //
        //for pengajuan ulang
        try{
            $pengajuan_ulang = PengajuanKegiatan::findOrFail($id);
        } catch(ModelNotFoundException $e){
            return Response::json(['messages' => 'Data Pengajuan Kegiatan tidak dapat ditemukan, Silahkan Coba kembali dan kontak Admin! ID yang diberikan: '.$id." System error message: ".$e->getMessage() ], 404);
        } catch(\Throwable $th){
            return Response::json(['messages' => $th->getMessage()], 404);
        }

        $id_nilai_ppk = 1;        
        $dateMulai = Carbon::parse($request->mulai_kegiatan);
        $dateAkhir = Carbon::parse($request->akhir_kegiatan);
        foreach ($pengajuan_ulang->StatusKegiatan as $status) {
            $statusSebelumnya = $status->pivot->status_kegiatan_id;
        }
        if($dateAkhir < $dateMulai){
            return response()->json(['errors' => ['Tanggal Akhir Kegiatan Lampau Dibandingkan Tanggal Mulai Kegiatan, Silahkan Masukkan Kembali']], 422);
        }
        else{
            $input = $request->only([
                'PJ_nama_kegiatan',
                'nilai_ppk',
                'kegiatan_berbasis',
                'dokumen_kegiatan',
                'mulai_kegiatan',
                'akhir_kegiatan'
            ]);   
                $dokumen_lama = json_decode($pengajuan_ulang->dokumen_kegiatan);
                foreach($dokumen_lama as $file_terdahulu){
                    $file_lama = $file_terdahulu->nama_dokumen;
                };
                $file = $request->file('dokumen_kegiatan');
                $name = $file->getClientOriginalName();
                
                $json_dokumen_kegiatan[] = array(
                    "dokumen_id" => 1,
                    "nama_dokumen" => $request->mulai_kegiatan."_Pengajuan_Kegiatan_Ulang-".$input['PJ_nama_kegiatan']."-".$name
                );
                for ($i=0; $i <count($request->nilai_ppk) ; $i++) { 
                    $json_ppk [] = array(
                        "no" => $id_nilai_ppk,
                        "nilai_ppk" => $request->nilai_ppk[$i]
                    );
                    $id_nilai_ppk++;
                }
                $input['dokumen_kegiatan'] = json_encode($json_dokumen_kegiatan);
                $input['user_id'] = Auth::user()->id;
                $input['nilai_ppk'] = json_encode($json_ppk);
                $status_ulang = StatusKegiatan::findOrFail(3);
                $update_pengajuan = $pengajuan_ulang->update($input);
                if ($update_pengajuan) {
                    //update menjadi file baru dan taro di directory
                    $nama_dokumen_ulang = $request->mulai_kegiatan."_Pengajuan_Kegiatan_Ulang-".$input['PJ_nama_kegiatan']."-".$name;
                    $file->move('kegiatan/pengajuan_kegiatan/',$nama_dokumen_ulang);
                    //unlink file dokumen yang kemaren dikirim
                    unlink(public_path('kegiatan/pengajuan_kegiatan/'.$file_lama));
                    //update pivot and fire event
                    event(new AjukanProposalKegiatanToKepalaSekolahEvent($pengajuan_ulang, $status_ulang));
                    $pengajuan_ulang->StatusKegiatan()->updateExistingPivot($statusSebelumnya, [
                        'status_kegiatan_id' => $status_ulang->id
                    ]);
                    return response()->json(['data' => 'data is valid'], 200);
                }
                else{
                    return response()->json(['data' => 'data is not valid', 'errors' => ['Tidak dapat memproses data, silahkan mencoba lagi']], 422);
                }
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
     * //Khusus Fungsionalitas Unggah Dokumentasi
     */

    public function indexDokumentasi(){

        $user_id = Auth::user()->id;
        $dokumentasi_kegiatan = DokumentasiKegiatan::with('statusKegiatan')->select('dokumentasi_kegiatans.*')->where('user_id' , '=' , $user_id);     
        if (request()->ajax()) {
            return datatables()->eloquent($dokumentasi_kegiatan)->addColumn('statusKegiatan', function(DokumentasiKegiatan $dokumentasi_kegiatan){
                $status =  $dokumentasi_kegiatan->statusKegiatan->pluck('nama')->implode('<br>');
                if ($status == "Unggah Dokumentasi") {
                    $status_indikator = "<h6 class='text-center alert alert-warning font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
                }
                elseif($status == "Sudah Mengunggah Dokumentasi"){
                    $status_indikator = "<h6 class='text-center alert alert-success font-weight-bolder' style='border-radius:10px;'>".$status."</h6>";
                }
                return $status_indikator;
            })->addColumn('unggah_dokumentasi', function($data){
                foreach ($data->statusKegiatan as $status) {
                    if ($status->pivot->status_kegiatanable_type == "App\DokumentasiKegiatan") {
                        if ($status->pivot->status_kegiatanable_id == $data->id && $status->pivot->status_kegiatan_id == 6) {
                            $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm status_pengajuan rounded-pill" value ="sudah_unggah">Lihat Detail</button>';
                        }
                        elseif ($status->pivot->status_kegiatanable_id == $data->id && $status->pivot->status_kegiatan_id == 2) {
                            // if ($data->akhir_kegiatan >= Carbon::now()) {
                            //     $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-danger btn-sm status_pengajuan rounded-pill" value ="unggah_dokumentasi" data-target="'.$data->akhir_kegiatan.'" data-target2="'. Carbon::now() .'">Lihat Detail</button>';
                            // } elseif($data->akhir_kegiatan < Carbon::now()) {
                            //     $newDateAkhir = Carbon::parse($data->akhir_kegiatan);
                            //     $dateDiff = $newDateAkhir->diffInDays(Carbon::now());
                            //     $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-danger btn-sm status_pengajuan rounded-pill" value ="unggah_dokumentasi" data-target="'.$data->akhir_kegiatan.'" data-target2="'. Carbon::now() .'" data-target3="'.$dateDiff.'">Lihat Detail</button>';
                            // }
                            $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-danger btn-sm status_pengajuan rounded-pill" value ="unggah_dokumentasi">Lihat Detail</button>';
                        }
                        return $button;
                    }
                }
            })->editColumn('nilai_ppk', function($data){
                $data_nilai = json_decode($data->nilai_ppk);
                $id_nilai_ppk = 1;
                $data_nilai_ppk = "";
                foreach ($data_nilai as $item_ppk) {
                    if ($id_nilai_ppk == count($data_nilai)) {
                        $data_nilai_ppk .= $item_ppk->nilai_ppk;
                    }
                    else{
                        $data_nilai_ppk .= $item_ppk->nilai_ppk." , ";
                    }
                    $id_nilai_ppk++;
                }
                return $data_nilai_ppk; 
            })->editColumn('updated_at' , function($data){
                return $data->updated_at->timezone('Asia/Jakarta')->toDateTimeString();
            })
            ->rawColumns(['statusKegiatan', 'unggah_dokumentasi'])->make(true);
        }   
            return view('pj.dokumentasi_kegiatan.index');
    }


    public function editDokumentasi($id){
        //show dokumentasi => dengan status unggah dokumentasi}
        if (request()->ajax()) {
            try{
                $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
            } catch(ModelNotFoundException $e){
                return Response::json(['messages' => 'Data Dokumentasi tidak ditemukan, Silahkan kontak Admin!, id yang diberikan:'.$id." System error code: ".$e->getMessage()], 404);
            } catch(\Throwable $th){
                return Response::json(['messages' => $th->getMessage() ], 404);
            }    
            foreach($dokumentasi_kegiatan->statusKegiatan as $status_dokumentasi){
                $status = $status_dokumentasi;
            }
            $nilai_ppk_kegiatan = json_decode($dokumentasi_kegiatan->nilai_ppk);
            return Response::json(['status_dokumentasi' => $status, 'nilai_ppk_kegiatan' => $nilai_ppk_kegiatan, 'data_dokumentasi' => $dokumentasi_kegiatan], 200);
        }
    }

    // public function editDokumentasiUlang($id){
    //     //show dokumentasi => dengan status pengajuan ulang
    //     $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
    //     foreach ($dokumentasi_kegiatan->statusKegiatan as $status_dokumentasi) {
    //         $status_ulang = $status_dokumentasi;
    //     }
    //     $nilai_ppk_kegiatan_berbasis =  json_decode($dokumentasi_kegiatan->nilai_ppk_kegiatan_berbasis_json);
    //     $keterangan_dokumentasi_ulang = json_decode($dokumentasi_kegiatan->keterangan_dokumentasi);
    //     if(is_null($dokumentasi_kegiatan->dokumentasi_kegiatan_ppk)){
    //         $dokumen_kegiatan = false;
    //         return view('pj.dokumentasi_kegiatan.edit_ulang', compact('dokumen_kegiatan','dokumentasi_kegiatan', 'status', 'nilai_ppk_kegiatan_berbasis', 'keterangan_dokumentasi_ulang'));
    //     }
    //     else{
    //         $dokumen_kegiatan = $dokumentasi_kegiatan->dokumenKegiatan()->get();
    //         return view('pj.dokumentasi_kegiatan.edit_ulang', compact('dokumen_kegiatan','dokumentasi_kegiatan', 'status', 'nilai_ppk_kegiatan_berbasis', 'keterangan_dokumentasi_ulang'));
            
    //     }
    // }

    public function showDokumentasi($id){
        //show dokumentasi => ketika dokumentasi sudah diunggah
        if (request()->ajax()) {
            try{
                $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
            } catch(ModelNotFoundException $e){
                return Response::json(['messages' => 'Data Dokumentasi tidak ditemukan, Silahkan kontak Admin!, id yang diberikan:'.$id." System error code: ".$e->getMessage()], 404);
            } catch(\Throwable $th){
                return Response::json(['messages' => $th->getMessage() ], 404);
            }
            $nilai_ppk_kegiatan = json_decode($dokumentasi_kegiatan->nilai_ppk);
            $dokumen = $dokumentasi_kegiatan->dokumenKegiatan()->where("status_unggah_dokumen" , "=" , "Pengajuan")->get();
            $dokumen_baru = $dokumentasi_kegiatan->dokumenKegiatan()->where("status_unggah_dokumen" , "=" , "Dokumentasi")->get();
            // $file_dokumen = [];
            // foreach ($dokumen as $item) {
            //     if ($item->status_unggah_dokumen == "Pengajuan") {
            //         $file_dokumen[] = $item->nama_dokumen;
            //     }
            // }
            foreach($dokumentasi_kegiatan->statusKegiatan as $status){
                $status_kegiatan  = $status->pivot->status_kegiatan_id;
            }
            if (count($dokumen_baru) > 0) {
                return Response::json(['status' => $status_kegiatan, 'dokumen' => $dokumen, 'dokumentasi_baru' => $dokumen_baru, 'nilai_ppk_kegiatan' => $nilai_ppk_kegiatan, 'dokumentasi_kegiatan' => $dokumentasi_kegiatan], 200);
            } else{
                return Response::json(['status' => $status_kegiatan, 'dokumen' => $dokumen, 'nilai_ppk_kegiatan' => $nilai_ppk_kegiatan, 'dokumentasi_kegiatan' => $dokumentasi_kegiatan, 'dokumentasi_baru' => $dokumen_baru], 200);   
            }
        }

    }

    public function uploadDokumentasiBaru(PengajuanDokumentasiBaruRequest $request){
        $dateMulai = Carbon::parse($request->mulai_kegiatan);
        $dateAkhir = Carbon::parse($request->akhir_kegiatan);
        $kumpulan_dokumen = [];
        
        $file = $request->file('dokumentasi_kegiatan_ppk');
        if (is_null($file)) {
            return Response::json(['errors' => ['File Tidak Diunggah, Silahkan Unggah Dokumentasi Kegiatan dengan ekstensi .pdf']], 422);
        }
        if ($dateAkhir < $dateMulai) {
            return Response::json(['errors' => ['Tanggal Akhir Kegiatan Lampau Dibandingkan Tanggal Mulai Kegiatan, Silahkan Masukkan Kembali']], 422);
        }
        $isFileSize = $this->getFileUploadSize($file);
        if ($isFileSize > 5120000) {
            $fileSizeAllDokumen = round(($isFileSize / 1000) / 1000, 2);
            return Response::json(['errors' => ['Total File Size melebihi kapasitas yang sudah ditetapkan (Total Max: 5MB), Total File Ada: '.$fileSizeAllDokumen." MB"]], 422);
        }
            $id_nilai_ppk = 1;
            for ($i=0; $i < count($request->nilai_ppk) ; $i++) { 
                $json_ppk[] = array(
                    'no' => $id_nilai_ppk,
                    'nilai_ppk' => $request->nilai_ppk[$i]
                );
                $id_nilai_ppk++;
            }
            $json_nilai_ppk = json_encode($json_ppk);
            $dokumentasi_kegiatan_baru = new DokumentasiKegiatan([
                "nama_kegiatan" => $request->nama_kegiatan,
                "user_id" => Auth::user()->id,
                "mulai_kegiatan" => $dateMulai,
                "akhir_kegiatan" => $dateAkhir,
                "nilai_ppk" => $json_nilai_ppk,
                "kegiatan_berbasis" => $request->kegiatan_berbasis,
                "keterangan_dokumentasi" => ""
            ]);
            $create_dokumentasi = $dokumentasi_kegiatan_baru->save();
            if ($create_dokumentasi) {
                $cari_dokumentasi = DokumentasiKegiatan::where([
                    "nama_kegiatan" => $request->nama_kegiatan,
                    "user_id" => Auth::user()->id,
                    "kegiatan_berbasis" => $request->kegiatan_berbasis,
                    "mulai_kegiatan" => $dateMulai,
                    "akhir_kegiatan" => $dateAkhir,
                ])->first();
                foreach ($file as $dokumen_file) {
                    $nama_dokumen = $request->mulai_kegiatan."_".$request->nama_kegiatan."_Dokumentasi_".$dokumen_file->getClientOriginalName();
                    $dokumen_create = new DokumenKegiatan([
                    "dokumentasi_kegiatan_id" => $cari_dokumentasi->id,
                    "nama_dokumen" => $nama_dokumen,
                    "status_unggah_dokumen" => "Pengajuan"
                    ]);
                    if(file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_dokumen))){
                        $update_docs = $cari_dokumentasi->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $cari_dokumentasi->id, "nama_dokumen" => $nama_dokumen, "status_unggah_dokumen" => "Pengajuan"])->update([
                            "nama_dokumen" => $nama_dokumen
                        ]);
                        if (!$update_docs) {
                            return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
                        }
                        unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_dokumen));
                        $dokumen_file->move('kegiatan/dokumentasi_kegiatan' , $nama_dokumen);
                        $kumpulan_dokumen = [];
                        continue;
                    } else {
                    $kumpulan_dokumen [] = $nama_dokumen;
                    $file_uploaded = $dokumen_file->move('kegiatan/dokumentasi_kegiatan/', $nama_dokumen);
                    $dokumen_final =  $cari_dokumentasi->dokumenKegiatan()->save($dokumen_create);
                        if ($file_uploaded && $dokumen_final) {
                            continue;
                        }
                        else{
                            //delete dokumen
                            foreach ($kumpulan_dokumen as $nama_delete_dokumen) {
                                unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_delete_dokumen));
                                $cari_dokumentasi->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $cari_dokumentasi->id, "nama_dokumen" => $nama_dokumen, "status_unggah_dokumen" => "Pengajuan"])->delete();
                            }
                            //dokumentasi delete
                            $dokumentasi_kegiatan_baru->delete();
                            return Response::json(['errors' => ['Terjadi Kegagalan Dalam Menyimpan Dokumen, Silahkan Dicoba Kembali']], 422);
                        }
                    }
                }
                $statusDefault = StatusKegiatan::findOrFail(6);
                $save_status = $cari_dokumentasi->statusKegiatan()->save($statusDefault);
                if (!$save_status) {
                    //delete dokumentasi serta dokumennya
                    foreach ($kumpulan_dokumen as $nama_delete_dokumen) {
                        unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_delete_dokumen));
                        $cari_dokumentasi->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $cari_dokumentasi->id, "nama_dokumen" => $nama_dokumen, "status_unggah_dokumen" => "Pengajuan"])->delete();
                    }
                    //dokumentasi delete
                    $dokumentasi_kegiatan_baru->delete();
                    return Response::json(['errors' => ['Tidak Berhasil Membentuk Dokumentasi dan unggah Dokumen Kegiatan, Silahkan Coba Kembali']], 422);
                }
                event(new UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent($dokumentasi_kegiatan_baru, $statusDefault));
                return Response::json(['message' => 'data is valid' , 'notification' => 'Berhasil Mengunggah Dokumentasi Kegiatan Baru'], 200);
            } else {
                return Response::json(['errors' => ['Tidak Berhasil Membentuk Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
            }
    }

    public function uploadDokumentasi(PengajuanDokumentasiKegiatanRequest $request, $id){
        try {
            $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
        } catch(ModelNotFoundException $e){
            return Response::json(['messages' => 'Tidak terdapat Data Dokumentasi Kegiatan, silahkan coba kembali dan kontak Admin, kode yang diberikan: '.$id.'System Error Code: '.$e->getMessage()], 404);
        } catch (\Throwable $th) {
            return Response::json(['messages' => $th->getMessage()], 404);
        }
        $kumpulan_dokumen = [];
        $file = $request->file('dokumentasi_kegiatan_ppk');
        if (is_null($file)) {
            return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumen Dokumentasi Kegiatan, Silahkan Unggah Dokumen Dokumentasi dengan ekstensi .pdf dan Total File Tidak Melebihi 5MB']], 422);
        }
        $isFileSize = $this->getFileUploadSize($file);
        if ($isFileSize > 5120000) {
            $sizeFileToMB = round(($isFileSize / 1000) / 1000 , 2);
            return Response::json(['errors' => ['Total File Size melebihi kapasitas yang sudah ditetapkan (Total Max: 5MB), Total File Ada: '.$sizeFileToMB." MB"]], 422);
        }        
        // elseif($file){
            foreach ($dokumentasi_kegiatan->statusKegiatan as $status) {
                $statusSebelumnya = $status->pivot->status_kegiatan_id;
            }
                foreach ($file as $dokumentasi) {
                    $dokumen_name = $dokumentasi->getClientOriginalName();
                    $new_dokumen_name = $request->mulai_kegiatan."_".$dokumentasi_kegiatan->nama_kegiatan."_Dokumentasi_".$dokumen_name;
                     //jika ada file yang sama, unlink dan lanjut diganti menjadi yang baru
                    if(file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$new_dokumen_name))){
                        //find dokumen yang pernah diupload jika gagaal
                        $update_dokumen = $dokumentasi_kegiatan->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $id, "nama_dokumen" => $new_dokumen_name, "status_unggah_dokumen" => "Pengajuan"])->update([
                            "nama_dokumen" => $new_dokumen_name
                        ]);
                        if (!$update_dokumen) {
                            return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
                        }
                        unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$new_dokumen_name));
                        $dokumentasi->move('kegiatan/dokumentasi_kegiatan/' , $new_dokumen_name);
                        $kumpulan_dokumen = [];
                        continue;
                    } else {
                        $kumpulan_dokumen [] = $new_dokumen_name;
                        $dokumen_create = new DokumenKegiatan([
                            "dokumentasi_kegiatan_id" => $id,
                            "nama_dokumen" => $new_dokumen_name,
                            "status_unggah_dokumen" => "Pengajuan"
                        ]);
                        $dokumen_final =  $dokumentasi_kegiatan->dokumenKegiatan()->save($dokumen_create);
                        $file_uploaded = $dokumentasi->move('kegiatan/dokumentasi_kegiatan/', $new_dokumen_name);
                        if ($file_uploaded && $dokumen_final) {
                            continue;
                        }
                        else{
                            //delete dokumen
                            foreach ($kumpulan_dokumen as $nama_delete_dokumen) {
                                unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_delete_dokumen));
                                $dokumentasi_kegiatan->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $id, "nama_dokumen" => $nama_delete_dokumen, "status_unggah_dokumen" => 'Pengajuan'])->delete();
                            }
                            return Response::json(['errors' => ['Terjadi Kegagalan Dalam Menyimpan Dokumen, Silahkan Dicoba Kembali']], 422);
                        }
                    }
                }
                //update tidak perlu, lgsg saja ke update statusKegiatan
                // $update_dokumentasi = $dokumentasi_kegiatan->update($input);
                // if ($update_dokumentasi) {
                    $status_update = StatusKegiatan::findOrFail(6);
                    $status_update_dokumentasi = $dokumentasi_kegiatan->statusKegiatan()->updateExistingPivot($statusSebelumnya, [
                        'status_kegiatan_id' => $status_update->id
                    ]);
                    if (!$status_update_dokumentasi) {
                        foreach ($kumpulan_dokumen as $nama_delete_dokumen) {
                            unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_delete_dokumen));
                            $dokumentasi_kegiatan->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $id, "nama_dokumen" => $nama_delete_dokumen, "status_unggah_dokumen" => 'Pengajuan'])->delete();
                        }
                        return Response::json(['errors' => ['sistem tidak dapat memproseskan data, silahkan dicoba kembali']], 422);
                    }
                    event(new UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent($dokumentasi_kegiatan, $status_update));
                    return Response::json(['message' => 'data is valid', 'notification' => 'Berhasil Mengunggah Dokumentasi Kegiatan'], 200);
        // }

    }

    public function uploadDokumenDokumentasiBaru(uploadDokumenDokumentasiBaruValidationRequest $request, $id){
        //strictly for dokumentasi => status unggahnya
        try{
            $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
        } catch(\Throwable $th){
            return response()->json(['messages' => $th->getMessage() ], 422);
        } catch(ModelNotFoundException $evt){
            return response()->json(['messages' => $evt->getMessage() ], 404);
        }
        $file = $request->file('dokumen_dokumentasi_baru');
        $kumpulan_docs = [];
        if (is_null($file)) {
            return response()->json(['errors' => ['Lol']], 422);
        }
        $isFileSize = $this->getFileUploadSize($file);
        if ($isFileSize > 5120000) {
            return response()->json(['errors' =>['Lol Kegedean']],422);
        }
       foreach ($file as $docs_file) {
            $nama_docs = $dokumentasi_kegiatan->mulai_kegiatan."_".$dokumentasi_kegiatan->nama_kegiatan."_Dokumentasi-Baru_".$docs_file->getClientOriginalName();
            if (file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_docs))) {
                $update_dokumen = $dokumentasi_kegiatan->dokumenKegiatan()->where([
                    ['nama_dokumen' , '=' , $nama_docs],
                    ['status_unggah_dokumen', '=' , 'Dokumentasi']
                ])->update(
                    ['nama_dokumen' => $nama_docs],
                    ['status_unggah_dokumen' => 'Dokumentasi']
                );
                if ($update_dokumen) {
                    unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_docs));
                    $docs_file->move('kegiatan/dokumentasi_kegiatan', $nama_docs);
                    $kumpulan_docs = [];
                    continue;
                } else {
                    //unlink kumpulan docs and add response
                    foreach ($kumpulan_docs as $failed_docs) {
                        unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$failed_docs));
                        $dokumentasi_kegiatan->dokumenKegiatan()->where([['nama_dokumen' , '=', $failed_docs],
                         ['status_unggah_dokumen', '=' , 'Dokumentasi']])->delete();
                    }
                    return Response::json(['errors' => ['']], 422);
                }
            } else {
                $kumpulan_docs [] = $nama_docs;
                $added_new_dokumen = new DokumenKegiatan([
                    'dokumentasi_kegiatan_id' => $id,
                    'nama_dokumen' => $nama_docs,
                    'status_unggah_dokumen' => 'Dokumentasi',
                ]);
                $save_dokumen = $dokumentasi_kegiatan->dokumenKegiatan()->save($added_new_dokumen);
                $move_file = $docs_file->move('kegiatan/dokumentasi_kegiatan' , $nama_docs);
                if ($save_dokumen && $move_file) {
                    continue;
                } else {
                    foreach ($kumpulan_docs as $failed_docs) {
                        unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$failed_docs));
                        $dokumentasi_kegiatan->dokumenKegiatan()->where([['nama_dokumen' , '=', $failed_docs],
                         ['status_unggah_dokumen', '=' , 'Dokumentasi']])->delete();
                    }
                    return Response::json(['errors' => ['']], 422);
                }
            }
       }
       return Response::json(['data' => 'data is valid'], 200);
    }

    public function uploadDokumenDokumentasiEdit(uploadEditedDokumenDokumentasiValidationRequest $request , $status_unggah , $id, $id_docs) {
        //edit dokumen yang sudah diupload (antara status unggah pengajuan / dokumentasi)
        //only one
        try{
            $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
        } catch(\Throwable $th){
            return response()->json(['messages' => $th->getMessage() ], 422);
        } catch(ModelNotFoundException $evt){
            return response()->json(['messages' => $evt->getMessage() ], 404);
        }
        $file = $request->file('edited_dokumen');
        $search_file = $dokumentasi_kegiatan->dokumenKegiatan()->where([
            ["dokumentasi_kegiatan_id" , "=" , $id]
        ])->get();
        $file_deleted = $dokumentasi_kegiatan->dokumenKegiatan()->where([
            ["id" , "=" , $id_docs],
            ["dokumentasi_kegiatan_id" , "=" , $id],
            ["status_unggah_dokumen" , "=" , $status_unggah]
        ])->first();
        $nama_file = $dokumentasi_kegiatan->mulai_kegiatan."_".$dokumentasi_kegiatan->nama_kegiatan."_Dokumentasi_".$file->getClientOriginalName();
        //check if file is already uploaded and exists on server
        if (file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_file))) {
            foreach ($search_file as $item_dokumen) {
                if ($item_dokumen->nama_dokumen == $nama_file) {
                    $updated_file = $dokumentasi_kegiatan->dokumenKegiatan()->where([
                        ['id', '=' , $id_docs] ,
                        ["nama_dokumen", '=' , $item_dokumen->nama_dokumen],
                        ['status_unggah_dokumen' , '=' , $status_unggah],
                    ])->update([
                        "id" => $id_docs,
                        "nama_dokumen" => $nama_file,
                        "status_unggah_dokumen" => $status_unggah
                    ]);
                    if (!$updated_file) {
                        return Response::json(['errors' => ['']],422);
                    }
                    unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$item_dokumen->nama_dokumen));
                    $file->move('kegiatan/dokumentasi_kegiatan' , $nama_file);
                    return Response::json(['message' => 'data is valid'], 200);
                }
            }
        }
        $updated_file = $dokumentasi_kegiatan->dokumenKegiatan()->where([
            ['id', '=' , $id_docs] ,
            ['status_unggah_dokumen' , '=' , $status_unggah],
        ])->update([
            "id" => $id_docs,
            "nama_dokumen" => $nama_file,
            "status_unggah_dokumen" => $status_unggah
        ]);
        if (!$updated_file) {
            return Response::json(['errors' => ['']],422);
        }
        unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$file_deleted->nama_dokumen));
        $file->move('kegiatan/dokumentasi_kegiatan' , $nama_file);
        return Response::json(['message' => 'data is valid'], 200);
    }

    public function deleteDokumenDokumentasi($status_unggah , $id , $id_docs){
        //delete dokumen yang sudah diupload (antara status unggah pengajuan / dokumentasi)
        //only one
        try{
            $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
        } catch(\Throwable $th){
            return response()->json(['messages' => $th->getMessage() ], 422);
        } catch(ModelNotFoundException $evt){
            return response()->json(['messages' => $evt->getMessage() ], 404);
        }
        $search_file = $dokumentasi_kegiatan->dokumenKegiatan()->where([
            ['id', '=' , $id_docs],
            ['status_unggah_dokumen' , '=' , $status_unggah]
        ])->first();
        $deleted_file = $dokumentasi_kegiatan->dokumenKegiatan()->where([
            ['id', '=' , $id_docs],
            ['nama_dokumen' , '=' , $search_file->nama_dokumen],
            ['status_unggah_dokumen' , '=' , $status_unggah]
        ])->delete();
        if (!$deleted_file) {
            return Response::json(['errors' => ['Gagal Menghapus Dokumen, Silahkan Coba Kembali']], 422);
        }
        unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$search_file->nama_dokumen));
        return Response::json(['message' => 'data is valid'], 200);
    }

    
    // public function uploadDokumentasiUlang(PengajuanDokumentasiKegiatanRequest $request, $id){
    //     //jika dokumentasi dinyatakan pengajuan ulang
    //     //unlink dokumentasi yang terdahulu dan update json dokumentasinya => not tested yet
    //     $input = $request->except('dokumentasi_kegiatan_ppk');
    //     $dokumentasi_ulang = DokumentasiKegiatan::findOrFail($id);
    //     // $dokumen_lama = json_decode($dokumentasi_ulang->dokumentasi_kegiatan_ppk);
    //     $dokumen_lama = $dokumentasi_ulang->dokumentasiKegiatan()->where(["dokumentasi_kegiatan_id", $id, "status_unggah_dokumen" => "Pengajuan"])->get();
    //     foreach ($dokumentasi_ulang->statusKegiatan as $status) {
    //         $statusSebelumnya = $status->pivot->status_kegiatan_id;
    //     }
    //     $dateMulai = Carbon::parse($request->mulai_kegiatan);
    //     $dateAkhir = Carbon::parse($request->akhir_kegiatan);
    //     if ($dateAkhir < $dateMulai) {
    //         Session::flash('date_past_ulang', 'Tanggal Kegiatan Akhir Melewati Masa Lampau dibanding dengan Tanggal Kegiatan Awal');
    //         return redirect()->back();
    //     }
    //     if (is_null($request->file('dokumentasi_kegiatan_ppk'))) {
    //         Session::flash('date_past_ulang', 'Tanggal Kegiatan Akhir Melewati Masa Lampau dibanding dengan Tanggal Kegiatan Awal');
    //         return redirect()->back();
    //     }
    //     elseif($file = $request->file('dokumentasi_kegiatan_ppk')){
    //         $i = 1; //penanda dokumen yang masuk
    //         foreach ($file as $dokumen) {
    //             $dokumen_name = $dokumen->getClientOriginalName();
                
    //             $new_dokumen_name = $request->mulai_kegiatan."_".$request->akhir_kegiatan."_Dokumentasi_Ulang_".$dokumen_name;
    //             if (file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$new_dokumen_name))) {
    //                 unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$new_dokumen_name));
    //             }
    //             $dokumen = new DokumenKegiatan([
    //                 "dokumentasi_kegiatan_id" => $id,
    //                 "nama_dokumen" => $new_dokumen_name,
    //                 "status_unggah_dokumen" => "Pengajuan"
    //             ]);
    //             $pindah_file = $dokumen->move('kegiatan/dokumentasi_kegiatan/', $new_dokumen_name);
    //             $dokumen_create_ulang = $dokumentasi_ulang->dokumenKegiatan()->create($dokumen);
    //             if($pindah_file && $dokumen_create_ulang){
    //                 continue;
    //             }
    //             else {
    //                 Session::flash('gagal', 'Gagal melakukan penyimpanan data dokumentasi, silahkan coba lagi!');
    //                 return redirect()->back();
    //             }
    //         }
    //         $update_dokumentasi = $dokumentasi_ulang->update($input);
    //         if ($update_dokumentasi) {
    //             $status_update = StatusKegiatan::findOrFail(3);
    //             $dokumentasi_ulang->statusKegiatan()->updateExistingPivot($statusSebelumnya, [
    //                 'status_kegiatan_id' => $status_update->id
    //             ]);
    //            //setelah update berhasil, unlink file lamanya dan dari db
    //             foreach ($dokumen_lama as $dokumen_hapus) {
    //                 $dokumentasi_dahulu = $dokumen_hapus->nama_dokumen;
    //                 unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$dokumentasi_dahulu));
    //                 $dokumen = $dokumentasi_ulang->dokumenKegiatan()->delete($dokumentasi_dahulu);
    //             }
    //             Session::flash('sukses_ulang', 'Dokumentasi Berhasil Diunggah, Silahkan Menunggu Keputusan dari Kepala Sekolah');
    //             return redirect('/penanggung-jawab/mengelola-kegiatan/pengajuan-dokumentasi');
    //         }
    //         else{
    //             Session::flash('gagal', 'Maaf, sistem tidak dapat memproseskan data, silahakan dicoba kembali');
    //             return redirect()->back();
    //         }
    //     }
    // }

    protected function getFileUploadSize($file){
        $sizeAllDokumen = 0;
        foreach ($file as $documentFile) {
            $sizeAllDokumen += $documentFile->getSize();
        }
        return $sizeAllDokumen;
    }
}