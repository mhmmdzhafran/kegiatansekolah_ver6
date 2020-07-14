<?php

namespace App\Http\Controllers;

use App\DokumenKegiatan;
use App\DokumentasiKegiatan;
use App\FolderDokumentasi;
use App\Http\Requests\UploadDokumentasiKepalaSekolahRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class KepalaSekolahDokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $folder_dokumentasi = FolderDokumentasi::paginate(5);
        return view('kepsek.dokumentasi_kegiatan.index', compact('folder_dokumentasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_doc)
    {
        //
        $role = Auth::user()->Role->role_title;
        $date_now = Carbon::now('Asia/Jakarta')->toDateString();
        $dokumentasi_id = $id_doc;
        $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id_doc)->first();
        $nama_kegiatan =  $dokumentasi_kegiatan->nama_kegiatan;
        return view('kepsek.dokumentasi_kegiatan.create', compact('role', 'date_now', 'dokumentasi_id' , 'nama_kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $date_now , $id_doc)
    {
        //
        $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id_doc);
        $files = $request->file('file');
        foreach ($files as $file) {
            $name_file = $date_now."_Dokumentasi-Baru_".$file->getClientOriginalName();
            if (file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$name_file))) {
                //unlink file
                unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$name_file));
                //unlink from db
                $dokumentasi_kegiatan->dokumenKegiatan()->where(['dokumentasi_kegiatan_id' => $id_doc, 'nama_dokumen' => $name_file, 'status_unggah_dokumen' => 'Dokumentasi'])->delete();
            }
            $dokumen = new DokumenKegiatan([
                'dokumentasi_kegiatan_id' => $id_doc,
                'nama_dokumen' => $name_file,
                'status_unggah_dokumen' => 'Dokumentasi'
            ]);
            $save = $dokumentasi_kegiatan->dokumenKegiatan()->save($dokumen);
            if ($save) {
                # code...
                //save file to internal storage
                $file->move('kegiatan/dokumentasi_kegiatan/', $name_file);
                continue;
            } else {
                # code...
                //return response json gagal
                return Response::json(['message' => 'gagal'], 400);
            }
            
        }
        return Response::json(['message' => 'masuk'], 200);
    }

    public function delete_file($id_doc, $file_name){
        $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id_doc);
        if (file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$file_name))) {
            unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$file_name));
            $delete = $dokumentasi_kegiatan->dokumenKegiatan()->where(['dokumentasi_kegiatan_id' => $id_doc, 'nama_dokumen' => $file_name, 'status_unggah_dokumen' => 'Dokumentasi'])->delete();
            if ($delete) {
                return Response::json(['message' => 'keapus'], 200);        
            } else {
                return Response::json(['message' => 'gabisa'], 400);        
            }
            
        }
        else{
            $delete = $dokumentasi_kegiatan->dokumenKegiatan()->where(['dokumentasi_kegiatan_id' => $id_doc, 'nama_dokumen' => $file_name, 'status_unggah_dokumen' => 'Dokumentasi'])->delete();
            if ($delete) {
                return Response::json(['message' => 'keapus'], 200);        
            } else {
                return Response::json(['message' => 'gabisa'], 400);        
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
        $folder_dokumentasi = FolderDokumentasi::findOrFail($id);
        $dokumentasi_kegiatan = $folder_dokumentasi->dokumentasiKegiatan()->first();
        $nama_kegiatan = $dokumentasi_kegiatan->nama_kegiatan;
        $doc_id = $dokumentasi_kegiatan->id;
        $nilai_kegiatan_berbasis = json_decode($dokumentasi_kegiatan->nilai_ppk_kegiatan_berbasis_json);
        $mulai_kegiatan = $dokumentasi_kegiatan->mulai_kegiatan;
        $akhir_kegiatan = $dokumentasi_kegiatan->akhir_kegiatan;
        $dokumen =  $dokumentasi_kegiatan->dokumenKegiatan()->paginate(5);
        return view('kepsek.dokumentasi_kegiatan.show', compact('doc_id','nama_kegiatan', 'nilai_kegiatan_berbasis', 'mulai_kegiatan', 'akhir_kegiatan', 'dokumen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_doc, $id_documentation)
    {
        //
        
        $dokumentasi = DokumentasiKegiatan::findOrFail($id_doc);
        $dokumen =  $dokumentasi->dokumenKegiatan()->where("id" , $id_documentation)->first();
        $dokumen_extension =  substr($dokumen->nama_dokumen, -3);
        return view('kepsek.dokumentasi_kegiatan.edit', compact('dokumen', 'dokumentasi', 'dokumen_extension', 'id_doc', 'id_documentation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadDokumentasiKepalaSekolahRequest $request, $id_doc, $dokumen_id)
    {
        //
        $dokumentasi = DokumentasiKegiatan::findOrFail($id_doc);
        $dokumen = $dokumentasi->dokumenKegiatan()->where("id", $dokumen_id)->first();
        return $dokumen;
        $file_sebelumnya = $dokumen->nama_dokumen;
        $file = $request->file('dokumen_kegiatan');
        if (is_null($file)) {
            Session::flash('danger', 'Tidak Ada file yang diunggah');
            return redirect()->back();
        }
        else{
            $nama_file = Carbon::now()->toDateString()."_Dokumentasi-Baru_".$dokumentasi->nama_kegiatan."_".$file->getClientOriginalName();
            $input = $dokumen->nama_dokumen = $nama_file;
        }
        $upload_file = $dokumentasi->dokumenKegiatan()->where(["id" => $dokumen_id, "nama_dokumen" => $file_sebelumnya])->update($input);
        if ($upload_file) {
            unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$file_sebelumnya));
            $file->move('kegiatan/dokumentasi_kegiatan/' , $nama_file);
            Session::flash('success', 'File berhasil diubah');
            return redirect()->back();
        } else {
            Session::flash('warning', 'File tidak berhasil diubah, silahkan coba lagi');
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_docs , $id_dokumen)
    {
        //
        $dokumen = DokumentasiKegiatan::findOrFail($id_docs);
        $ambil_dokumen =  $dokumen->dokumenKegiatan()->where(['id' => $id_dokumen, 'dokumentasi_kegiatan_id' => $id_docs])->first();
        $nama_doc = $ambil_dokumen->nama_dokumen;
        return $nama_doc;
        if (file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_doc))) {
            # code...
            //find di db
            $delete =  $dokumen->dokumenKegiatan()->where(['id' => $id_dokumen, 'dokumentasi_kegiatan_id' => $id_docs])->delete();
            //check kondisi => if true unlink file, else error
            if ($delete) {
                unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_doc));
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } else {
            # code...
            //find di db juga tanpa unlink
            $delete =  $dokumen->dokumenKegiatan()->where(['id' => $id_dokumen, 'dokumentasi_kegiatan_id' => $id_docs])->delete();
            if ($delete) {
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        }
        
    }
}
