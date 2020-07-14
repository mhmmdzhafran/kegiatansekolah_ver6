<?php

namespace App\Http\Controllers;

use App\AssessmentEksternal;
use App\Http\Requests\AssessmentEksternalValidationRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PenilaiEksternalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //add datatables;
        $assessment = AssessmentEksternal::paginate(5);
        return view('penilai_eksternal.index', compact('assessment'));
    }

    public function hasil_penilaian(){
        $assessmen = AssessmentEksternal::with('user')->get();
        if(request()->ajax()){
            return datatables()->of($assessmen)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="btn btn-primary btn-sm edit">Show</button>';
                        $button .= '&nbsp;&nbsp;';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('penilai_eksternal.hasil_penilaian');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('penilai_eksternal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssessmentEksternalValidationRequest $request)
    {
        //
        if (!is_array($request->indikator)) {
            $request->indikator = [];
        }
        $nama_sekolah = $request->nama_sekolah;
        $alamat_sekolah = $request->alamat_sekolah;
        $nama_kepsek = $request->nama_kepsek;
        $no_hp = $request->no_hp;
        $email_kepsek = $request->email_kepsek;
        if (count($request->indikator) < 49) {
            return Response::json(['message' => "invalid", 'errors' => ['Indikator terisi hanya '.count($request->indikator)." Dari 49"]], 422);
        }
        $json_assessment = [];
        $penjelasan =  $request->penjelasan_assessment;
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
        for ($i=0; $i < count($penjelasan) ; $i++) { 
            $json_assessment[] = array(
                "no" => $i+1,
                "penjelasan_assessment" => $penjelasan[$i],
                "skor_assessment_indikator" => $request->indikator[$i]
            );
            if ($i >= 0 && $i <= 4) {
                $skor_indikator_1 = $request->indikator[$i];
                $skor_1  = $skor_1 +  $skor_indikator_1;
            } 
            elseif ($i > 4 && $i <= 7) {
                $skor_indikator_2 = $request->indikator[$i];
                $skor_2 += $skor_indikator_2;
            }
            elseif($i > 7 && $i <= 10){
                $skor_indikator_3 = $request->indikator[$i];
                $skor_3 += $skor_indikator_3;
            }
            elseif($i > 10 && $i <= 13){
                $skor_indikator_4 = $request->indikator[$i];
                $skor_4 += $skor_indikator_4;
            }
            elseif($i > 13 && $i <= 20){
                $skor_indikator_5 = $request->indikator[$i];
                $skor_5 += $skor_indikator_5;
            }
            elseif($i > 20 && $i <= 24){
                $skor_indikator_6 = $request->indikator[$i];
                $skor_6 += $skor_indikator_6;
            }
            elseif($i > 24 && $i <= 28){
                $skor_indikator_7 = $request->indikator[$i];
                $skor_7 += $skor_indikator_7;
            }
            elseif($i > 28 && $i <= 34){
                $skor_indikator_8 = $request->indikator[$i];
                $skor_8 += $skor_indikator_8;
            }
            elseif($i > 34 && $i <= 39){
                $skor_indikator_9 = $request->indikator[$i];
                $skor_9 += $skor_indikator_9;
            }
            elseif($i > 39 && $i <= 49){
                $skor_indikator_10 = $request->indikator[$i];
                $skor_10 += $skor_indikator_10;
            }
        }
        $skor_akhir = self::calculateScore($skor_1, $skor_2, $skor_3, $skor_4, $skor_5, $skor_6, $skor_7, $skor_8 , $skor_9 , $skor_10);
        $input['indikator_skor_penilaian_ppk'] = json_encode($json_assessment);
        $input["skor_penilaian_kegiatan_akhir"] =  number_format($skor_akhir * 100, 2);
        $input['nama_sekolah'] = $nama_sekolah;
        $input['alamat_sekolah'] = $alamat_sekolah;
        $input['nama_kepsek'] = $nama_kepsek;
        $input['nomor_hp'] = $no_hp;
        $input['email_kepsek']  = $email_kepsek;
        $input["nama_assessment"] = Carbon::now()->toDateString()."_Assessment_PPK_".$nama_sekolah."_".number_format($skor_akhir * 100, 2);
        $input["user_id"] = Auth::user()->id;
        
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
        
        $insert_assessment = AssessmentEksternal::create($input);
        if ($insert_assessment) {
            $data =  $insert_assessment->id;
            return Response::json(["message" => "berhasil" , "data" => $data], 200);
        }
        else{
            return Response::json(["message" => "tidak berhasil" , 'errors' => ['Terjadi Kendala Saat Memproses Assessment, Silahkan Coba Kembali']], 422);
        }
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_assessment)
    {
        //
        $assessment = AssessmentEksternal::findOrFail($id_assessment);
        $assessment_json = json_decode($assessment->indikator_skor_penilaian_ppk);
        
        return view('penilai_eksternal.show', compact('assessment_json' , 'assessment'));
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public static function calculateScore($skor_1, $skor_2, $skor_3, $skor_4, $skor_5, $skor_6, $skor_7, $skor_8 , $skor_9 , $skor_10){
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
}
