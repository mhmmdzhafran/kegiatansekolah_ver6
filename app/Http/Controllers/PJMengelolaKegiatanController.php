<?php

namespace App\Http\Controllers;

use App\DokumenKegiatan;
use App\DokumentasiKegiatan;
use App\Events\AjukanProposalKegiatanToKepalaSekolahEvent;
use App\Events\UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent;
use App\FotoKegiatan;
use App\Http\Requests\PengajuanDokumentasiBaruRequest;
use App\Http\Requests\PengajuanDokumentasiKegiatanRequest;
use App\Http\Requests\PengajuanKegiatanUlangValidationRequest;
use App\Http\Requests\PengajuanKegiatanValidationRequest;
// use App\Http\Requests\uploadDokumenDokumentasiBaruValidationRequest;
// use App\Http\Requests\uploadEditedDokumenDokumentasiValidationRequest;
use App\PengajuanKegiatan;
use App\StatusKegiatan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
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
                $status_indikator = $this->statusKegiatan('Pengajuan', $status, 'Proposal Kegiatan');
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
                $nilai_ppk_kegiatan = json_decode($data->nilai_ppk);
                $data_ppk = $this->getDataPPK($nilai_ppk_kegiatan);
                return $data_ppk;
            })->editColumn('updated_at' , function($data){
                return $data->updated_at->timezone('Asia/Jakarta')->toDateTimeString();
            })
            ->rawColumns(['pengajuan', 'statusKegiatan'])->make(true);
        }
        return view('pj.kelola_kegiatan.index');
        
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
                        $input['user_id'] = Auth::user()->id;
                        $input['keterangan_json'] = $keterangan;
                        $input['nama_pj'] = Auth::user()->name;
                        $statusDefault = StatusKegiatan::findOrFail(3);
                        $kegiatan = PengajuanKegiatan::create($input);
                        if (!$kegiatan) {
                            //unlink dokumen
                            unlink(public_path('kegiatan/pengajuan_kegiatan/'.$nama_dokumen_baru));
                            return Response::json(['errors' => ['Tidak dapat membentuk data Pengajuan Kegiatan, Silahkan coba kembali']], 422);
                        }
                        $kegiatan->StatusKegiatan()->save($statusDefault);
                        event(new AjukanProposalKegiatanToKepalaSekolahEvent($kegiatan, $statusDefault));
                        return Response::json(['data' => 'data is valid'], 200);
                        // $kegiatan->StatusKegiatan()->save($statusDefault);
                        // return response()->json(['data' => $sendEvent], 200);
                        // if ($sendEvent != null) {
                        //     $pengajuan_kegiatan = PengajuanKegiatan::where([
                        //         'user_id' => Auth::user()->id,
                        //         'PJ_nama_kegiatan' => $input['PJ_nama_kegiatan'],
                        //         'nama_pj' => Auth::user()->name,
                        //         'mulai_kegiatan' => $input['mulai_kegiatan'],
                        //         'akhir_kegiatan' => $input['akhir_kegiatan']
                        //     ])->delete();
                        //     if (!$pengajuan_kegiatan) {
                        //         $kegiatan->StatusKegiatan()->save($statusDefault);
                        //         return response()->json(['data' => 'Data Is Valid'], 200);
                        //     } else {
                        //         return response()->json(['errors' => [$sendEvent]], 422);
                        //     }
                        // }
                        // $kegiatan->StatusKegiatan()->save($statusDefault);
                        // return Response::json(['data' => 'data is valid'], 200);
                    } else{
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
        } else {
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
            $input['nama_pj'] = Auth::user()->name;
            $status_ulang = StatusKegiatan::findOrFail(3);
            $update_pengajuan = $pengajuan_ulang->update($input);
            if ($update_pengajuan) {
                //update menjadi file baru dan taro di directory
                $nama_dokumen_ulang = $request->mulai_kegiatan."_Pengajuan_Kegiatan_Ulang-".$input['PJ_nama_kegiatan']."-".$name;
                //unlink file dokumen yang kemaren dikirim
                unlink(public_path('kegiatan/pengajuan_kegiatan/'.$file_lama));
                $file->move('kegiatan/pengajuan_kegiatan/',$nama_dokumen_ulang);
                //update pivot and fire event
                $pengajuan_ulang->StatusKegiatan()->updateExistingPivot($statusSebelumnya, [
                    'status_kegiatan_id' => $status_ulang->id
                ]);
                event(new AjukanProposalKegiatanToKepalaSekolahEvent($pengajuan_ulang, $status_ulang));
                return response()->json(['data' => 'data is valid'], 200);
            } else {
                return response()->json(['data' => 'data is not valid', 'errors' => ['Tidak dapat memproses data, silahkan mencoba lagi']], 422);
            }
        }
    }

    /**
     * //Khusus Fungsionalitas Unggah Dokumentasi
     */

    public function indexDokumentasi(){

        $user_id = Auth::user()->id;
        $dokumentasi_kegiatan_status = DokumentasiKegiatan::with('statusKegiatan')->select('dokumentasi_kegiatans.*')->where('user_id' , '=' , $user_id);     
        if (request()->ajax()) {
            return datatables()->eloquent($dokumentasi_kegiatan_status)->addColumn('statusKegiatan', function(DokumentasiKegiatan $dokumentasi_kegiatan){
                $status =  $dokumentasi_kegiatan->statusKegiatan->pluck('nama')->implode('<br>');
                $status_indikator = $this->statusKegiatan('Dokumentasi',$status, $dokumentasi_kegiatan->tipe_kegiatan);
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
                        elseif($status->pivot->status_kegiatanable_id == $data->id && $status->pivot->status_kegiatan_id == 3){
                            $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm status_pengajuan rounded-pill" value ="belum_disetujui">Lihat Detail</button>';
                        }
                        elseif($status->pivot->status_kegiatanable_id == $data->id && $status->pivot->status_kegiatan_id == 4){
                            $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-danger btn-sm status_pengajuan rounded-pill" value ="pengajuan_ulang">Lihat Detail</button>';
                        }
                        return $button;
                    }
                }
            })->editColumn('nilai_ppk', function($data){
                $data_nilai = json_decode($data->nilai_ppk);
                $data_ppk = $this->getDataPPK($data_nilai);
                return $data_ppk; 
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
            if ($status->id == 4) {
                $dokumenKegiatan = $dokumentasi_kegiatan->dokumenKegiatan()->get();
                $fotoKegiatan = $dokumentasi_kegiatan->fotoKegiatan()->get();
                return Response::json(['status_dokumentasi' => $status, 'nilai_ppk_kegiatan' => $nilai_ppk_kegiatan, 'data_dokumentasi' => $dokumentasi_kegiatan , 'dokumen' => $dokumenKegiatan , 'image' => $fotoKegiatan , 'state_dokumentasi' => $dokumentasi_kegiatan->tipe_kegiatan], 200);
            }
            return Response::json(['status_dokumentasi' => $status, 'nilai_ppk_kegiatan' => $nilai_ppk_kegiatan, 'data_dokumentasi' => $dokumentasi_kegiatan ], 200);
        }
    }

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
            $dokumen = $dokumentasi_kegiatan->dokumenKegiatan()->get();
            $image = $dokumentasi_kegiatan->fotoKegiatan()->get();
            // $dokumen_baru = $dokumentasi_kegiatan->dokumenKegiatan()->where("status_unggah_dokumen" , "=" , "Dokumentasi")->get();
            // $file_dokumen = [];
            // foreach ($dokumen as $item) {
            //     if ($item->status_unggah_dokumen == "Pengajuan") {
            //         $file_dokumen[] = $item->nama_dokumen;
            //     }
            // }
            foreach($dokumentasi_kegiatan->statusKegiatan as $status){
                $status_kegiatan  = $status->pivot->status_kegiatan_id;
            }
            if (count($dokumen) > 0) {
                if($status_kegiatan == 3) {
                    if (!is_null($dokumentasi_kegiatan->keterangan_dokumentasi)) {
                        return Response::json(['status' => $status_kegiatan, 'dokumen' => $dokumen, 'image' => $image,  'nilai_ppk_kegiatan' => $nilai_ppk_kegiatan, 'dokumentasi_kegiatan' => $dokumentasi_kegiatan , 'isKeterangan' => true, 'keterangan' => $dokumentasi_kegiatan->keterangan_dokumentasi], 200);
                    } else {
                        return Response::json(['status' => $status_kegiatan, 'dokumen' => $dokumen, 'image' => $image, 'nilai_ppk_kegiatan' => $nilai_ppk_kegiatan, 'dokumentasi_kegiatan' => $dokumentasi_kegiatan , 'isKeterangan' => false], 200);
                    }
                } elseif($status_kegiatan == 6 ){
                    if (!is_null($dokumentasi_kegiatan->keterangan_dokumentasi)) {
                        return Response::json(['status' => $status_kegiatan, 'dokumen' => $dokumen, 'image' => $image,  'nilai_ppk_kegiatan' => $nilai_ppk_kegiatan, 'dokumentasi_kegiatan' => $dokumentasi_kegiatan , 'isKeterangan' => true, 'keterangan' => $dokumentasi_kegiatan->keterangan_dokumentasi], 200);
                    } else {
                        return Response::json(['status' => $status_kegiatan, 'dokumen' => $dokumen, 'image' => $image, 'nilai_ppk_kegiatan' => $nilai_ppk_kegiatan, 'dokumentasi_kegiatan' => $dokumentasi_kegiatan , 'isKeterangan' => false], 200);
                    }   
                }
            } else {
                return Response::json(['status' => $status_kegiatan, 'dokumen' => $dokumen, 'image' => $image, 'nilai_ppk_kegiatan' => $nilai_ppk_kegiatan, 'dokumentasi_kegiatan' => $dokumentasi_kegiatan,  'isKeterangan' => false], 200);   
            }
        }
    }

    public function uploadDokumentasiBaru(PengajuanDokumentasiBaruRequest $request){
        $dateMulai = Carbon::parse($request->mulai_kegiatan);
        $dateAkhir = Carbon::parse($request->akhir_kegiatan);
        if ($dateAkhir < $dateMulai) {
            return Response::json(['errors' => ['Tanggal Akhir Kegiatan Lampau Dibandingkan Tanggal Mulai Kegiatan, Silahkan Masukkan Kembali']], 422);
        }
        // $kumpulan_dokumen = [];
        
        $file = $request->file('dokumentasi_kegiatan_ppk');
        $img = $request->file('image_kegiatan_ppk');
        if (is_null($file) && is_null($img)) {
            return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumen Laporan Kegiatan & Dokumentasi Kegiatan, Silahkan Unggah Laporan Kegiatan & Dokumentasi Kegiatan dengan ekstensi yang telah ditetapkan!']], 422);
        } elseif(is_null($file)){
            return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumen Laporan Kegiatan, Silahkan Unggah Laporan Kegiatan dengan ekstensi .pdf, .docx, atau .doc dan Total File Tidak Melebihi 5MB']], 422);
        } elseif(is_null($img)){
            return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumentasi Kegiatan, Silahkan Unggah Dokumen Dokumentasi dengan ekstensi .png atau .jpeg dan Total File Tidak Melebihi 5MB']], 422);
        }
        $isFileSize = $this->getFileUploadSize($file);
        $isImgSize = $this->getFileUploadSize($img);
        if ($isFileSize > 5120000) {
            $fileSizeAllDokumen = round(($isFileSize / 1000) / 1000, 2);
            return Response::json(['errors' => ['Total File Size melebihi kapasitas yang sudah ditetapkan (Total Max: 5MB), Total File Ada: '.$fileSizeAllDokumen." MB"]], 422);
        } elseif($isImgSize > 5120000){
            $fileSizeAllImage = round(($isFileSize / 1000) / 1000, 2);
            return Response::json(['errors' => ['Total File Size melebihi kapasitas yang sudah ditetapkan (Total Max: 5MB), Total File Ada: '.$fileSizeAllImage." MB"]], 422);
        }
        $keterangan_dokumentasi [] = array(
            'no' => 1,
            'keterangan_opsional' => ''
        );
        $keterangan_dokumentasi [] = array(
            'no' => 2,
            'keterangan_wajib_ulang' => ''
        );
        $keterangan_json = json_encode($keterangan_dokumentasi);
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
                "nama_pj" => Auth::user()->name,
                "mulai_kegiatan" => $dateMulai,
                "akhir_kegiatan" => $dateAkhir,
                "nilai_ppk" => $json_nilai_ppk,
                "kegiatan_berbasis" => $request->kegiatan_berbasis,
                "keterangan_dokumentasi" => $keterangan_json,
                "tipe_kegiatan" => 'Pengajuan Historis'
            ]);
            $create_dokumentasi = $dokumentasi_kegiatan_baru->save();
            if ($create_dokumentasi) {
                $cari_dokumentasi = DokumentasiKegiatan::where([
                    "nama_kegiatan" => $request->nama_kegiatan,
                    "user_id" => Auth::user()->id,
                    "nama_pj" => Auth::user()->name,
                    "kegiatan_berbasis" => $request->kegiatan_berbasis,
                    "mulai_kegiatan" => $dateMulai,
                    "akhir_kegiatan" => $dateAkhir,
                    "keterangan_dokumentasi" => $keterangan_json,
                    "tipe_kegiatan" => 'Pengajuan Historis'
                ])->first();
                // foreach ($file as $dokumen_file) {
                //     $nama_dokumen = $request->mulai_kegiatan."_".$request->nama_kegiatan."_Dokumentasi_".$dokumen_file->getClientOriginalName();
                //     $dokumen_create = new DokumenKegiatan([
                //     "dokumentasi_kegiatan_id" => $cari_dokumentasi->id,
                //     "nama_dokumen" => $nama_dokumen,
                //     "status_unggah_dokumen" => "Pengajuan Historis"
                //     ]);
                //     if(file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_dokumen))){
                //         $update_docs = $cari_dokumentasi->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $cari_dokumentasi->id, "nama_dokumen" => $nama_dokumen, "status_unggah_dokumen" => "Pengajuan"])->update([
                //             "nama_dokumen" => $nama_dokumen
                //         ]);
                //         if (!$update_docs) {
                //             return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
                //         }
                //         unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_dokumen));
                //         $dokumen_file->move('kegiatan/dokumentasi_kegiatan' , $nama_dokumen);
                //         // $kumpulan_dokumen = [];
                //         continue;
                //     } else {
                //     $kumpulan_dokumen [] = $nama_dokumen;
                //     $file_uploaded = $dokumen_file->move('kegiatan/dokumentasi_kegiatan/', $nama_dokumen);
                //     $dokumen_final =  $cari_dokumentasi->dokumenKegiatan()->save($dokumen_create);
                //         if ($file_uploaded && $dokumen_final) {
                //             continue;
                //         }
                //         else{
                //             //delete dokumen
                //             foreach ($kumpulan_dokumen as $nama_delete_dokumen) {
                //                 unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_delete_dokumen));
                //                 $cari_dokumentasi->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $cari_dokumentasi->id, "nama_dokumen" => $nama_dokumen, "status_unggah_dokumen" => "Pengajuan"])->delete();
                //             }
                //             //dokumentasi delete
                //             $dokumentasi_kegiatan_baru->delete();
                //             return Response::json(['errors' => ['Terjadi Kegagalan Dalam Menyimpan Dokumen, Silahkan Dicoba Kembali']], 422);
                //         }
                //     }
                // }
                $kumpulan_dokumen = $this->storeFileLaporanKegiatan($file, $request->mulai_kegiatan, $cari_dokumentasi, "Pengajuan Historis", "dokumen");
                $kumpulan_foto = $this->storeFileLaporanKegiatan($img, $request->mulai_kegiatan, $cari_dokumentasi, "Pengajuan Historis", "image");
                if (!$kumpulan_dokumen) {
                    $dokumentasi_kegiatan_baru->delete();
                    return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Laporan dan Dokumentasi Kegiatan, Silahkan Coba Kembali files']], 422);
                }elseif (!$kumpulan_foto) {
                    $this->failedUploadKegiatan($kumpulan_dokumen, $cari_dokumentasi, "dokumen", "Pengajuan Historis");
                    $dokumentasi_kegiatan_baru->delete();
                    return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Laporan dan Dokumentasi Kegiatan, Silahkan Coba Kembali dokumentasi']], 422);
                }
                $statusDefault = StatusKegiatan::findOrFail(3);
                $save_status = $cari_dokumentasi->statusKegiatan()->save($statusDefault);
                if (!$save_status) {
                    //delete dokumentasi serta dokumennya
                    // foreach ($kumpulan_dokumen as $nama_delete_dokumen) {
                    //     unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_delete_dokumen));
                    //     $cari_dokumentasi->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $cari_dokumentasi->id, "nama_dokumen" => $nama_dokumen, "status_unggah_dokumen" => "Pengajuan"])->delete();
                    // }
                    //dokumentasi delete
                    $this->failedUploadKegiatan($kumpulan_dokumen, $cari_dokumentasi, "dokumen", "Pengajuan Historis");
                    $this->failedUploadKegiatan($kumpulan_foto, $cari_dokumentasi, "image", "Pengajuan Historis");
                    $dokumentasi_kegiatan_baru->delete();
                    return Response::json(['errors' => ['Tidak Berhasil Membentuk Dokumentasi dan unggah Dokumen Kegiatan, Silahkan Coba Kembali']], 422);
                }
                event(new UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent($dokumentasi_kegiatan_baru, $statusDefault));
                return Response::json(['message' => 'data is valid' , 'notification' => 'Berhasil Mengunggah Dokumentasi Kegiatan Baru'], 200);
            } else {
                $dokumentasi_kegiatan_baru->delete();
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
        // $kumpulan_dokumen = [];
        $file = $request->file('dokumentasi_kegiatan_ppk');
        $img = $request->file('image_kegiatan_ppk');
        if (is_null($file) && is_null($img)) {
            return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumen Laporan Kegiatan & Dokumentasi Kegiatan, Silahkan Unggah Laporan Kegiatan & Dokumentasi Kegiatan dengan ekstensi yang telah ditetapkan!']], 422);
        } elseif(is_null($file)){
            return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumen Laporan Kegiatan, Silahkan Unggah Laporan Kegiatan dengan ekstensi .pdf, .docx, atau .doc dan Total File Tidak Melebihi 5MB']], 422);
        } elseif(is_null($img)){
            return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumentasi Kegiatan, Silahkan Unggah Dokumen Dokumentasi dengan ekstensi .png atau .jpeg dan Total File Tidak Melebihi 5MB']], 422);
        }
        
        $fileSize = $this->getFileUploadSize($file);
        $imageSize = $this->getFileUploadSize($img);

        $fileChecker = $this->isFileSize($fileSize);
        $imageChecker = $this->isFileSize($imageSize);
        if (!$fileChecker) {
            $sizeFileToMB = round(($fileSize / 1000) / 1000 , 2);
            return Response::json(['errors' => ['Total File Size melebihi kapasitas yang sudah ditetapkan (Total Max: 5MB), Total File Ada: '.$sizeFileToMB." MB"]], 422);
        } elseif(!$imageChecker){
            $sizeFileToMB = round(($imageSize / 1000) / 1000 , 2);
            return Response::json(['errors' => ['Total File Size melebihi kapasitas yang sudah ditetapkan (Total Max: 5MB), Total File Ada: '.$sizeFileToMB." MB"]], 422);
        }
        // elseif($file){
        foreach ($dokumentasi_kegiatan->statusKegiatan as $status) {
            $statusSebelumnya = $status->pivot->status_kegiatan_id;
        }
                // foreach ($file as $dokumentasi) {
                //     $dokumen_name = $dokumentasi->getClientOriginalName();
                //     $new_dokumen_name = $request->mulai_kegiatan."_".$dokumentasi_kegiatan->nama_kegiatan."_Dokumentasi_".$dokumen_name;
                //      //jika ada file yang sama, unlink dan lanjut diganti menjadi yang baru
                //     if(file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$new_dokumen_name))){
                //         //find dokumen yang pernah diupload jika gagaal
                //         $update_dokumen = $dokumentasi_kegiatan->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $id, "nama_dokumen" => $new_dokumen_name, "status_unggah_dokumen" => "Pengajuan"])->update([
                //             "nama_dokumen" => $new_dokumen_name
                //         ]);
                //         if (!$update_dokumen) {
                //             return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
                //         }
                //         unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$new_dokumen_name));
                //         $dokumentasi->move('kegiatan/dokumentasi_kegiatan/' , $new_dokumen_name);
                //         // $kumpulan_dokumen = [];
                //         continue;
                //     } else {
                //         $kumpulan_dokumen [] = $new_dokumen_name;
                //         $dokumen_create = new DokumenKegiatan([
                //             "dokumentasi_kegiatan_id" => $id,
                //             "nama_dokumen" => $new_dokumen_name,
                //             "status_unggah_dokumen" => "Pengajuan"
                //         ]);
                //         $dokumen_final =  $dokumentasi_kegiatan->dokumenKegiatan()->save($dokumen_create);
                //         $file_uploaded = $dokumentasi->move('kegiatan/dokumentasi_kegiatan/', $new_dokumen_name);
                //         if ($file_uploaded && $dokumen_final) {
                //             continue;
                //         }
                //         else{
                //             //delete dokumen
                //             foreach ($kumpulan_dokumen as $nama_delete_dokumen) {
                //                 unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_delete_dokumen));
                //                 $dokumentasi_kegiatan->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $id, "nama_dokumen" => $nama_delete_dokumen, "status_unggah_dokumen" => 'Pengajuan'])->delete();
                //             }
                //             return Response::json(['errors' => ['Terjadi Kegagalan Dalam Menyimpan Dokumen, Silahkan Dicoba Kembali']], 422);
                //         }
                //     }
                // }
        $kumpulan_dokumen = $this->storeFileLaporanKegiatan($file, $dokumentasi_kegiatan->mulai_kegiatan, $dokumentasi_kegiatan, "Pengajuan", "dokumen");
        
        $kumpulan_foto = $this->storeFileLaporanKegiatan($img, $dokumentasi_kegiatan->mulai_kegiatan, $dokumentasi_kegiatan, "Pengajuan" , "image");

        if (!$kumpulan_dokumen) {
            return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
        }
        elseif (!$kumpulan_foto) {
            $this->failedUploadKegiatan($kumpulan_dokumen, $dokumentasi_kegiatan, "dokumen", "Pengajuan");
            return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
        }
        
        $status_update = StatusKegiatan::findOrFail(3);
        $status_update_dokumentasi = $dokumentasi_kegiatan->statusKegiatan()->updateExistingPivot($statusSebelumnya, [
            'status_kegiatan_id' => $status_update->id
        ]);
        if (!$status_update_dokumentasi) {
            // foreach ($kumpulan_dokumen as $nama_delete_dokumen) {
            //     unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_delete_dokumen));
            //     $dokumentasi_kegiatan->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $id, "nama_dokumen" => $nama_delete_dokumen, "status_unggah_dokumen" => 'Pengajuan'])->delete();
            // }
            // return Response::json(['errors' => ['sistem tidak dapat memproseskan data, silahkan dicoba kembali']], 422);
                $this->failedUploadKegiatan($kumpulan_dokumen , $dokumentasi_kegiatan , "dokumen", "Pengajuan");
                $this->failedUploadKegiatan($kumpulan_foto, $dokumentasi_kegiatan, "image", "Pengajuan");
                return Response::json(['errors' => ['sistem tidak dapat memproseskan data, silahkan dicoba kembali']], 422); 
        }
        event(new UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent($dokumentasi_kegiatan, $status_update));
        return Response::json(['message' => 'data is valid', 'notification' => 'Berhasil Mengunggah Dokumentasi Kegiatan'], 200);
        // }

    }
   
    public function uploadDokumentasiUlang(PengajuanDokumentasiKegiatanRequest $request, $id){
        try {
            $dokumentasi_ulang = DokumentasiKegiatan::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(['messages' => 'Tidak terdapat Data Dokumentasi Kegiatan, silahkan coba kembali dan kontak Admin, kode yang diberikan: '.$id.'System Error Code: '.$th->getMessage()], 404);
        } catch (ModelNotFoundException $evt){
            return response()->json(['messages' => $evt->getMessage()], 404);
        }
        $tempFileDocs = [];
        $tempFileImg = [];
        $file_dokumen_lama = [];
        $file_img_lama = [];
        $file = $request->file('dokumentasi_kegiatan_ppk');
        $img = $request->file('image_kegiatan_ppk');
        
        if (is_null($file) && is_null($img)) {
            return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumen Laporan Kegiatan & Dokumentasi Kegiatan, Silahkan Unggah Laporan Kegiatan & Dokumentasi Kegiatan dengan ekstensi yang telah ditetapkan!']], 422);
        } elseif(is_null($file)){
            return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumen Laporan Kegiatan, Silahkan Unggah Laporan Kegiatan dengan ekstensi .pdf, .docx, atau .doc dan Total File Tidak Melebihi 5MB']], 422);
        } elseif(is_null($img)){
            return Response::json(['errors' => ['Tidak Terdapat Unggahan Dokumentasi Kegiatan, Silahkan Unggah Dokumen Dokumentasi dengan ekstensi .png atau .jpeg dan Total File Tidak Melebihi 5MB']], 422);
        }
        $fileSize = $this->getFileUploadSize($file);
        $imageSize = $this->getFileUploadSize($img);

        $fileChecker = $this->isFileSize($fileSize);
        $imageChecker = $this->isFileSize($imageSize);
        if (!$fileChecker) {
            $sizeFileToMB = round(($fileSize / 1000) / 1000 , 2);
            return Response::json(['errors' => ['Total File Size melebihi kapasitas yang sudah ditetapkan (Total Max: 5MB), Total File Ada: '.$sizeFileToMB." MB"]], 422);
        } elseif(!$imageChecker){
            $sizeFileToMB = round(($imageSize / 1000) / 1000 , 2);
            return Response::json(['errors' => ['Total File Size melebihi kapasitas yang sudah ditetapkan (Total Max: 5MB), Total File Ada: '.$sizeFileToMB." MB"]], 422);
        }

        $status_unggah_laporan = $dokumentasi_ulang->tipe_kegiatan;
        $dokumen_lama = $dokumentasi_ulang->dokumenKegiatan()->where([
            ["status_unggah_dokumen" , $dokumentasi_ulang->tipe_kegiatan]
        ])->get();
        $img_lama = $dokumentasi_ulang->fotoKegiatan()->where([
            ["status_unggah_foto" , $dokumentasi_ulang->tipe_kegiatan]
        ])->get();
        
        foreach ($dokumen_lama as $docs_lama) {
            $file_dokumen_lama [] = $docs_lama->nama_dokumen;
        }
        foreach($img_lama as $img_lama){
            $file_img_lama [] = $img_lama->nama_foto_kegiatan;
        }
        
        if ($status_unggah_laporan == "Pengajuan Historis") {
            $input = $request->only([
                'nama_kegiatan',
                'nilai_ppk',
                'kegiatan_berbasis',
                'mulai_kegiatan',
                'akhir_kegiatan'
            ]);

            Validator::make($input , [
                "nama_kegiatan" => 'required|unique:pengajuan_kegiatans,PJ_nama_kegiatan',
                "nilai_ppk" => 'required',
                "kegiatan_berbasis" => 'required',
                "mulai_kegiatan" => 'required',
                "akhir_kegiatan" => 'required'
            ], [
                "nama_kegiatan.required" => 'Nama Kegiatan Harus Dimasukkan!',
                "nama_kegiatan.unique" => 'Nama Kegiatan Sudah Diambil, Silahkan Isi Nama Kegiatan Yang Lain!',
                "nilai_ppk.required" => 'Nilai PPK Wajib Dipilih!',
                "kegiatan_berbasis.required" => 'Kegiatan Berbasis Wajib Dipilih!',
                'mulai_kegiatan.required' => 'Awal Kegiatan Wajib Diisi!',
                'akhir_kegiatan.required' => 'Akhir Kegiatan Wajib Diisi!'
            ])->validate();
            
            //validate rules => karena ini historis
            $dateMulai = Carbon::parse($request->mulai_kegiatan);
            $dateAkhir = Carbon::parse($request->akhir_kegiatan);
            if ($dateAkhir < $dateMulai) {
                return response()->json(['errors' => ['Tanggal Kegiatan Akhir Melewati Masa Lampau dibanding dengan Tanggal Kegiatan Awal']], 422);
            }
            $id_nilai_ppk = 1;
            for ($i=0; $i < count($request->nilai_ppk) ; $i++) { 
                $json_ppk[] = array(
                    'no' => $id_nilai_ppk,
                    'nilai_ppk' => $request->nilai_ppk[$i]
                );
                $id_nilai_ppk++;
            }
            $input['nilai_ppk'] = json_encode($json_ppk);
        } 

        foreach ($file as $kumpulan_file) {
            $dokumen_name = $kumpulan_file->getClientOriginalName();
            $new_dokumen_name = $dokumentasi_ulang->mulai_kegiatan."_".$dokumentasi_ulang->nama_kegiatan."_Laporan Kegiatan_".$dokumen_name;
            $tempFileDocs []  = $new_dokumen_name;
        }

        foreach ($img as $kumpulan_image) {
            $img_name = $kumpulan_image->getClientOriginalName();
            $new_img_name = $dokumentasi_ulang->mulai_kegiatan."_".$dokumentasi_ulang->nama_kegiatan."_Dokumentasi_".$img_name;
            $tempFileImg [] = $new_img_name;
        }
             
        foreach ($dokumentasi_ulang->statusKegiatan as $status) {
            $statusSebelumnya = $status->pivot->status_kegiatan_id;
        }
        $status_update = StatusKegiatan::findOrFail(3);

        if ($status_unggah_laporan == "Pengajuan Historis") {
            $kumpulan_dokumen = $this->storeFileLaporanKegiatan($file, $dokumentasi_ulang->mulai_kegiatan, $dokumentasi_ulang, $status_unggah_laporan, "dokumen");
            $kumpulan_foto = $this->storeFileLaporanKegiatan($img, $dokumentasi_ulang->mulai_kegiatan, $dokumentasi_ulang, $status_unggah_laporan , "image");
            if (!$kumpulan_dokumen) {
                return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumentasi Kegiatan, Silahkan Coba Kembali files']], 422);
            } elseif (!$kumpulan_foto) {
                $res_kumpulan_dokumen = $this->fileArrTypeChecker($kumpulan_dokumen);
                $this->failedUploadKegiatan($res_kumpulan_dokumen, $dokumentasi_ulang, "dokumen", $status_unggah_laporan);
                return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumentasi Kegiatan, Silahkan Coba Kembali images']], 422);
            }
            $res_kumpulan_dokumen = $this->fileArrTypeChecker($kumpulan_dokumen);
            $res_kumpulan_foto = $this->fileArrTypeChecker($kumpulan_foto);
            $update_dokumentasi = $dokumentasi_ulang->update($input);
            if ($update_dokumentasi) {
                $pembuatan_laporan_kegiatan = $this->storePengajuanUlangLaporanKegiatan($dokumentasi_ulang, $file_dokumen_lama, $file_img_lama, $tempFileDocs, $tempFileImg, $statusSebelumnya, $status_unggah_laporan, $status_update);
                if (!$pembuatan_laporan_kegiatan) {
                    $this->failedUploadKegiatan($res_kumpulan_dokumen , $dokumentasi_ulang , "dokumen", $status_unggah_laporan);
                    $this->failedUploadKegiatan($res_kumpulan_foto, $dokumentasi_ulang, "image", $status_unggah_laporan);
                    return response()->json(['errors' => ['Sistem Tidak Dapat Menyimpan Pengajuan Ulang Laporan Kegiatan, Silahkan Coba Kembali']], 422);

                }
                event(new UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent($dokumentasi_ulang , $status_update));
                return response()->json(['data' => 'Sukses Pengajuan Ulang Laporan Kegiatan Historis'], 200);
            } else {
                $this->failedUploadKegiatan($res_kumpulan_dokumen, $dokumentasi_ulang , "dokumen" ,  $status_unggah_laporan);
                $this->failedUploadKegiatan($res_kumpulan_foto, $dokumentasi_ulang, "image", $status_unggah_laporan);
                return response()->json(['errors' => ['Sistem Tidak Dapat Menyimpan Pengajuan Ulang Laporan Kegiatan, Silahkan Coba Kembali']], 422);
            }
        } elseif($status_unggah_laporan == "Pengajuan"){
            $kumpulan_dokumen = $this->storeFileLaporanKegiatan($file, $dokumentasi_ulang->mulai_kegiatan, $dokumentasi_ulang, $status_unggah_laporan, "dokumen");
            $kumpulan_foto = $this->storeFileLaporanKegiatan($img, $dokumentasi_ulang->mulai_kegiatan, $dokumentasi_ulang, $status_unggah_laporan , "image");
            if (!$kumpulan_dokumen) {
                return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
            }
            elseif (!$kumpulan_foto) {
                $res_kumpulan_dokumen = $this->fileArrTypeChecker($kumpulan_dokumen);
                $this->failedUploadKegiatan($res_kumpulan_dokumen, $dokumentasi_ulang, "dokumen", $status_unggah_laporan);
                return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
            }
            $res_kumpulan_dokumen = $this->fileArrTypeChecker($kumpulan_dokumen);
            $res_kumpulan_foto = $this->fileArrTypeChecker($kumpulan_foto);
            $pembuatan_laporan_kegiatan = $this->storePengajuanUlangLaporanKegiatan($dokumentasi_ulang, $file_dokumen_lama, $file_img_lama, $tempFileDocs, $tempFileImg, $statusSebelumnya , $status_unggah_laporan, $status_update);
            if (!$pembuatan_laporan_kegiatan) {
                $this->failedUploadKegiatan($res_kumpulan_dokumen, $dokumentasi_ulang, "dokumen", $status_unggah_laporan);
                $this->failedUploadKegiatan($res_kumpulan_foto, $dokumentasi_ulang, "image", $status_unggah_laporan);
                return response()->json(['errors' => ['Sistem Tidak Dapat Menyimpan Pengajuan Ulang Laporan Kegiatan, Silahkan Coba Kembali']], 422);
            }
            event(new UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent($dokumentasi_ulang , $status_update));
            return response()->json(['data' => 'Sukses Pengajuan Ulang Laporan Kegiatan'], 200);
        }
    }

    private function storePengajuanUlangLaporanKegiatan($data_laporan, $dokumen_laporan_sebelumnya, $foto_kegiatan_sebelumnya, $tempDokumen, $tempFoto, $status_laporan_sebelumnya , $statusUnggah, $status_baru){
        $update_pivot = $data_laporan->statusKegiatan()->updateExistingPivot($status_laporan_sebelumnya, [
            'status_kegiatan_id' => $status_baru->id
        ]);
        //setelah update berhasil, unlink file lamanya dan dari db
        if ($update_pivot) {
            foreach ($dokumen_laporan_sebelumnya as $key => $docsName) {
                foreach ($tempDokumen as $value) {
                    if ($value == $docsName) {
                        unset($dokumen_laporan_sebelumnya[$key]);
                    }
                }
            }
            $deleteFile = $this->deleteFileKegiatanPengajuanUlang($data_laporan, $dokumen_laporan_sebelumnya, "dokumen" , $statusUnggah);
            if (!$deleteFile) {
                $data_laporan->statusKegiatan()->updateExistingPivot($status_baru->id, [
                    'status_kegiatan_id' => $status_laporan_sebelumnya
                ]);
                // return response()->json(['errors' => ['Terdapat Error ketika mengubah status laporan kegiatan, Silahkan Coba Kembali']], 422);
                return false;
            }
            foreach ($foto_kegiatan_sebelumnya as $key => $foto_hapus) {
                foreach ($tempFoto as $value) {
                    if ($value == $foto_hapus) {
                        unset($foto_kegiatan_sebelumnya[$key]);
                    }
                }
            }
            $deleteImg = $this->deleteFileKegiatanPengajuanUlang($data_laporan, $foto_kegiatan_sebelumnya, "image" , $statusUnggah); 
            if (!$deleteFile || !$deleteImg) {
                $data_laporan->statusKegiatan()->updateExistingPivot($status_baru->id, [
                    'status_kegiatan_id' => $status_laporan_sebelumnya
                ]);
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    private function deleteFileKegiatanPengajuanUlang($data_laporan , $arrFile , $tipe_file, $status_kegiatan){ 
        foreach ($arrFile as $files) {
            if (file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$files))) {
                unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$files));
                if ($tipe_file == "dokumen") {
                    $data_laporan->dokumenKegiatan()->where([
                        ["nama_dokumen" , $files],
                        ["status_unggah_dokumen" , $status_kegiatan]
                    ])->delete();
                } elseif($tipe_file == "image") {
                    $data_laporan->fotoKegiatan()->where([
                        ["nama_foto_kegiatan" , $files],
                        ["status_unggah_foto" , $status_kegiatan]
                    ])->delete();   
                }
            } else {
                if ($tipe_file == "dokumen") {
                    $data_laporan->dokumenKegiatan()->where([
                        ["nama_dokumen" , $files],
                        ["status_unggah_dokumen" , $status_kegiatan]
                    ])->delete();
                } elseif($tipe_file == "image") {
                    $data_laporan->fotoKegiatan()->where([
                        ["nama_foto_kegiatan" , $files],
                        ["status_unggah_foto" , $status_kegiatan]
                    ])->delete();   
                }
            }
        }
        return true;
    }

    private function storeFileLaporanKegiatan($file, $mulai_kegiatan, $kegiatan, $type, $file_type){
        $kumpulan_dokumen  = [];
        $new_dokumen_name = "";
        foreach ($file as $file_kegiatan) {
            if ($type == "Pengajuan" || $type == "Pengajuan Historis") {
                $dokumen_name = $file_kegiatan->getClientOriginalName();
                if ($file_type == "dokumen") {
                    $new_dokumen_name = $mulai_kegiatan."_".$kegiatan->nama_kegiatan."_Laporan Kegiatan_".$dokumen_name;
                    $checker =  $kegiatan->dokumenKegiatan()->where([ 
                        ["nama_dokumen" , $new_dokumen_name], 
                        ["status_unggah_dokumen" , $type]
                    ])->first();
                } elseif($file_type == "image") {
                    $new_dokumen_name = $mulai_kegiatan."_".$kegiatan->nama_kegiatan."_Dokumentasi_".$dokumen_name;
                    $checker  = $kegiatan->fotoKegiatan()->where([
                        ["nama_foto_kegiatan" , $new_dokumen_name],
                        ["status_unggah_foto" , $type]
                    ])->first();
                }

                if(file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$new_dokumen_name)) && !is_null($checker)){
                    if ($file_type == "dokumen") {
                        $update_dokumen = $kegiatan->dokumenKegiatan()->where([
                            ["nama_dokumen" , $new_dokumen_name], 
                            ["status_unggah_dokumen" , $type]
                        ])->update(["nama_dokumen" => $new_dokumen_name]);
                        if (!$update_dokumen) {
                            $this->failedUploadKegiatan($kumpulan_dokumen, $kegiatan, $file_type, $type);
                            // return response()->json(['data' => $update_dokumen, 'tes' => $kegiatan->fotoKegiatan()->where(["dokumentasi_kegiatan_id" => $kegiatan->id, "nama_foto_kegiatan" => $new_dokumen_name, "status_unggah_foto" => $type])->first()], 200);
                            // return $update_dokumen;
                            return false;
                        }
                       
                    } elseif($file_type == "image") {
                        $update_dokumen = $kegiatan->fotoKegiatan()->where([
                            ["nama_foto_kegiatan" , $new_dokumen_name], 
                            ["status_unggah_foto" , $type]
                        ])->update(["nama_foto_kegiatan" => $new_dokumen_name]);
                        if (!$update_dokumen) {
                            $this->failedUploadKegiatan($kumpulan_dokumen, $kegiatan, $file_type, $type);
                            // return $update_dokumen;
                            return false;
                        }
                    }
                    // unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$new_dokumen_name));
                    $simpan_file = $file_kegiatan->move('kegiatan/dokumentasi_kegiatan/' , $new_dokumen_name);
                    if (!$simpan_file) {
                        $this->failedUploadKegiatan($kumpulan_dokumen, $kegiatan, $file_type, $type);
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
                    $file_uploaded = $file_kegiatan->move('kegiatan/dokumentasi_kegiatan/', $new_dokumen_name);
                    if ($file_uploaded && $dokumen_final) {
                        continue;
                    } else {
                        //delete dokumen
                        if ($file_type == "dokumen") {
                            $this->failedUploadKegiatan($kumpulan_dokumen , $kegiatan, $file_type, $type);
                            // return Response::json(['errors' => ['Terjadi Kegagalan Dalam Menyimpan Dokumen, Silahkan Dicoba Kembali']], 422);
                            return false;
                        } elseif($file_type == "image"){
                            $this->failedUploadKegiatan($kumpulan_dokumen, $kegiatan, $file_type, $type);
                            return false;
                        }
                    }   
                }
            }
        }
        if (count($kumpulan_dokumen) == 0) {
            $kumpulan_dokumen = true;
            return $kumpulan_dokumen;
        } else {
            return $kumpulan_dokumen;
        }
    }

    private function failedUploadKegiatan($file, $kegiatan, $type, $status_unggah){
        if (count($file) > 0) {
            foreach ($file as $nama_file) {
                unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_file));
                if ($type == "dokumen") {
                    $kegiatan->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $kegiatan->id, "nama_dokumen" => $nama_file, "status_unggah_dokumen" => $status_unggah])->delete();
                    
                } elseif($type == "image"){
                    $kegiatan->fotoKegiatan()->where(["dokumentasi_kegiatan_id" => $kegiatan->id, "nama_foto_kegiatan" => $nama_file, "status_unggah_foto" => $status_unggah])->delete();
                }
            }
        }
        return true;
    }

    private function getFileUploadSize($file){
        $sizeAllDokumen = 0;
        foreach ($file as $documentFile) {
            $sizeAllDokumen += $documentFile->getSize();
        }
        return $sizeAllDokumen;
    }

    private function isFileSize($file){
        if ($file > 5120000) {
            return false;
        }
        return true;
    }

    private function fileArrTypeChecker($fileArr){
        if (gettype($fileArr) == 'boolean' && $fileArr) {
            $fileArr = [];
            return $fileArr;
        } elseif(gettype($fileArr) == 'array') {
            return $fileArr;
        }
    }

    private function getDataPPK($dataPPK){
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

    private function statusKegiatan($kegiatan, $status , $type){
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