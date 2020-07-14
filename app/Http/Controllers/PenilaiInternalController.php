<?php

namespace App\Http\Controllers;

use App\AssessmentInternal;
use App\DokumenAsesmen;
use App\Http\Requests\InformasiAssessmenInternalRequest;
use App\Http\Requests\InformasiAssessmenInternalUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PenilaiInternalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('penilai_internal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('penilai_internal.create');
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
        //store hanya memasukkan input data assessmen, selebihnya di update
        $input['user_id'] = Auth::user()->id;
        $input['nama_sekolah'] = $request->nama_sekolah;
        $input['alamat_sekolah'] = $request->alamat_sekolah;
        $input['nama_kepsek'] = $request->nama_kepsek;
        $input['nomor_hp'] = $request->no_hp;
        $input['email_kepsek'] = $request->email_kepsek;
        $input['indikator_skor_penilaian_ppk'] = $this->create_json_assessmen_internal();
        $simpan = AssessmentInternal::create($input);
        if ($simpan) {
            $id_assessmen = $simpan->id;
            return Response::json(['message' => 'data is valid', 'url'=> $id_assessmen], 200);
        }
        else{
            return Response::json(['message' => 'data is not valid', 'errors' => ["Terjadi Kendala Saat melakukan Penyimpanan, Silahkan Coba Kembali"]], 400);
        }
    }

   

    public function penilaian_internal(){
        $user_id = Auth::user()->id;
        $assessmen_internal = AssessmentInternal::with('user')->where("user_id", "=", $user_id)->get();
        // return $assessmen_internal;
        if (request()->ajax()) {
            return datatables()->of($assessmen_internal)->addColumn('Aksi', function($data_asesmen){
                $aksi = '<button type="button" name="show" id="'.$data_asesmen->id.'" class="btn btn-primary btn-sm show" value="asesmen">Lakukan Asesmen</button>';
                $aksi.= '&nbsp;&nbsp;';
                $aksi.= '<button type="button" id="'.$data_asesmen->id.'"class="btn btn-sm btn-danger show" value="lihat_table">Lihat Skor</button>';
                return $aksi;
            })->editColumn('created_at', function($data_asesmen){
                return $data_asesmen->created_at->diffForHumans();
            })->editColumn('updated_at', function($data_asesmen){
                return $data_asesmen->updated_at->diffForHumans();
            })
            ->rawColumns(['Aksi'])->make(true);
        }
        return view('penilai_internal.hasil_asesmen');
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
        //show hasil skor
        $assessmen_internal = AssessmentInternal::findOrFail($id);
        $assessment_json = json_decode($assessmen_internal->indikator_skor_penilaian_ppk);
        $dokumen = $assessmen_internal->dokumenAsesmen()->get();
        return view('penilai_internal.show', compact('assessmen_internal', 'assessment_json', 'dokumen'));
    }

    public function ambil_dokumen_table($id_asesmen, $body_indikator_dokumen){
        //ambil dokumen terkait asesmen
        if (request()->ajax()) {
            $assessmen_internal = AssessmentInternal::find(intval($id_asesmen));
            if ($assessmen_internal) {  
                $dokumen = $assessmen_internal->dokumenAsesmen()->where('body_indikator_dokumen', '=' , intval($body_indikator_dokumen))->get();
                $json_assessmen = json_decode($assessmen_internal->indikator_skor_penilaian_ppk);
                foreach ($json_assessmen as $ambil_penjelasan) {
                    if ($ambil_penjelasan->no == $body_indikator_dokumen) {
                        if ($ambil_penjelasan->penjelasan_assessment != null) {
                            return Response::json(['data' => $dokumen], 200);           
                        }
                        else{
                            return Response::json(['data' => $dokumen], 200);
                        }
                        continue;
                    }
                }
            }
            else{
                return Response::json(['errors'=> "Tidak terdapat data asesmen atau dokumen, Silahkan Refresh Page / Kontak Admin"], 400);
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
        $assessment = AssessmentInternal::findOrFail($id);
        $dokumen = $assessment->dokumenAsesmen()->get();
        $json_assessmen = json_decode($assessment->indikator_skor_penilaian_ppk);
        return view('penilai_internal.edit', compact('assessment' , 'json_assessmen', 'dokumen'));
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
        //update berfungsi sebagai data dokumen assessmen
        $assessmen_internal = AssessmentInternal::findOrFail($id);
        return $request->all();
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
        if (is_null($request->file('file'))) {
            return Response::json(['errors' => ['File tidak diunggah, silahkan mengunggah file dengan ekstensi .pdf']], 400);
        }
        $file = $request->file('file');
        $json_assessmen = json_decode($assessmen_internal->indikator_skor_penilaian_ppk);
        //strictly for storing skor dan upload dokumen
        foreach ($file as $unggah_dokumen) {
            $file_default_name =  "Poin_Indikator_".$request->assessment."_".$assessmen_internal->nama_sekolah."_Internal Asesmen_".$unggah_dokumen->getClientOriginalName();
                if (file_exists(public_path('kegiatan/asesmen_internal/'.$file_default_name))) {
                    unlink(public_path('kegiatan/asesmen_internal/'.$file_default_name));
                    $assessmen_internal->dokumenAsesmen()->where([['nama_dokumen_asesmen' , '=', $file_default_name],
                     ['body_indikator_dokumen', '=' , $request->assessment]])->delete();
                }
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
                return Response::json(['errors' => ['File Tidak berhasil diunggah, silahkan coba kembali']], 400);
            }
        }

        foreach ($json_assessmen as $item) {
            if ($item->no == $request->assessment) {
                $item->skor_penilaian_assessment = intval($request->indikator);
                $item->penjelasan_assessment = $request->penjelasan_assessment;
            }
            else{
                continue;
            }
        }

        //rerata skor + kalkulasi skor akhir uses
        foreach ($json_assessmen as $skor) {
            if ($skor->no >= 1 && $skor->no <= 4) {
                //calculate skor untuk rerata_indikator_1
                $skor_1 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 4 && $skor->no <= 7){
                $skor_2 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 7 && $skor->no <=10){
                $skor_3 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 10 && $skor->no <= 13){
                $skor_4 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 13 && $skor->no <= 20){
                $skor_5 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 20 && $skor->no <= 24){
                $skor_6 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 24 && $skor->no <= 28){
                $skor_7 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 28 && $skor->no <= 34){
                $skor_8 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 34 && $skor->no <= 39){
                $skor_9 += $skor->skor_penilaian_assessment;
            }
            elseif($skor->no > 39 && $skor->no <= 49){
                $skor_10 += $skor->skor_penilaian_assessment;
            }
        }
        $hasil_json = json_encode($json_assessmen);
        $skor_akhir = PenilaiEksternalController::calculateScore($skor_1, $skor_2, $skor_3, $skor_4, $skor_5 , $skor_6, $skor_7 , $skor_8 , $skor_9, $skor_10);
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
        $update = $assessmen_internal->update($input);
        if ($update) {
            return Response::json(['message' => 'data is valid'], 200);
        }
        else{
            return Response::json(['message'=>'data is not valid' , ['errors' => 'Tidak dapat melakukan Update Penilaian, Silahkan Coba Kembali']], 400);
        }
    }

    public function update_informasi(InformasiAssessmenInternalRequest $request , $id){
        $assessment = AssessmentInternal::findOrFail($id);
        $input['alamat_sekolah'] = $request->alamat_sekolah;
        $input['nama_sekolah'] = $request->nama_sekolah;
        $input['email_kepsek'] = $request->email_kepsek;
        $input['nama_kepsek'] = $request->nama_kepsek;
        $input['nomor_hp'] = $request->no_hp;
        $update_info = $assessment->update($input);
        if ($update_info) {
            return Response::json(['message' => 'data is valid'], 200);
        } else {
            return Response::json(['message' => 'data is not valid', 'errors' =>['Terdapat Kendala saat melakukan pengubahan informasi, silahkan dicoba kembali']]);
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
        $assessmen_internal = AssessmentInternal::findOrFail($id_asesmen);
        $dokumen_delete = $assessmen_internal->dokumenAsesmen()->where([
            ['nama_dokumen_asesmen', '=', $file_name],
            ['body_indikator_dokumen' ,'=' , $indikator_asesmen]
        ])->delete();
        if ($dokumen_delete) {
            unlink(public_path('kegiatan/asesmen_internal/'.$file_name));
            return Response::json(['message' => 'data is valid'], 200);
        } else {
            return Response::json(['message' => 'data is not valid', ['errors' => 'Penghapusan tidak berhasil dilakukan, Silahkan coba kembali']], 400);
        }
        
    }

    // public function editFile(Request $request, $id, $name_docs){
        //1 each
    // }

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
}
