<?php

namespace App\Http\Controllers;

use App\DokumenKegiatan;
use App\DokumentasiKegiatan;
use App\FolderDokumentasi;
use App\Http\Requests\UploadDokumentasiPJRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class PJDokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $folder_dokumentasi =  $user->folderDokumentasi()->paginate(5);
        return view('pj.kelola_dokumentasi.index', compact('folder_dokumentasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_doc)
    {
        //
        //view upload dokumentasi baru
        $dokumentasi_id = $id_doc;
        $role = Auth::user()->Role->role_title;
        $date_now = Carbon::now()->toDateString();
        return view('pj.kelola_dokumentasi.create', compact('dokumentasi_id', 'date_now', 'dokumentasi_id' , 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $date_now, $id_doc)
    {
        //
        //storing multiple data dokumentasi
        //kurang kalo filenya sama
        $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id_doc);
        $file = $request->file('file');
        foreach ($file as $item) {
            $nama_file = $date_now."_Dokumentasi-Baru_".$item->getClientOriginalName();
            //save new file dengan menggunakan collection save()
            if (file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_file))) {
                //tolong unlink yang sudah ada
                //update yang sudah di update
                unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_file));
                $dokumentasi_kegiatan->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $id_doc, "nama_dokumen" => $nama_file])->delete();
            }
            $dokumen = new DokumenKegiatan([
                'dokumentasi_kegiatan_id' => $id_doc,
                'nama_dokumen' => $nama_file,
                'status_unggah_dokumen' => "Dokumentasi"
            ]);
            $save = $dokumentasi_kegiatan->dokumenKegiatan()->save($dokumen);
                if ($save) {
                $item->move('kegiatan/dokumentasi_kegiatan/',$nama_file);
                continue;
            } else {
                Session::flash('warning', 'Tidak dapat memproseskan penyimpanan file terakhir, silahkan coba kembali');
                return Response::json(['message' => 'Tidak dapat save file'], 400);
            }
        }
        return Response::json(['message' => 'Success'], 200);
    }

    /**
    * Delete file yang diupload barusan
    */
    public function delete_file($id_doc, $file_name)
    {        
        $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($id_doc);
        if (file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$file_name))) {
            // unlink the file
            unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$file_name));
            //delete db
            $delete = $dokumentasi_kegiatan->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $id_doc, "nama_dokumen" => $file_name])->delete();
            //response json success
            if ($delete) {
                return Response::json(['message' => 'Success'], 200);
            } else {
                //else error
                return Response::json(['message' => 'gagal'], 400);
            }
        } else {
            //if gaada file tp ada di db, maka tolong unlink di db
            $delete = $dokumentasi_kegiatan->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $id_doc, "nama_dokumen" => $file_name])->delete();
            if ($delete) {
                return Response::json(['message' => 'Success'], 200);
            } else {
                //else error
                return Response::json(['message' => 'gagal'], 400);
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
        $data_folder = FolderDokumentasi::findOrFail($id);
        $id_dokumentasi = $id;
        $isi = $data_folder->dokumentasiKegiatan()->get();
        foreach ($isi as $dokumentasi) {
            $nilai_kegiatan_berbasis = json_decode($dokumentasi->nilai_ppk_kegiatan_berbasis_json);
            $mulai_kegiatan = $dokumentasi->mulai_kegiatan;
            $akhir_kegiatan = $dokumentasi->akhir_kegiatan;
            $dokumentasi_disetujui = $dokumentasi->updated_at;
            $nama_kegiatan = $dokumentasi->nama_kegiatan;
            $doc_id = $dokumentasi->id;
        }
        $dokumen =  $data_folder->dokumenKegiatan()->paginate(5);
        return view('pj.kelola_dokumentasi.show', compact('id_dokumentasi','isi','nilai_kegiatan_berbasis', 'mulai_kegiatan', 'akhir_kegiatan', 'dokumentasi_disetujui', 'nama_kegiatan', 'dokumen', 'doc_id'));
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
        //view change data
        $data_dokumentasi = DokumentasiKegiatan::findOrFail($id_doc);
        $dokumen =  $data_dokumentasi->dokumenKegiatan()->where(['id' => $id_documentation, 'dokumentasi_kegiatan_id' => $id_doc])->get();
        foreach ($dokumen as $data) {
            $nama_dokumen =  $data->nama_dokumen;
            $search_extension = pathinfo(public_path('kegiatan/dokumentasi_kegiatan/'.$nama_dokumen));
            $dokumen_extension =  $search_extension["extension"];
        }
        return view('pj.kelola_dokumentasi.edit', compact('id_doc', 'id_documentation', 'nama_dokumen', 'dokumen_extension'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadDokumentasiPJRequest $request , $id_doc, $dokumen_id)
    {
        //
        //update new data 
        $dokumentasi = DokumentasiKegiatan::findOrFail($id_doc);
        $data_dokumen = $dokumentasi->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $id_doc, "id" => $dokumen_id])->first();
        $file = $request->file('ganti_dokumen');
        if (is_null($file)) {
            Session::flash('danger', 'File tidak diunggah, Silahkan Unggah file!');
            return redirect()->back();
        }
        else{
            $file_sebelumnya = $data_dokumen->nama_dokumen;
            $nama_file = Carbon::now()->toDateString()."_Dokumentasi-Baru_".$dokumentasi->nama_kegiatan."_".$file->getClientOriginalName();
            $input = $data_dokumen->nama_dokumen = $nama_file;
        }
        $upload_file = $dokumentasi->dokumenKegiatan()->where(["dokumentasi_kegiatan_id" => $id_doc, "id" => $dokumen_id])->update($input);
        if ($upload_file) {
            //sukses
            unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$file_sebelumnya));
            $file->move('kegiatan/dokumentasi_kegiatan/',$nama_file);
            Session::flash('success', 'File berhasil diubah');
            return redirect()->back();
        } else {
            // gagal
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
    public function destroy($id_doc,$id_documentation)
    {
        //
        $dokumentasi = DokumentasiKegiatan::findOrFail($id_doc);
        $dokumen = $dokumentasi->dokumenKegiatan()->where("id", $id_documentation)->first();
        $file_name = $dokumen->nama_dokumen;
        // $data_dokumen = $dokumentasi->dokumenKegiatan()->where(['id' => $id_documentation, 'dokumentasi_kegiatan_id' => $id_doc, 'nama_dokumen' => $file_name])->first();
        if (file_exists(public_path('kegiatan/dokumentasi_kegiatan/'.$file_name))) {
            //jika ada file, maka unlink dan delete data di db
            $delete = $dokumentasi->dokumenKegiatan()->where(['id' => $id_documentation, 'dokumentasi_kegiatan_id' => $id_doc, 'nama_dokumen' => $file_name])->delete();
            if ($delete) {
                Session::has('success', 'Sistem berhasil menghapus file');
                unlink(public_path('kegiatan/dokumentasi_kegiatan/'.$file_name));
                return redirect()->back();
            } else {
                Session::has('warning', 'Sistem tidak dapat memproses penghapusan file, silahkan coba kembali');
                return redirect()->back();
            }
        }
        else{
            //kalo gaada filenya, delete dari db
            $delete = $dokumentasi->dokumenKegiatan()->where(['id' => $id_documentation, 'dokumentasi_kegiatan_id' => $id_doc, 'nama_dokumen' => $file_name])->delete();
            if ($delete) {
                Session::has('success', 'Sistem berhasil menghapus file');
                return redirect()->back();
            } else {
                Session::has('warning', 'Sistem tidak dapat memproses penghapusan file, silahkan coba kembali');
                return redirect()->back();
            }
        }
    }
}