<?php

namespace App\Http\Controllers;

use App\AssessmentInternal;
use App\DokumenAsesmen;
use App\Http\Requests\InformasiAssessmenInternalRequest;
use App\Http\Requests\InformasiAssessmenInternalUpdateRequest;
use App\Http\Requests\UpdateDokumenAsesmenRequest;
use App\KategoriAsesmen;
use App\PenjelasanAsesmen;
use App\Repository\FindDataRepository;
use App\Services\FileUploadService;
// use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class KepalaSekolahAssessmenController extends Controller
{

    protected $findData;
    public function __construct(FindDataRepository $findDataRepository)
    {
        $this->middleware('auth');        
        $this->findData = $findDataRepository;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $assessmen_internal = AssessmentInternal::with('user')->where("user_id", "=", Auth::user()->id)->get();
        if (request()->ajax()) {
            return datatables()->of($assessmen_internal)->addColumn('Aksi', function($data_asesmen){
                $aksi = '<button type="button" name="show" id="'.$data_asesmen->id.'" class="btn btn-warning btn-sm show rounded-pill mb-2 mr-2" value="asesmen">Lakukan Asesmen</button>';
                // $aksi.= '&nbsp;&nbsp;';
                $aksi.= '<button type="button" id="'.$data_asesmen->id.'"class="btn btn-sm btn-info show rounded-pill mb-2 mr-2 " value="lihat_table">Lihat Skor</button>';
                // $aksi.= '&nbsp;&nbsp;';
                $aksi.= '<button type="button" id="'.$data_asesmen->id.'"class="btn btn-sm btn-danger delete_asesmen rounded-pill mb-2">Hapus Asesmen</button>';
                return $aksi;
            })->editColumn('created_at', function($data_asesmen){
                return $data_asesmen->created_at->timezone('Asia/Jakarta')->toDateTimeString();
            })->editColumn('updated_at', function($data_asesmen){
                return $data_asesmen->updated_at->timezone('Asia/Jakarta')->toDateTimeString();
            })
            ->rawColumns(['Aksi'])->make(true);
        }
        return view('kepsek.asesmen.index');
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
    public function store(InformasiAssessmenInternalRequest $request)
    {
        //
        // return $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['nama_sekolah'] = $request->nama_sekolah;
        $input['alamat_sekolah'] = $request->alamat_sekolah;
        $input['nama_kepsek'] = $request->nama_kepsek;
        $input['nomor_hp'] = $request->no_hp;
        $input['email_kepsek'] = $request->email_kepsek;
        $input['indikator_skor_penilaian_ppk'] = $this->create_json_assessmen_internal();
        $input['rerata_indikator_1'] = 0;
        $input['rerata_indikator_2'] = 0;
        $input['rerata_indikator_3'] = 0;
        $input['rerata_indikator_4'] = 0;
        $input['rerata_indikator_5'] = 0;
        $input['rerata_indikator_6'] = 0;
        $input['rerata_indikator_7'] = 0;
        $input['rerata_indikator_8'] = 0;
        $input['rerata_indikator_9'] = 0;
        $input['rerata_indikator_10'] = 0;
        $input['skor_penilaian_kegiatan_akhir'] = 0;
        $simpan = AssessmentInternal::create($input);
        if ($simpan) {
            $id_assessmen = $simpan->id;
            return Response::json(['message' => 'data is valid', 'url'=> $id_assessmen], 200);
        }
        else{
            return Response::json(['message' => 'data is not valid', 'errors' => ["Terjadi Kendala Saat melakukan Penyimpanan, Silahkan Coba Kembali"]], 422);
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
        $assessmen_internal =  $this->findData->findDataModel($id, 'Asesmen');
        if (gettype($assessmen_internal) == 'string') {
            return response()->json(['message' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id.', System Error Message: '. $assessmen_internal], 404);
        }

        $assessment_json = json_decode($assessmen_internal->indikator_skor_penilaian_ppk);
        $dokumen = $assessmen_internal->dokumenAsesmen()->get();
        $id_asesmen = $id;
        $kategori_asesmen = KategoriAsesmen::all();
        // $get_kategori = KategoriAsesmen::all();
        // return view('kepsek.asesmen.show', compact('assessmen_internal', 'assessment_json', 'dokumen' , 'id_asesmen' , 'get_kategori'));
        return view('kepsek.asesmen.show', compact('assessmen_internal', 'assessment_json', 'dokumen' , 'id_asesmen', 'kategori_asesmen'));
    }

    public function getSaranSkorDanDokumenAsesmen($id_asesmen, $indikator_asesmen , $skor_asesmen){
        if (request()->ajax()) {
            $asesmen_internal =  $this->findData->findDataModel($id_asesmen, 'Asesmen');
            $penjelasan_asesmen = $this->findData->findDataModel($indikator_asesmen, 'Penjelasan');
            if (gettype($asesmen_internal) == 'string') {
                return response()->json(['message' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id_asesmen.', System Error Message: '. $asesmen_internal], 404);
            } elseif(gettype($penjelasan_asesmen) == 'string'){
                return response()->json(['message' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$indikator_asesmen.', System Error Message: '. $penjelasan_asesmen], 404);
            }
           
            $penjelasan_asesment_dilakukan = $penjelasan_asesmen->penjelasan_asesmen;
            $keterangan_skor_indikator = $penjelasan_asesmen->KeteranganSkor()->get();
            foreach ($keterangan_skor_indikator as $item_skor) {
                $informasi_skor_asesmen = json_decode($item_skor->keterangan_skor);
            }
            $dokumen_asesmen = $asesmen_internal->dokumenAsesmen()->where('body_indikator_dokumen', '=', intval($indikator_asesmen))->get();
            foreach ($informasi_skor_asesmen as $key) {                               
                if ($key->no == $skor_asesmen) {
                    if ($skor_asesmen == 4 && $key->no ==4) {
                        $get_saran = "Sudah Mencapai Skor Maksimum";
                    }
                        $get_keterangan_skor = $key->keterangan_skor;
                }  
                elseif($key->no+1 > $skor_asesmen){
                    $get_saran = $key->keterangan_skor;
                    break;
                }
            }
            $json_skor_penilaian = json_decode($asesmen_internal->indikator_skor_penilaian_ppk);
            foreach ($json_skor_penilaian as $item_skor_akhir) {
                if ($item_skor_akhir->no == $indikator_asesmen) {
                    if ($item_skor_akhir->penjelasan_assessment == "") {
                        $get_status_asesmen = $item_skor_akhir->penjelasan_assessment;
                    } elseif($item_skor_akhir->penjelasan_assessment != ""){
                        $get_status_asesmen = $item_skor_akhir->penjelasan_assessment;
                    }
                }
            }
            return Response::json(['data_dokumen' => $dokumen_asesmen, 'keterangan_skor' => $get_keterangan_skor , 'saran' => $get_saran , 'status_asesmen' => $get_status_asesmen , 'penjelasan_asesmen' => $penjelasan_asesment_dilakukan],200);    
        }
    }

    public function ambil_data_detail_asesmen($id_asesmen, $body_indikator_dokumen){
        //ambil dokumen terkait asesmen
        if (request()->ajax()) {
            // if (Auth::check()) {
                $assessmen_internal =  $this->findData->findDataModel($id_asesmen, 'Asesmen');
                $penjelasan_asesmen = $this->findData->findDataModel($body_indikator_dokumen, 'Penjelasan');
                if (gettype($assessmen_internal) == 'string') {
                    return response()->json(['message' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id_asesmen.', System Error Message: '. $assessmen_internal], 404);
                } elseif(gettype($penjelasan_asesmen) == 'string'){
                    return response()->json(['message' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$body_indikator_dokumen.', System Error Message: '. $penjelasan_asesmen], 404);
                }
                $keterangan_skor = $penjelasan_asesmen->KeteranganSkor()->get();
                foreach ($keterangan_skor as $item_skor) {
                    $informasi_skor_asesmen = json_decode($item_skor->keterangan_skor);
                }
                $dokumen = $assessmen_internal->dokumenAsesmen()->where('body_indikator_dokumen', '=' , intval($body_indikator_dokumen))->get();
                $json_assessmen = json_decode($assessmen_internal->indikator_skor_penilaian_ppk);
                foreach ($json_assessmen as $ambil_penjelasan) {
                    if ($ambil_penjelasan->no == $body_indikator_dokumen) {                       
                        $histori_asesmen = $ambil_penjelasan->penjelasan_assessment;
                        return Response::json(['data' => $dokumen , 'penjelasan_skor' => $informasi_skor_asesmen , 'penjelasan_asesmen' => $penjelasan_asesmen , 'histori_asesmen' => $histori_asesmen], 200);           
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
        $assessment =  $this->findData->findDataModel($id, 'Asesmen');
        if (gettype($assessment) == 'string') {
            return response()->json(['message' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id.', System Error Message: '. $assessment], 404);
        }

        $penjelasan_asesmen = PenjelasanAsesmen::all();
        $kategori_asesmen = KategoriAsesmen::all();
        $json_assessmen = json_decode($assessment->indikator_skor_penilaian_ppk);

        return view('kepsek.asesmen.edit', compact('assessment' , 'json_assessmen' , 'penjelasan_asesmen' , 'kategori_asesmen' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InformasiAssessmenInternalUpdateRequest $request, FileUploadService $fileUploadService, $id)
    {
        //     
        $assessmen_internal =  $this->findData->findDataModel($id, 'Asesmen');
        if (gettype($assessmen_internal) == 'string') {
            return response()->json(['message' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id.', System Error Message: '. $assessmen_internal], 404);
        }   
        $file = $request->file('file'); 
        $skor_1 = 0;
        $skor_2 = 0;
        $skor_3 = 0;
        $skor_4 = 0;
        $skor_5 = 0;
        $skor_6 = 0;
        $skor_7 = 0;
        $skor_8 = 0;
        $skor_9 = 0;
        $skor_10 = 0;
        $skor_akhir = 0;
        $kumpulan_dokumen = [];
        $json_assessmen = json_decode($assessmen_internal->indikator_skor_penilaian_ppk);
        foreach ($json_assessmen as $item) {
            if ($item->no == $request->assessment) {
                $item->skor_penilaian_assessment = intval($request->indikator);
                $item->penjelasan_assessment = $request->penjelasan_assessment;
            }
            else{
                continue;
            }
        }

        //rerata skor + kalkulasi skor akhir berdasarkan indikator-indikator asesmen
        foreach ($json_assessmen as $skor) {
            if ($skor->no >= 1 && $skor->no <= 5) {
                $skor_1 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 5 && $skor->no <= 8){
                $skor_2 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 8 && $skor->no <=11){
                $skor_3 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 11 && $skor->no <= 14){
                $skor_4 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 14 && $skor->no <= 21){
                $skor_5 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 21 && $skor->no <= 25){
                $skor_6 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 25 && $skor->no <= 29){
                $skor_7 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 29 && $skor->no <= 35){
                $skor_8 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 35 && $skor->no <= 40){
                $skor_9 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 40 && $skor->no <= 49){
                $skor_10 += $skor->skor_penilaian_assessment;
            }
        }
        $hasil_json = json_encode($json_assessmen);
        $skor_akhir = $this->calculateScore($skor_1, $skor_2, $skor_3, $skor_4, $skor_5 , $skor_6, $skor_7 , $skor_8 , $skor_9, $skor_10);
        $input['indikator_skor_penilaian_ppk'] = $hasil_json;
        $input['rerata_indikator_1'] = $skor_1 / 5;
        $input['rerata_indikator_1'] = $skor_1 / 5;
        $input['rerata_indikator_2'] = $skor_2 / 3;
        $input['rerata_indikator_3'] = $skor_3 / 3;
        $input['rerata_indikator_4'] = $skor_4 / 3;
        $input['rerata_indikator_5'] = $skor_5 / 7;
        $input['rerata_indikator_6'] = $skor_6 / 4;
        $input['rerata_indikator_7'] = $skor_7 / 4;
        $input['rerata_indikator_8'] = $skor_8 / 6;
        $input['rerata_indikator_9'] = $skor_9 / 5;
        $input['rerata_indikator_10'] = $skor_10 / 9;
        $input['skor_penilaian_kegiatan_akhir'] = $skor_akhir;
        
        if (is_null($file)) {
            $is_dokumen_uploaded = $assessmen_internal->dokumenAsesmen()->where([['body_indikator_dokumen' , '=' , $request->assessment]])->get();
            if (count($is_dokumen_uploaded) == 0) {
                return Response::json(['errors' => ['Indikator ini belum terdapat File yang diunggah, silahkan mengunggah file dengan ekstensi .pdf']], 422);
            }
            //jika sudah melakukan asesmen
            elseif(count($is_dokumen_uploaded) > 0){
                $update = $assessmen_internal->update($input);
                if (!$update) {
                    return Response::json(['errors' => ['Terdapat Kendala saat menyimpan asesmen, Silahkan coba kembali']], 422);
                }
                return Response::json(['message' => 'data is valid'], 200);
            }
        }

        $documentCheck = $fileUploadService->isFileSize($file);
        if (gettype($documentCheck) == 'object') {
            return $documentCheck;
        }
        
        
        //strictly for storing skor dan upload dokumen
        /** Revision Code Here */
        $kumpulan_dokumen = $fileUploadService->multipleStoreFileKegiatan($file, $assessmen_internal, 'Asesmen', 'dokumenAsesmen', $request->assessment);
        if (gettype($kumpulan_dokumen) == 'object') {
            return $kumpulan_dokumen;
        }
        // foreach ($file as $unggah_dokumen) {
        //     $file_default_name =  $this->dokumenAsesmenNamingScheme($request->assessment, $assessmen_internal,$unggah_dokumen->getClientOriginalName());
        //     $checker  = $assessmen_internal->dokumenAsesmen()->where([
        //         ['nama_dokumen_asesmen' , '=', $file_default_name],
        //         ['body_indikator_dokumen', '=' , $request->assessment]
        //     ])->first();
        //         if (file_exists(public_path('kegiatan/asesmen_internal/'.$file_default_name)) && !is_null($checker)) {
                  
        //             $assessmen_internal->dokumenAsesmen()->where([
        //                 ['nama_dokumen_asesmen' , '=', $file_default_name],
        //                 ['body_indikator_dokumen', '=' , $request->assessment]
        //             ])->touch();
        //             $dokumen_update = $unggah_dokumen->move('kegiatan/asesmen_internal', $file_default_name);
        //             if (!$dokumen_update) {
                      
        //                 $fileUploadService->removeKumpulanFile($kumpulan_dokumen, $assessmen_internal, 'asesmen', $request->assessment);
        //                 return Response::json(['message'=>'data is not valid' , ['errors' => 'File tidak berhasil diunggah, Silahkan Coba Kembali']], 422);
        //             }
                   
        //         } 
        //         else {
        //             $kumpulan_dokumen [] = $file_default_name;
        //             $dokumen = new DokumenAsesmen([
        //                 'assessment_internal_id' => $id,
        //                 'nama_dokumen_asesmen' => $file_default_name,
        //                 'body_indikator_dokumen' => $request->assessment
        //             ]);
        //             $upload_file = $unggah_dokumen->move('kegiatan/asesmen_internal/', $file_default_name);
        //             $add_dokumen = $assessmen_internal->dokumenAsesmen()->save($dokumen);
        //             if ($upload_file && $add_dokumen) {
        //                 continue;
        //             } else {
        //                 $fileUploadService->removeKumpulanFile($kumpulan_dokumen, $assessmen_internal, 'asesmen', $request->assessment);
        //                 return Response::json(['errors' => ['File Tidak berhasil diunggah, silahkan coba kembali']], 422);
        //             }
        //         }
        //     }
        $update = $assessmen_internal->update($input);
        if ($update) {
            return Response::json(['message' => 'data is valid'], 200);
        } else {
            $res_kumpulan_dokumen = $fileUploadService->fileArrTypeChecker($kumpulan_dokumen);
            $fileUploadService->removeKumpulanFile($res_kumpulan_dokumen, $assessmen_internal, 'asesmen', $request->assessment);
            return Response::json(['message'=>'data is not valid' , ['errors' => 'Tidak dapat melakukan Update Penilaian, Silahkan Coba Kembali']], 422);
        }
    }

    public function updateDokumen(UpdateDokumenAsesmenRequest $request , $file_name, $body_indikator_asesmen , $id_asesmen){
        $asesmen_internal =  $this->findData->findDataModel($id_asesmen, 'Asesmen');
        if (gettype($asesmen_internal) == 'string') {
            return response()->json(['message' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id_asesmen.', System Error Message: '. $asesmen_internal], 404);
        }  
      
        $dokumenSimpan = $asesmen_internal->dokumenAsesmen()->where([
            ['assessment_internal_id' , '=' , $id_asesmen],
            ['body_indikator_dokumen' ,'=' , $body_indikator_asesmen]
        ])->get();

        if ($file = $request->file('ubah_dokumen')) {
            // $nama_dokumen_baru = $this->dokumenAsesmenNamingScheme($body_indikator_asesmen, $asesmen_internal, $file->getClientOriginalName());
            $nama_dokumen_baru = "Poin_Indikator_".$body_indikator_asesmen."_".$asesmen_internal->nama_sekolah."_".$asesmen_internal->id."_Internal Asesmen_".$file->getClientOriginalName();
            foreach ($dokumenSimpan as $docs) {
                $checker  = $asesmen_internal->dokumenAsesmen()->where([
                    ['nama_dokumen_asesmen' , '=', $nama_dokumen_baru],
                    ['body_indikator_dokumen', '=' , $request->assessment]
                ])->first();
                if ($docs->nama_dokumen_asesmen == $nama_dokumen_baru && !is_null($checker)) {
                    //update
                    $checker->nama_dokumen_asesmen = $nama_dokumen_baru;
                    $checker->body_indikator_dokumen = $request->assessment;
                    $dokumenUpdate = $checker->save();
                   
                    if ($dokumenUpdate) {
                       
                        $file->move('kegiatan/asesmen_internal/', $nama_dokumen_baru);
                        return Response::json(['message' => 'data is valid'], 200);
                    }
                    return Response::json(['message' => 'data error', 'errors' => ['Terjadi Kegagalan Saat Melakukan Penyimpanan Dokumen, Silahkan Coba Kembali lalu kontak Admin jika masih terdapat kendala']], 422);
                }
            }
            
            $dokumen_asesmen_sesuai = $asesmen_internal->dokumenAsesmen()->where([
                ['assessment_internal_id' , '=' , $id_asesmen],
                ['nama_dokumen_asesmen', '=', $file_name],
                ['body_indikator_dokumen' ,'=' , $body_indikator_asesmen]
            ])->first();

            $dokumen_lama = $dokumen_asesmen_sesuai->nama_dokumen_asesmen;
            if ($dokumen_lama == $file_name) {
                $dokumen_asesmen_sesuai->nama_dokumen_asesmen = $nama_dokumen_baru;
                $dokumen_asesmen_sesuai->body_indikator_dokumen = $body_indikator_asesmen;
                $dokumen_asesmen_sesuai->assessment_internal_id = $id_asesmen;
                
                $save_new_dokumen = $dokumen_asesmen_sesuai->save();
               
                if ($save_new_dokumen) {
                  
                    unlink(public_path('kegiatan/asesmen_internal/'.$dokumen_lama));
                    $file->move('kegiatan/asesmen_internal', $nama_dokumen_baru);
                    return Response::json(['data'=> 'data is valid'], 200);
                } else{
                    return Response::json(['errors' => ['Terjadi Kegagalan Saat Melakukan Penyimpanan Dokumen, Silahkan Coba Kembali']], 422);
                }
            } else{
                return Response::json(['errors' => ['Data Dokumen tidak dapat ditemukan, silahkan kontak Admin untuk mengecek database dan server']], 422);
            }
        } else{
            return Response::json(['errors' => ['Harap Unggah Dokumen Pengganti dengan Ekstensi .pdf']], 422);
        }
    }

    public function update_informasi(InformasiAssessmenInternalRequest $request , $id){
        $assessment =  $this->findData->findDataModel($id, 'Asesmen');
        if (gettype($assessment) == 'string') {
            return response()->json(['message' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id.', System Error Message: '. $assessment], 404);
        }
        $input['alamat_sekolah'] = $request->alamat_sekolah;
        $input['nama_sekolah'] = $request->nama_sekolah;
        $input['email_kepsek'] = $request->email_kepsek;
        $input['nama_kepsek'] = $request->nama_kepsek;
        $input['nomor_hp'] = $request->no_hp;
        $update_info = $assessment->update($input);
        if ($update_info) {
            return Response::json(['message' => 'data is valid'], 200);
        } else {
            return Response::json(['message' => 'data is not saved', 'errors' =>['Terdapat Kendala saat melakukan pengubahan informasi, silahkan dicoba kembali']], 422);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($file_name, $indikator_asesmen, $id_asesmen)
    {
        // for delete a file with id and body indikator
        $assessmen_internal =  $this->findData->findDataModel($id_asesmen, 'Asesmen');
        if (gettype($assessmen_internal) == 'string') {
            return response()->json(['message' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id_asesmen.', System Error Message: '. $assessmen_internal], 404);
        }
        // if (file_exists(public_path('kegiatan/asesmen_internal/'.$file_name))) {
            $dokumen_delete = $assessmen_internal->dokumenAsesmen()->where([
                ['nama_dokumen_asesmen', '=', $file_name],
                ['body_indikator_dokumen' ,'=' , $indikator_asesmen]
            ])->delete();
            if ($dokumen_delete) {
                unlink(public_path('kegiatan/asesmen_internal/'.$file_name));
                return Response::json(['message' => 'Dokumen berhasil dihapus dari database dan server'], 200);
            } else {
                return Response::json(['message' => 'data is not valid', 'errors' => ['Penghapusan tidak berhasil dilakukan dikarenakan dokumen tidak ada, Silahkan Kontak Admin untuk melakukan cek dalam database dan server']], 422);
            }
        // } else {
        //     return Response::json(['errors'=> ['Dokumen Tidak dapat ditemukan dalam server, silahkan refresh browser Anda dan Kontak Admin']], 422);
        // }
    } 
    
    public function destroyAsesmen($id){
        $assessmen_internal =  $this->findData->findDataModel($id, 'Asesmen');
        if (gettype($assessmen_internal) == 'string') {
            return response()->json(['message' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id.', System Error Message: '. $assessmen_internal], 404);
        }

        $dokumen_asesmen = $assessmen_internal->dokumenAsesmen()->get();
        if (count($dokumen_asesmen) > 0) {
            $delete_dokumen_asesmen = $assessmen_internal->dokumenAsesmen()->delete();
            if (!$delete_dokumen_asesmen) {
                return response()->json(['errors' => ['Tidak Dapat Menghapus Dokumen Asesmen, Silahkan Coba Kembali']], 422);
            }
        }
        $delete_asesmen = $assessmen_internal->delete();
        if (!$delete_asesmen) {
            return response()->json(['errors' => ['Data Asesmen Tidak Berhasil Dihapus, Silahkan Coba Kembali']], 422);
        }
        return response()->json(['message' => 'Data Asesmen Berhasil Dihapus'], 200);
    }

    // private function deleteAsesmen($data_asesmen){
    //     $delete_asesmen = $data_asesmen->delete();
    //     if (!$delete_asesmen) {
    //        return false;
    //     }
    //     return true;
    // }

    // private function removeKumpulanDokumen($docsGetter, $dataAsesmen, $indikatorAsesmen){
    //     if (count($docsGetter > 0)) {
    //         foreach ($docsGetter as $failed_dokumen_name) {
    //             unlink(public_path('kegiatan/asesmen_internal/'.$failed_dokumen_name));
    //             $dataAsesmen->dokumenAsesmen()->where([['nama_dokumen_asesmen' , '=', $failed_dokumen_name],
    //             ['body_indikator_dokumen', '=' , $indikatorAsesmen]])->delete();
    //         }
    //     }
    //     return true;
    // }

    // private function dokumenAsesmenNamingScheme($indikator_asesmen,$dataAsesmen,$fileName){
    //     $naming_scheme = "Poin_Indikator_".$indikator_asesmen."_".$dataAsesmen->nama_sekolah."_".$dataAsesmen->id."_Internal Asesmen_".$fileName;
    //     return $naming_scheme;
    // }
    
 
    private function calculateScore($skor_1, $skor_2, $skor_3, $skor_4, $skor_5, $skor_6, $skor_7, $skor_8 , $skor_9 , $skor_10){
        $skor_akhir_1 = $skor_1 / 5;
        $skor_akhir_2 = $skor_2 / 3;
        $skor_akhir_3 = $skor_3 / 3;
        $skor_akhir_4 = $skor_4 / 3;
        $skor_akhir_5 = $skor_5 / 7;
        $skor_akhir_6 = $skor_6 / 4;
        $skor_akhir_7 = $skor_7 / 4;
        $skor_akhir_8 = $skor_8 / 6;
        $skor_akhir_9 = $skor_9 / 5;
        $skor_akhir_10 = $skor_10 /9;
        $skor_akhir  = ($skor_akhir_1+$skor_akhir_2+$skor_akhir_3+$skor_akhir_4+$skor_akhir_5+$skor_akhir_6+$skor_akhir_7+$skor_akhir_8+$skor_akhir_9+$skor_akhir_10) / 10;
        return $skor_akhir;
    }

    private function create_json_assessmen_internal(){
        $json_assessmen = [];
        for ($i=1; $i <=49 ; $i++) { 
            $json_assessmen [] = array(
                'no' => $i,
                'penjelasan_assessment' => '',
                'skor_penilaian_assessment' => 0,
            );
        }
        $assessmen_skor_penilaian = json_encode($json_assessmen);
        return $assessmen_skor_penilaian;
    }

    // private function getFileUploadSizes($files){
    //     $sizeAllDokumen = 0;
    //     foreach ($files as $getFileSizes) {
    //         $sizeAllDokumen += $getFileSizes->getSize();
    //     }
    //     return $sizeAllDokumen;
    // }

    // public function isFileSize($file){
    //     if ($file > 5120000) {
    //         $fileSizesToMB = round(($file / 1000) / 1000 , 2);
    //         return Response::json(['errors' => ['Total File Size melebihi kapasitas yang sudah ditetapkan (Total Max: 5MB), Total File Ada: '.$fileSizesToMB." MB"]], 422);
    //     }
    // }

}
