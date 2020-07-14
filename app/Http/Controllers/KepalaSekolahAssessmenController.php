<?php

namespace App\Http\Controllers;

use App\AssessmentInternal;
use App\DokumenAsesmen;
use App\Http\Requests\InformasiAssessmenInternalRequest;
use App\Http\Requests\InformasiAssessmenInternalUpdateRequest;
use App\Http\Requests\UpdateDokumenAsesmenRequest;
use App\KategoriAsesmen;
use App\PenjelasanAsesmen;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class KepalaSekolahAssessmenController extends Controller
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
        $assessmen_internal = AssessmentInternal::with('user')->where("user_id", "=", $user_id)->get();
        if (request()->ajax()) {
            return datatables()->of($assessmen_internal)->addColumn('Aksi', function($data_asesmen){
                $aksi = '<button type="button" name="show" id="'.$data_asesmen->id.'" class="btn btn-warning btn-sm show rounded-pill" value="asesmen">Lakukan Asesmen</button>';
                $aksi.= '&nbsp;&nbsp;';
                $aksi.= '<button type="button" id="'.$data_asesmen->id.'"class="btn btn-sm btn-info show rounded-pill" value="lihat_table">Lihat Skor</button>';
                return $aksi;
            // })->editColumn('created_at', function($data_asesmen){
            //     return $data_asesmen->created_at->diffForHumans();
            // })->editColumn('updated_at', function($data_asesmen){
            //     return $data_asesmen->updated_at->diffForHumans();
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
        try{
            $assessmen_internal = AssessmentInternal::findOrFail($id);
        } catch(ModelNotFoundException $evt){
            return response()->json(['messages' => 'Terdapat Error saat pengambilan data, Silahkan refresh browser dan Kontak Admin, id untuk asesmen yang diberikan: '.$id." System Error Code: ".$evt->getMessage()], 404);
        } catch(\Throwable $th){
            return response()->json(['messages' => $th->getMessage()], 404);
        }

        $assessment_json = json_decode($assessmen_internal->indikator_skor_penilaian_ppk);
        $dokumen = $assessmen_internal->dokumenAsesmen()->get();
        $id_asesmen = $id;
        $kategori_asesmen = KategoriAsesmen::all();
        // $get_kategori = KategoriAsesmen::all();
        // return view('kepsek.asesmen.show', compact('assessmen_internal', 'assessment_json', 'dokumen' , 'id_asesmen' , 'get_kategori'));
        return view('kepsek.asesmen.show', compact('assessmen_internal', 'assessment_json', 'dokumen' , 'id_asesmen', 'kategori_asesmen'));
    }

    public function ambil_skor_dan_dokumen_table($id_asesmen, $indikator_asesmen , $skor_asesmen){
        if (request()->ajax()) {
            try {
                $asesmen_internal = AssessmentInternal::findOrFail($id_asesmen);
                $penjelasan_asesmen = PenjelasanAsesmen::findOrFail(intval($indikator_asesmen));
            } catch(ModelNotFoundException $evt){
                return Response::json(['messages' => 'Terdapat Error saat pengambilan data, Silahkan refresh browser dan Kontak Admin, id untuk asesmen yang diberikan: '.$id_asesmen." dan Pengambilan informasi asesmen, ".$skor_asesmen." System Error Code: ".$evt->getMessage()  ], 404);
            } catch (\Throwable $th) {
                return Response::json(['messages' => $th->getMessage()], 404);
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

    public function ambil_data_dan_dokumen_table($id_asesmen, $body_indikator_dokumen){
        //ambil dokumen terkait asesmen
        if (request()->ajax()) {
            // if (Auth::check()) {
            try{
                $assessmen_internal = AssessmentInternal::findOrFail(intval($id_asesmen));
                $penjelasan_asesmen = PenjelasanAsesmen::findOrFail(intval($body_indikator_dokumen));
            } catch(ModelNotFoundException $e){
                return Response::json(['messages' => 'Terdapat Error saat pengambilan data, Silahkan refresh browser dan Kontak Admin, id untuk asesmen yang diberikan: '.$id_asesmen." dan Pengambilan informasi asesmen, ".$body_indikator_dokumen." System Error Code: ".$e->getMessage() ], 404);
            } catch(\Throwable $th){
                return Response::json(['messages' => $th->getMessage() ], 404);
            }
                $keterangan_skor = $penjelasan_asesmen->KeteranganSkor()->get();
                foreach ($keterangan_skor as $item_skor) {
                    $informasi_skor_asesmen = json_decode($item_skor->keterangan_skor);
                }
                $dokumen = $assessmen_internal->dokumenAsesmen()->where('body_indikator_dokumen', '=' , intval($body_indikator_dokumen))->get();
                $json_assessmen = json_decode($assessmen_internal->indikator_skor_penilaian_ppk);
                foreach ($json_assessmen as $ambil_penjelasan) {
                    if ($ambil_penjelasan->no == $body_indikator_dokumen) {
                        // if ($ambil_penjelasan->penjelasan_assessment != null) {
                            $histori_asesmen = $ambil_penjelasan->penjelasan_assessment;
                            return Response::json(['data' => $dokumen , 'penjelasan_skor' => $informasi_skor_asesmen , 'penjelasan_asesmen' => $penjelasan_asesmen , 'histori_asesmen' => $histori_asesmen], 200);           
                        // }
                        // else{
                        //     $histori_asesmen = $ambil_penjelasan->penjelasan_assessment;
                        //     return $histori_asesmen;
                        //     return Response::json(['data' => $dokumen , 'penjelasan_skor' => $informasi_skor_asesmen, 'penjelasan_asesmen' => $penjelasan_asesmen], 200);
                        // }
                        // continue;
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
        try {
            $assessment = AssessmentInternal::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(['messages' => $th->getMessage()], 404);
        } catch(ModelNotFoundException $evt){
            return response()->json(['messages' => 'Terdapat Error saat pengambilan data, Silahkan refresh browser dan Kontak Admin, id untuk asesmen yang diberikan: '.$id." System Error Code: ".$evt->getMessage()], 404);
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
    public function update(InformasiAssessmenInternalUpdateRequest $request, $id)
    {
        //        
        try {
            $assessmen_internal = AssessmentInternal::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'messages' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id.", System Error Message: ". $e->getMessage()
            ], 404);
        } catch(\Throwable $th){
            return Response::json([
                'messages' => $th->getMessage()
            ], 404);
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

        $fileSizes = $this->getFileUploadSizes($file);
        
        if ($fileSizes > 5120000) {
            $fileSizesToMB = round(($fileSizes / 1000) / 1000 , 2);
            return Response::json(['errors' => ['Total File Size melebihi kapasitas yang sudah ditetapkan (Total Max: 5MB), Total File Ada: '.$fileSizesToMB." MB"]], 422);
        }
        
        //strictly for storing skor dan upload dokumen
        foreach ($file as $unggah_dokumen) {
            $file_default_name =  "Poin_Indikator_".$request->assessment."_".$assessmen_internal->nama_sekolah."_Internal Asesmen_".$unggah_dokumen->getClientOriginalName();
            $kumpulan_dokumen [] = $file_default_name;
                if (file_exists(public_path('kegiatan/asesmen_internal/'.$file_default_name))) {
                    $dokumen_update = $assessmen_internal->dokumenAsesmen()->where([
                        ['nama_dokumen_asesmen' , '=', $file_default_name],
                        ['body_indikator_dokumen', '=' , $request->assessment]
                    ])->update(
                        ['nama_dokumen_asesmen' => $file_default_name],
                        ['body_indikator_dokumen' => $request->assessment]
                    );
                    if($dokumen_update){
                        unlink(public_path('kegiatan/asesmen_internal/'.$file_default_name));
                        $unggah_dokumen->move('kegiatan/asesmen_internal', $file_default_name);
                        $kumpulan_dokumen = [];
                        continue;
                    } else {
                        foreach ($kumpulan_dokumen as $failed_dokumen_name) {
                            unlink(public_path('kegiatan/asesmen_internal/'.$failed_dokumen_name));
                            $assessmen_internal->dokumenAsesmen()->where([['nama_dokumen_asesmen' , '=', $failed_dokumen_name],
                             ['body_indikator_dokumen', '=' , $request->assessment]])->delete();
                        }
                        return Response::json(['message'=>'data is not valid' , ['errors' => 'File tidak berhasil diunggah, Silahkan Coba Kembali']], 422);
                    }
                } 
                else {
                    $dokumen = new DokumenAsesmen([
                        'assessment_internal_id' => $id,
                        'nama_dokumen_asesmen' => $file_default_name,
                        'body_indikator_dokumen' => $request->assessment
                    ]);
                    $upload_file = $unggah_dokumen->move('kegiatan/asesmen_internal/', $file_default_name);
                    $add_dokumen = $assessmen_internal->dokumenAsesmen()->save($dokumen);
                    if ($upload_file && $add_dokumen) {
                        continue;
                    } else {
                        //menghapus dokumen ketika gagal
                        foreach ($kumpulan_dokumen as $failed_dokumen_name) {
                            unlink(public_path('kegiatan/asesmen_internal/'.$failed_dokumen_name));
                            $assessmen_internal->dokumenAsesmen()->where([['nama_dokumen_asesmen' , '=', $failed_dokumen_name],
                             ['body_indikator_dokumen', '=' , $request->assessment]])->delete();
                        }
                        return Response::json(['errors' => ['File Tidak berhasil diunggah, silahkan coba kembali']], 422);
                    }
                }
            }
        $update = $assessmen_internal->update($input);
        if ($update) {
            return Response::json(['message' => 'data is valid'], 200);
        }
        else{
            //delete dokumen
            foreach ($kumpulan_dokumen as $failed_dokumen_name) {
                unlink(public_path('kegiatan/asesmen_internal/'.$failed_dokumen_name));
                $assessmen_internal->dokumenAsesmen()->where([['nama_dokumen_asesmen' , '=', $failed_dokumen_name],
                 ['body_indikator_dokumen', '=' , $request->assessment]])->delete();
            }
            return Response::json(['message'=>'data is not valid' , ['errors' => 'Tidak dapat melakukan Update Penilaian, Silahkan Coba Kembali']], 422);
        }
    }

    public function updateDokumen(UpdateDokumenAsesmenRequest $request , $file_name, $body_indikator_asesmen , $id_asesmen){
        try {
            $asesmen_internal = AssessmentInternal::findOrFail($id_asesmen);
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'messages' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id_asesmen.", System Error Message: ". $e->getMessage()
            ], 404);
        } catch(\Throwable $th){
            return Response::json([
                'messages' => $th->getMessage()
            ], 404);
        }
        $dokumenSimpan = $asesmen_internal->dokumenAsesmen()->where([
            ['assessment_internal_id' , '=' , $id_asesmen],
            ['body_indikator_dokumen' ,'=' , $body_indikator_asesmen]
        ])->get();

        if ($file = $request->file('ubah_dokumen')) {
            $nama_dokumen_baru = "Poin_Indikator_".$body_indikator_asesmen.'_'.$asesmen_internal->nama_sekolah."_Internal Asesmen_".$file->getClientOriginalName();           

            foreach ($dokumenSimpan as $docs) {
                if ($docs->nama_dokumen_asesmen == $nama_dokumen_baru) {
                    //update
                    $dokumenUpdate = $asesmen_internal->dokumenAsesmen()->where([
                        ['assessment_internal_id' , '=' , $id_asesmen],
                        ['nama_dokumen_asesmen', '=', $docs->nama_dokumen_asesmen],
                        ['body_indikator_dokumen' ,'=' , $body_indikator_asesmen]
                    ])->update(
                        ['assessment_internal_id' => $id_asesmen],
                        ['nama_dokumen_asesmen' => $nama_dokumen_baru],
                        ['body_indikator_dokumen' => $body_indikator_asesmen]
                    );
                    if ($dokumenUpdate) {
                        // if (file_exists(public_path('kegiatan/asesmen_internal/'.$docs->nama_dokumen_asesmen))) {
                            //unlink
                            unlink(public_path('kegiatan/asesmen_internal/'.$docs->nama_dokumen_asesmen));
                            //move
                            $file->move('kegiatan/asesmen_internal/', $nama_dokumen_baru);
                            return Response::json(['message' => 'data is valid'], 200);
                        // } else {
                        //     // $file->move('kegiatan/asesmen_internal/', $nama_dokumen_baru);
                        //     // return Response::json(['message' => 'data is valid'], 200);
                        //     return Response::json(['errors' => ['']])
                        // }
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
                $input['nama_dokumen_asesmen'] = $nama_dokumen_baru;
                $input['body_indikator_dokumen'] = $body_indikator_asesmen;
                $input['assessment_internal_id'] = $id_asesmen;
                $save_new_dokumen = $asesmen_internal->dokumenAsesmen()->where([
                    ['id' , '=' ,  $dokumen_asesmen_sesuai->id],
                    ['assessment_internal_id' , '=' , $id_asesmen],
                    ['nama_dokumen_asesmen', '=', $dokumen_lama],
                    ['body_indikator_dokumen' ,'=' , $body_indikator_asesmen]
                ])->update($input);
                if ($save_new_dokumen) {
                    // if(file_exists(public_path('kegiatan.asesmen_internal/'.$dokumen_lama))){
                        unlink(public_path('kegiatan/asesmen_internal/'.$dokumen_lama));
                        $file->move('kegiatan/asesmen_internal', $nama_dokumen_baru);
                        return Response::json(['data'=> 'data is valid'], 200);
                    // } else {
                    //     // $file->move('kegiatan/asesmen_internal', $nama_dokumen_baru);
                    //     // return Response::json(['data'=> 'data is valid'], 200);
                    // }
                }
                else{
                    return Response::json(['errors' => ['Terjadi Kegagalan Saat Melakukan Penyimpanan Dokumen, Silahkan Coba Kembali']], 422);
                }
            }
            else{
                return Response::json(['errors' => 'Data Dokumen tidak dapat ditemukan, silahkan kontak Admin untuk mengecek database dan server'], 422);
            }
        }
        else{
            return Response::json(['errors' => ['Harap Unggah Dokumen Pengganti dengan Ekstensi .pdf']], 422);
        }
    }

    public function update_informasi(InformasiAssessmenInternalRequest $request , $id){
        try {
            $assessment = AssessmentInternal::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'messages' => 'Data Asesmen Tidak Ditemukan, Silahkan Coba Kontak Admin, untuk disesuaikan, ID yang diberikan: '.$id.", System Error Message: ". $e->getMessage()
            ], 404);
        } catch(\Throwable $th){
            return Response::json([
                'messages' => $th->getMessage()
            ], 404);
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
        try{
            $assessmen_internal = AssessmentInternal::findOrFail($id_asesmen);
        } catch(ModelNotFoundException $evt){
            return Response::json(['messages' => 'Terdapat Error saat mengambil data, Silahkan refresh browser dan Kontak Admin! ID yang diberikan: '.$id_asesmen.' System Error Code: '.$evt->getMessage()], 404);
        } catch(\Throwable $th){
            return Response::json(['messages' => $th->getMessage()], 404);
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
 
    protected function calculateScore($skor_1, $skor_2, $skor_3, $skor_4, $skor_5, $skor_6, $skor_7, $skor_8 , $skor_9 , $skor_10){
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

    protected function create_json_assessmen_internal(){
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

    protected function getFileUploadSizes($files){
        $sizeAllDokumen = 0;
        foreach ($files as $getFileSizes) {
            $sizeAllDokumen += $getFileSizes->getSize();
        }
        return $sizeAllDokumen;
    }

}
