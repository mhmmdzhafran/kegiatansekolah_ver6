<?php

namespace App\Http\Controllers;

use App\DokumentasiKegiatan;
use Illuminate\Http\Request;

class KepalaSekolahMengelolaDokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
        foreach($dokumentasi_kegiatan->StatusKegiatan as $status){
            $statusChecker = $status->pivot->status_kegiatan_id;
            $status_kegiatan  = $status;
            if($statusChecker == 1){
                return view('pj.kelola_kegiatan.show' , compact('pengajuan_kegiatan' , 'status_kegiatan'));
            }
            elseif($statusChecker == 2){
                return view('pj.kelola_kegiatan.show' , compact('pengajuan_kegiatan' , 'status_kegiatan'));
            }
            else{
                return redirect(404);
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
        $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id);
        foreach($dokumentasi_kegiatan->StatusKegiatan as $status){
            $statusChecker = $status->pivot->status_kegiatan_id;
            $status_kegiatan  = $status;
                if($statusChecker == 4){
                 return view('pj.kelola_kegiatan.show' , compact('pengajuan_kegiatan' , 'status_kegiatan'));
            }
                else {
                return redirect(404);
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
}
