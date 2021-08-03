<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Http\Controllers;

use App\DokumentasiKegiatan;
use App\Events\AjukanProposalKegiatanToKepalaSekolahEvent;
use App\Events\UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent;
use App\Http\Requests\PengajuanDokumentasiBaruRequest;
use App\Http\Requests\PengajuanDokumentasiKegiatanRequest;
use App\Http\Requests\PengajuanKegiatanUlangValidationRequest;
use App\Http\Requests\PengajuanKegiatanValidationRequest;
use App\PengajuanKegiatan;
use App\Repository\FindDataRepository;
use App\Services\DataPPKService;
use App\Services\FileUploadService;
use App\StatusKegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
class PJMengelolaKegiatanController extends Controller
{

    protected $findData;
    protected $fileService;
    public function __construct(FindDataRepository $findDataRepository, FileUploadService $fileUploadService)
    {
        $this->middleware('auth');
        $this->findData = $findDataRepository;
        $this->fileService = $fileUploadService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataPPKService $dataPPKService)
    {
        //
        $pengajuan_kegiatan = PengajuanKegiatan::with('statusKegiatan')->select('pengajuan_kegiatans.*')->where("user_id" , "=" , Auth::user()->id);        
        if (request()->ajax()) {        
            return datatables()->eloquent($pengajuan_kegiatan)->addColumn('statusKegiatan', function(PengajuanKegiatan $post) use($dataPPKService){
                $status = $post->StatusKegiatan->pluck('nama')->implode('<br>');
                $status_indikator = $dataPPKService->statusKegiatanPPK('Pengajuan', $status, 'Proposal Kegiatan');
                return $status_indikator;
            })
            ->addColumn('action_btn', function($data){
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
            })->editColumn('nilai_ppk', function($data) use ($dataPPKService){
                $nilai_ppk_kegiatan = json_decode($data->nilai_ppk);
                $data_ppk = $dataPPKService->showDataPPK($nilai_ppk_kegiatan);
                return $data_ppk;
            })
            ->rawColumns(['action_btn', 'statusKegiatan', 'nilai_ppk'])->make(true);
        }
        return view('pj.kelola_kegiatan.index');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengajuanKegiatanValidationRequest $request, DataPPKService $dataPPKService)
    {
        //
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
        $nama_dokumen_baru = $request->mulai_kegiatan."_Pengajuan-".$input['PJ_nama_kegiatan']."-".$name;
        $input['dokumen_kegiatan'] = $nama_dokumen_baru;
        $masuk_file = $this->fileService->storeSingleFile($file, $input['dokumen_kegiatan'], 'upload_proposal');
        if(gettype($masuk_file) == 'string'){
            $input['nilai_ppk'] = $this->countPPK($request->nilai_ppk);
            $input['user_id'] = Auth::user()->id;
            $input['keterangan_json'] = $dataPPKService->createKeteranganKegiatanPPK('Proposal');
            $input['nama_pj'] = Auth::user()->name;
            $statusDefault = StatusKegiatan::findOrFail(3);
            $kegiatan = PengajuanKegiatan::create($input);
            if (!$kegiatan) {
                $this->fileService->removeSingleFile($input['dokumen_kegiatan'], 'delete_upload_proposal');
                return Response::json(['errors' => ['Tidak dapat membentuk data Pengajuan Kegiatan, Silahkan coba kembali']], 422);
            }
            $statusSave = $kegiatan->StatusKegiatan()->save($statusDefault);
            if (!$statusSave) {
                $searchKegiatan = PengajuanKegiatan::where([
                    'PJ_nama_kegiatan' => $request->PJ_nama_kegiatan,
                    'user_id' => Auth::user()->id,
                    'nama_pj' => Auth::user()->name,
                    'kegiatan_berbasis' => $request->kegiatan_berbasis,
                    'mulai_kegiatan' => $request->mulai_kegiatan,
                    'akhir_kegiatan' => $request->akhir_kegiatan
                ])->first();
                $searchKegiatan->delete();
                $this->fileService->removeSingleFile($input['dokumen_kegiatan'], 'delete_upload_proposal');
                return Response::json(['errors' => ['Sistem gagal menyimpan Kegiatan, Silahkan Coba Kembali']], 422);
            }
            event(new AjukanProposalKegiatanToKepalaSekolahEvent($kegiatan, $statusDefault));
            return Response::json(['data' => 'data is valid'], 200);
        } elseif(gettype($masuk_file) == 'boolean' && !$masuk_file) {
            return Response::json(['errors' => ['Sistem gagal menyimpan File Dokumen, Silahkan Coba Lagi']], 422);
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
            $pengajuan_kegiatan = $this->findData->findDataModel($id, 'Proposal');
            if (gettype($pengajuan_kegiatan) == 'string') {
                return Response::json(['messages' => 'Data Pengajuan Kegiatan tidak dapat ditemukan, Silahkan Coba kembali dan kontak Admin! ID yang diberikan: '.$id." System error message: ".$pengajuan_kegiatan ], 404);
            }
            $status_proposal = $pengajuan_kegiatan->statusKegiatan()->first();
            $exists = Storage::disk('public')->exists('pengajuan_kegiatan/'.$pengajuan_kegiatan->dokumen_kegiatan);
            if ($exists) {
                return Response::json(['data' => $pengajuan_kegiatan, 'status_dokumen' => true , 'status_proposal' => $status_proposal ], 200);   
            } else {
                return Response::json(['data' => $pengajuan_kegiatan, 'status_dokumen' => false , 'status_proposal' => $status_proposal], 200);      
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
            $pengajuan_kegiatan = $this->findData->findDataModel($id, 'Proposal');
            if (gettype($pengajuan_kegiatan) == 'string') {
                return Response::json(['messages' => 'Data Pengajuan Kegiatan tidak dapat ditemukan, Silahkan Coba kembali dan kontak Admin! ID yang diberikan: '.$id." System error message: ".$pengajuan_kegiatan ], 404);
            }
            $exists = Storage::disk('public')->exists('pengajuan_kegiatan/'.$pengajuan_kegiatan->dokumen_kegiatan);
            if ($exists) {
                return Response::json(['data' => $pengajuan_kegiatan, 'status_dokumen' => true], 200);   
            } else {
                return Response::json(['data' => $pengajuan_kegiatan, 'status_dokumen' => false], 200);      
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
    public function update(PengajuanKegiatanUlangValidationRequest $request, $id)
    {
        //
        $pengajuan_ulang = $this->findData->findDataModel($id, 'Proposal');
        if (gettype($pengajuan_ulang) == 'string') {
            return Response::json(['messages' => 'Data Pengajuan Kegiatan tidak dapat ditemukan, Silahkan Coba kembali dan kontak Admin! ID yang diberikan: '.$id." System error message: ".$pengajuan_ulang ], 404);
        }        

        foreach ($pengajuan_ulang->StatusKegiatan as $status) {
            $statusSebelumnya = $status->pivot->status_kegiatan_id;
        }
        $input = $request->only([
            'PJ_nama_kegiatan',
            'nilai_ppk',
            'kegiatan_berbasis',
            'dokumen_kegiatan',
            'mulai_kegiatan',
            'akhir_kegiatan'
        ]);
        
        $file_lama = $pengajuan_ulang->dokumen_kegiatan;
       
        $file = $request->file('dokumen_kegiatan');
        $name = $file->getClientOriginalName();
        
        $nama_dokumen_ulang = $request->mulai_kegiatan."_Pengajuan_Kegiatan_Ulang-".$input['PJ_nama_kegiatan']."-".$name;
        $input['dokumen_kegiatan'] = $nama_dokumen_ulang;
        $input['user_id'] = Auth::user()->id;
        $input['nilai_ppk'] = $this->countPPK($request->nilai_ppk);
        $input['nama_pj'] = Auth::user()->name;
        $status_ulang = StatusKegiatan::findOrFail(3);
        $update_pengajuan = $pengajuan_ulang->update($input);
        if ($update_pengajuan) {
            $statusUpdate = $pengajuan_ulang->StatusKegiatan()->updateExistingPivot($statusSebelumnya, [
                'status_kegiatan_id' => $status_ulang->id
            ]);
            if (!$statusUpdate) {
                return response()->json(['data' => 'data is not valid', 'errors' => ['Tidak dapat memproses data, silahkan mencoba lagi']], 422);   
            }
            $this->fileService->removeSingleFile($file_lama, 'delete_upload_proposal');
            $this->fileService->storeSingleFile($file, $input['dokumen_kegiatan'], 'upload_proposal');
            event(new AjukanProposalKegiatanToKepalaSekolahEvent($pengajuan_ulang, $status_ulang));
            return response()->json(['data' => 'data is valid'], 200);
        } else {
            return response()->json(['data' => 'data is not valid', 'errors' => ['Tidak dapat memproses data, silahkan mencoba lagi']], 422);
        }
    
    }

    /**
     * //Khusus Fungsionalitas Unggah Dokumentasi
     */

    public function indexDokumentasi(DataPPKService $dataPPKService){

        $user_id = Auth::user()->id;
        $dokumentasi_kegiatan_status = DokumentasiKegiatan::with('statusKegiatan')->select('dokumentasi_kegiatans.*')->where('user_id' , '=' , $user_id);     
        if (request()->ajax()) {
            return datatables()->eloquent($dokumentasi_kegiatan_status)->addColumn('statusKegiatan', function(DokumentasiKegiatan $dokumentasi_kegiatan) use($dataPPKService){
                $status =  $dokumentasi_kegiatan->statusKegiatan->pluck('nama')->implode('<br>');
                $status_indikator = $dataPPKService->statusKegiatanPPK('Dokumentasi',$status, $dokumentasi_kegiatan->tipe_kegiatan);
                return $status_indikator;
            })->addColumn('action_btn', function($data){
                foreach ($data->statusKegiatan as $status) {
                    if ($status->pivot->status_kegiatanable_type == "App\DokumentasiKegiatan") {
                        if ($status->pivot->status_kegiatanable_id == $data->id && $status->pivot->status_kegiatan_id == 6) {
                            $button = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm status_pengajuan rounded-pill" value ="sudah_unggah">Lihat Detail</button>';
                        }
                        elseif ($status->pivot->status_kegiatanable_id == $data->id && $status->pivot->status_kegiatan_id == 2) {
                           
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
            })->editColumn('nilai_ppk', function($data) use ($dataPPKService){
                $data_nilai = json_decode($data->nilai_ppk);
                $data_ppk = $dataPPKService->showDataPPK($data_nilai);
                return $data_ppk; 
            })
            ->rawColumns(['statusKegiatan', 'action_btn', 'nilai_ppk'])->make(true);
        }   
            return view('pj.dokumentasi_kegiatan.index');
    }


    public function editDokumentasi($id){
        if (request()->ajax()) {
            $dokumentasi_kegiatan = $this->findData->findDataModel($id, 'Laporan');
            if (gettype($dokumentasi_kegiatan) == 'string') {
                return Response::json(['messages' => 'Data Pengajuan Kegiatan tidak dapat ditemukan, Silahkan Coba kembali dan kontak Admin! ID yang diberikan: '.$id." System error message: ".$dokumentasi_kegiatan ], 404);
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
            $dokumentasi_kegiatan = $this->findData->findDataModel($id, 'Laporan');
            if (gettype($dokumentasi_kegiatan) == 'string') {
                return Response::json(['messages' => 'Data Pengajuan Kegiatan tidak dapat ditemukan, Silahkan Coba kembali dan kontak Admin! ID yang diberikan: '.$id." System error message: ".$dokumentasi_kegiatan ], 404);
            }
            $nilai_ppk_kegiatan = json_decode($dokumentasi_kegiatan->nilai_ppk);
            $dokumen = $dokumentasi_kegiatan->dokumenKegiatan()->get();
            $image = $dokumentasi_kegiatan->fotoKegiatan()->get();
        
            foreach($dokumentasi_kegiatan->statusKegiatan as $status){
                $status_kegiatan  = $status->pivot->status_kegiatan_id;
            }
            if (count($dokumen) > 0 || count($image) > 0) {
                if($status_kegiatan == 3 || $status_kegiatan == 6) {
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

    public function uploadDokumentasiBaru(PengajuanDokumentasiBaruRequest $request,  DataPPKService $dataPPKService){
       
        $file = $request->file('dokumentasi_kegiatan_ppk');
        $img = $request->file('image_kegiatan_ppk');
        
        $isDokumenUploaded = $this->fileService->isFileUploaded($file, 'dokumen');
        $isImageUploaded = $this->fileService->isFileUploaded($img, 'foto');
        if (gettype($isDokumenUploaded) == 'object') {
            if(gettype($isImageUploaded) == 'object'){
                return Response::json(['errors' => ['Tidak Terdapat Unggah Dokumen Laporan Kegiatan & Dokumentasi Kegiatan, Silahkan Unggah Laporan dan Dokumentasi Kegiatan dengan ekstensi dan ukuran file sesuai dengan ketentuan!']], 422);
            }
            return $isDokumenUploaded;
        } elseif(gettype($isImageUploaded) == 'object') {
            return $isImageUploaded;
        }
        
        $documentCheck = $this->fileService->isFileSize($file);
        $imageCheck = $this->fileService->isFileSize($img);
        if (gettype($documentCheck) == 'object') {
            return $documentCheck;
        }elseif (gettype($imageCheck) == 'object') {
            return $imageCheck;
        }
        
        $keterangan_json = $dataPPKService->createKeteranganKegiatanPPK('Laporan');
        
        $videoLinks = $this->dataLinks($request->add_link_video);
        $articleLinks = $this->dataLinks($request->add_link_article);

        $dokumentasi_kegiatan_baru = new DokumentasiKegiatan([
            "nama_kegiatan" => $request->nama_kegiatan,
            "user_id" => Auth::user()->id,
            "nama_pj" => Auth::user()->name,
            "mulai_kegiatan" => $request->mulai_kegiatan,
            "akhir_kegiatan" => $request->akhir_kegiatan,
            "nilai_ppk" => $this->countPPK($request->nilai_ppk),
            "kegiatan_berbasis" => $request->kegiatan_berbasis,
            "keterangan_dokumentasi" => $keterangan_json,
            "add_link_video" => $videoLinks,
            "add_link_article" => $articleLinks,
            "tipe_kegiatan" => 'Pengajuan Historis'
        ]);
        $create_dokumentasi = $dokumentasi_kegiatan_baru->save();
            if ($create_dokumentasi) {
                $cari_dokumentasi = DokumentasiKegiatan::where([
                    "nama_kegiatan" => $request->nama_kegiatan,
                    "user_id" => Auth::user()->id,
                    "nama_pj" => Auth::user()->name,
                    "kegiatan_berbasis" => $request->kegiatan_berbasis,
                    "mulai_kegiatan" => $request->mulai_kegiatan,
                    "akhir_kegiatan" => $request->akhir_kegiatan,
                    "keterangan_dokumentasi" => $keterangan_json,
                    "tipe_kegiatan" => 'Pengajuan Historis'
                ])->first();
               
                $kumpulan_dokumen = $this->fileService->multipleStoreDataFileKegiatan($file, $cari_dokumentasi, "Pengajuan Historis", "dokumen");
                if (!$kumpulan_dokumen || gettype($kumpulan_dokumen) == 'object') {
                    $dokumentasi_kegiatan_baru->delete();
                    return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Laporan dan Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
                }
                $kumpulan_foto = $this->fileService->multipleStoreDataFileKegiatan($img, $cari_dokumentasi, "Pengajuan Historis", "image");
                if (!$kumpulan_foto || gettype($kumpulan_foto) == 'object') {
                    $res_kumpulan_dokumen = $this->fileService->fileArrTypeChecker($kumpulan_dokumen);
                    $this->fileService->removeKumpulanDataFile($res_kumpulan_dokumen, $cari_dokumentasi, "dokumen", "Pengajuan Historis");
                    $dokumentasi_kegiatan_baru->delete();
                    return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Laporan dan Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
                }
               
                $res_kumpulan_dokumen = $this->fileService->fileArrTypeChecker($kumpulan_dokumen);
                $res_kumpulan_foto = $this->fileService->fileArrTypeChecker($kumpulan_foto);
                $statusDefault = StatusKegiatan::findOrFail(6);
                $save_status = $cari_dokumentasi->statusKegiatan()->save($statusDefault);
                if (!$save_status) {
                   
                    $this->fileService->removeKumpulanDataFile($res_kumpulan_dokumen, $cari_dokumentasi, "dokumen", "Pengajuan Historis");
                    $this->fileService->removeKumpulanDataFile($res_kumpulan_foto, $cari_dokumentasi, "image", "Pengajuan Historis");
                    $dokumentasi_kegiatan_baru->delete();
                    return Response::json(['errors' => ['Tidak Berhasil Membentuk Dokumentasi dan unggah Dokumen Kegiatan, Silahkan Coba Kembali']], 422);
                }
                event(new UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent($dokumentasi_kegiatan_baru, $statusDefault));
                return Response::json(['message' => 'data is valid' , 'notification' => 'Berhasil Mengunggah Laporan Kegiatan Historis'], 200);
            } else {
                $dokumentasi_kegiatan_baru->delete();
                return Response::json(['errors' => ['Tidak Berhasil Membentuk Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
            }
    }

    public function uploadDokumentasi(PengajuanDokumentasiKegiatanRequest $request, $id){
        $dokumentasi_kegiatan = $this->findData->findDataModel($id, 'Laporan');
        if (gettype($dokumentasi_kegiatan) == 'string') {
            return Response::json(['messages' => 'Data Pengajuan Kegiatan tidak dapat ditemukan, Silahkan Coba kembali dan kontak Admin! ID yang diberikan: '.$id." System error message: ".$dokumentasi_kegiatan ], 404);
        }
        $file = $request->file('dokumentasi_kegiatan_ppk');
        $img = $request->file('image_kegiatan_ppk');
       
        $isDokumenUploaded = $this->fileService->isFileUploaded($file, 'dokumen');
        $isImageUploaded = $this->fileService->isFileUploaded($img, 'foto');
        if (gettype($isDokumenUploaded) == 'object') {
            if(gettype($isImageUploaded) == 'object'){
                return Response::json(['errors' => ['Tidak Terdapat Unggah Dokumen Laporan Kegiatan & Dokumentasi Kegiatan, Silahkan Unggah Laporan dan Dokumentasi Kegiatan dengan ekstensi dan ukuran file sesuai dengan ketentuan!']], 422);
            }
            return $isDokumenUploaded;
        } elseif(gettype($isImageUploaded) == 'object') {
            return $isImageUploaded;
        }
        
        $documentCheck = $this->fileService->isFileSize($file);
        $imageCheck = $this->fileService->isFileSize($img);
        if (gettype($documentCheck) == 'object') {
            return $documentCheck;
        }elseif (gettype($imageCheck) == 'object') {
            return $imageCheck;
        }
        $input['add_link_video'] = $this->dataLinks($request->add_link_video);
        $input['add_link_article']= $this->dataLinks($request->add_link_article);
       
        foreach ($dokumentasi_kegiatan->statusKegiatan as $status) {
            $statusSebelumnya = $status->pivot->status_kegiatan_id;
        }
        $status_update = StatusKegiatan::findOrFail(3);
               
        $kumpulan_dokumen = $this->fileService->multipleStoreDataFileKegiatan($file, $dokumentasi_kegiatan, "Pengajuan", "dokumen");
        if (!$kumpulan_dokumen || gettype($kumpulan_dokumen) == 'object') {
            return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Laporan Dokumen Kegiatan, Silahkan Coba Kembali']], 422);
        }
        $kumpulan_foto = $this->fileService->multipleStoreDataFileKegiatan($img, $dokumentasi_kegiatan, "Pengajuan" , "image");
        if (!$kumpulan_foto || gettype($kumpulan_foto) == 'object') {
            $res_kumpulan_dokumen = $this->fileService->fileArrTypeChecker($kumpulan_dokumen);
            $this->fileService->removeKumpulanDataFile($res_kumpulan_dokumen, $dokumentasi_kegiatan, "dokumen", "Pengajuan");
            return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Laporan Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
        }
      
        $res_kumpulan_dokumen = $this->fileService->fileArrTypeChecker($kumpulan_dokumen);
        $res_kumpulan_foto = $this->fileService->fileArrTypeChecker($kumpulan_foto);
        $updateLinksDokumentasi = $dokumentasi_kegiatan->update($input); 
        if (!$updateLinksDokumentasi) {
            $this->fileService->removeKumpulanDataFile($res_kumpulan_dokumen , $dokumentasi_kegiatan , "dokumen", "Pengajuan");
            $this->fileService->removeKumpulanDataFile($res_kumpulan_foto, $dokumentasi_kegiatan, "image", "Pengajuan");
            return Response::json(['errors' => ['sistem tidak dapat memproseskan data, silahkan dicoba kembali']], 422); 
        }
        
        $status_update_dokumentasi = $dokumentasi_kegiatan->statusKegiatan()->updateExistingPivot($statusSebelumnya, [
            'status_kegiatan_id' => $status_update->id
        ]);
        if (!$status_update_dokumentasi) {
          
            $this->fileService->removeKumpulanDataFile($res_kumpulan_dokumen , $dokumentasi_kegiatan , "dokumen", "Pengajuan");
            $this->fileService->removeKumpulanDataFile($res_kumpulan_foto, $dokumentasi_kegiatan, "image", "Pengajuan");
            return Response::json(['errors' => ['sistem tidak dapat memproseskan data, silahkan dicoba kembali']], 422); 
        }
        event(new UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent($dokumentasi_kegiatan, $status_update));
        return Response::json(['message' => 'data is valid', 'notification' => 'Berhasil Mengunggah Laporan Kegiatan'], 200);
    
    }
   
    public function uploadDokumentasiUlang(PengajuanDokumentasiKegiatanRequest $request, $id){
        $dokumentasi_ulang = $this->findData->findDataModel($id, 'Laporan');
        if (gettype($dokumentasi_ulang) == 'string') {
            return Response::json(['messages' => 'Data Pengajuan Kegiatan tidak dapat ditemukan, Silahkan Coba kembali dan kontak Admin! ID yang diberikan: '.$id." System error message: ".$dokumentasi_ulang ], 404);
        }
        $tempFileDocs = [];
        $tempFileImg = [];
        $file_dokumen_lama = [];
        $file_img_lama = [];
        $file = $request->file('dokumentasi_kegiatan_ppk');
        $img = $request->file('image_kegiatan_ppk');
        
        $isDokumenUploaded =$this->fileService->isFileUploaded($file, 'dokumen');
        $isImageUploaded = $this->fileService->isFileUploaded($img, 'foto');
        if (gettype($isDokumenUploaded) == 'object') {
            if(gettype($isImageUploaded) == 'object'){
                return Response::json(['errors' => ['Tidak Terdapat Unggah Dokumen Laporan Kegiatan & Dokumentasi Kegiatan, Silahkan Unggah Laporan dan Dokumentasi Kegiatan dengan ekstensi dan ukuran file sesuai dengan ketentuan!']], 422);
            }
            return $isDokumenUploaded;
        } elseif(gettype($isImageUploaded) == 'object') {
            return $isImageUploaded;
        }
        $documentCheck = $this->fileService->isFileSize($file);
        $imageCheck = $this->fileService->isFileSize($img);
        if (gettype($documentCheck) == 'object') {
            return $documentCheck;
        }elseif (gettype($imageCheck) == 'object') {
            return $imageCheck;
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
        $input['add_link_video'] = $this->dataLinks($request->add_link_video);
        $input['add_link_article'] = $this->dataLinks($request->add_link_article);
             
        foreach ($dokumentasi_ulang->statusKegiatan as $status) {
            $statusSebelumnya = $status->pivot->status_kegiatan_id;
        }
        $status_update = StatusKegiatan::findOrFail(3);
            $kumpulan_dokumen = $this->fileService->multipleStoreDataFileKegiatan($file, $dokumentasi_ulang, $status_unggah_laporan, "dokumen");
            if (!$kumpulan_dokumen || gettype($kumpulan_dokumen) == 'object') {
                return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumen Kegiatan, Silahkan Coba Kembali']], 422);
            }
            $kumpulan_foto = $this->fileService->multipleStoreDataFileKegiatan($img, $dokumentasi_ulang, $status_unggah_laporan , "image");
            if (!$kumpulan_foto || gettype($kumpulan_foto) == 'object') {
                $res_kumpulan_dokumen = $this->fileService->fileArrTypeChecker($kumpulan_dokumen);
                $this->fileService->removeKumpulanDataFile($res_kumpulan_dokumen, $dokumentasi_ulang, "dokumen", $status_unggah_laporan);
                return Response::json(['errors' => ['Tidak Dapat Menyimpan Data Dokumentasi Kegiatan, Silahkan Coba Kembali']], 422);
            }
            $res_kumpulan_dokumen = $this->fileService->fileArrTypeChecker($kumpulan_dokumen);
            $res_kumpulan_foto = $this->fileService->fileArrTypeChecker($kumpulan_foto);
            $update_links_dokumentasi = $dokumentasi_ulang->update($input);
            if (!$update_links_dokumentasi) {
                $this->fileService->removeKumpulanDataFile($res_kumpulan_dokumen, $dokumentasi_ulang, "dokumen", $status_unggah_laporan);
                $this->fileService->removeKumpulanDataFile($res_kumpulan_foto, $dokumentasi_ulang, "image", $status_unggah_laporan);
                return response()->json(['errors' => ['Sistem Tidak Dapat Menyimpan Pengajuan Ulang Laporan Kegiatan, Silahkan Coba Kembali']], 422);
            }
            $pembuatan_laporan_kegiatan = $this->storePengajuanUlangLaporanKegiatan($dokumentasi_ulang, $file_dokumen_lama, $file_img_lama, $tempFileDocs, $tempFileImg, $statusSebelumnya , $status_unggah_laporan, $status_update);
            if (!$pembuatan_laporan_kegiatan) {
                $this->fileService->removeKumpulanDataFile($res_kumpulan_dokumen, $dokumentasi_ulang, "dokumen", $status_unggah_laporan);
                $this->fileService->removeKumpulanDataFile($res_kumpulan_foto, $dokumentasi_ulang, "image", $status_unggah_laporan);
                return response()->json(['errors' => ['Sistem Tidak Dapat Menyimpan Pengajuan Ulang Laporan Kegiatan, Silahkan Coba Kembali']], 422);
            }
            event(new UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent($dokumentasi_ulang , $status_update));
            return response()->json(['data' => 'Sukses Pengajuan Ulang Laporan Kegiatan'], 200);
    }

    private function storePengajuanUlangLaporanKegiatan($data_laporan, $dokumen_laporan_sebelumnya, $foto_kegiatan_sebelumnya, $tempDokumen, $tempFoto, $status_laporan_sebelumnya , $statusUnggah, $status_baru){
        $update_pivot = $data_laporan->statusKegiatan()->updateExistingPivot($status_laporan_sebelumnya, [
            'status_kegiatan_id' => $status_baru->id
        ]);
        if ($update_pivot) {
            foreach ($dokumen_laporan_sebelumnya as $key => $docsName) {
                foreach ($tempDokumen as $value) {
                    if ($value == $docsName) {
                        unset($dokumen_laporan_sebelumnya[$key]);
                    }
                }
            }
            $this->fileService->removeKumpulanDataFile($dokumen_laporan_sebelumnya, $data_laporan, "dokumen" , $statusUnggah);
            
            foreach ($foto_kegiatan_sebelumnya as $key => $foto_hapus) {
                foreach ($tempFoto as $value) {
                    if ($value == $foto_hapus) {
                        unset($foto_kegiatan_sebelumnya[$key]);
                    }
                }
            }
            $this->fileService->removeKumpulanDataFile($foto_kegiatan_sebelumnya, $data_laporan, "image" , $statusUnggah); 
            $data_laporan->touch();
            return true;
        } else {
            return false;
        }
    }

    private function countPPK($nilaiPPK){
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

    private function dataLinks($linkRequest){
        $links = [];
        $jsonStore = [];
        $numberOfLinks = 1;
        foreach ($linkRequest as $key => $values) {
           $links[$values] = true;
        }
        $links = array_keys($links);
        foreach ($links as $linkData) {
            $jsonStore [] = array(
                'no' => $numberOfLinks,
                'link_data' => $linkData,
            );
            $numberOfLinks++;
        }
        $jsonData = json_encode($jsonStore);
        return $jsonData;
    }

}