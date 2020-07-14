<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout');


Route::group(['middleware' => 'Admin'], function(){

    // Route::get('/admin-home', 'AdminController@index');

    Route::resource('/admin/users', 'AdminUserController', ['names' => [
        'index' => 'admin.user.index',
        'create' => 'admin.user.create',
        'store' => 'admin.user.store',
        'edit' => 'admin.user.edit',
        // 'destroy' => 'admin.user.destroy',
        'update' => 'admin.user.update'
    ]]);
    
    Route::post('/admin/users/{id}/delete', 'AdminUserController@destroy')->name('admin.user.destroy');

});

Route::group(['middleware' => 'PenanggungJawab'], function(){

    // Route::get('/penanggungjawab-home', 'PJController@index');

    //Dokumentasi index
    Route::get('/penanggung-jawab/unggah-dokumentasi-kegiatan', 'PJMengelolaKegiatanController@indexDokumentasi')->name('pj.dokumentasi_kegiatan.index');

    Route::resource('/penanggung-jawab/mengelola-kegiatan', 'PJMengelolaKegiatanController',['names' =>[
        'index' => 'pj.kelola_kegiatan.index',
        'create' => 'pj.kelola_kegiatan.create',
        'show' => 'pj.kelola_kegiatan.show',
        'store' => 'pj.kelola_kegiatan.store',
        'edit' => 'pj.kelola_kegiatan.edit',
        'update' => 'pj.kelola_kegiatan.update'
    ]]);

    //show unggah dokumentasi
    Route::get('/penanggung-jawab/unggah-dokumentasi-kegiatan/{dokumentasi_kegiatan}/edit', 'PJMengelolaKegiatanController@editDokumentasi')
    ->name('pj.dokumentasi_kegiatan.edit');

    //show unggah dokumentasi ulang
    // Route::get('/penanggung-jawab/mengelola-kegiatan/dokumentasi-kegiatan/{dokumentasi_kegiatan}/edit-ulang', 'PJMengelolaKegiatanController@editDokumentasiUlang')
    // ->name('pj.dokumentasi_kegiatan.edit_ulang');

    Route::post('/penanggung-jawab/unggah-dokumentasi-kegiatan/{dokumentasi_kegiatan}', 'PJMengelolaKegiatanController@uploadDokumentasi')->name('pj.dokumentasi_kegiatan.upload');

    Route::post('/penanggung-jawab/unggah-dokumentasi-kegiatan/dokumentasi-kegiatan/baru', 'PJMengelolaKegiatanController@uploadDokumentasiBaru')->name('pj.dokumentasi_kegiatan.upload_baru');

    //show sukses unggah dokumentasi dan belum disetujui dokumentasi
    Route::get('/penanggung-jawab/unggah-dokumentasi-kegiatan/dokumentasi/{dokumentasi_kegiatan}', 'PJMengelolaKegiatanController@showDokumentasi')
    ->name('pj.dokumentasi_kegiatan.show');

    //Unggah Dokumentasi Ulang
    // Route::put('/penanggung-jawab/mengelola-kegiatan/dokumentasi-kegiatan-ulang/{dokumentasi_kegiatan}', 'PJMengelolaKegiatanController@uploadDokumentasiUlang');

    // Route::post('/penanggung-jawab/mengelola-kegiatan/delete', 'PJMengelolaKegiatanController@destroy');

    Route::resource('/penanggung-jawab/dokumentasi-kegiatan', 'PJDokumentasiController', ['names' => [
        'index' => 'pj.kelola_dokumentasi.index',
        'show' => 'pj.kelola_dokumentasi.show',
    ]]);

    Route::delete('/penanggung-jawab/dokumentasi-kegiatan/{id_doc}/{id_documentation}', 'PJDokumentasiController@destroy')->name('pj.kelola_dokumentasi.destroy');
    
    Route::get('/penanggung-jawab/dokumentasi-kegiatan/dokumen/{id_doc}/edit/{id_documentation}', 'PJDokumentasiController@edit')->name('pj.kelola_dokumentasi.edit');

    Route::put('/penanggung-jawab/dokumentasi-kegiatan/{id_doc}/{dokumen_id}', 'PJDokumentasiController@update')->name('pj.kelola_dokumentasi.update');

    Route::get('/penanggung-jawab/dokumentasi-kegiatan/{id_doc}/create', 'PJDokumentasiController@create')->name('pj.kelola_dokumentasi.create');

    Route::post('/penanggung-jawab/dokumentasi-kegiatan/{date_now}/{id_doc}', 'PJDokumentasiController@store')->name('pj.kelola_dokumentasi.store');

    Route::post('/penanggung-jawab/dokumentasi-kegiatan/{id_doc}/{file_name}/delete', 'PJDokumentasiController@delete_file');
});

Route::group(['middleware' => 'KepalaSekolah'], function(){

    // Route::get('/kepalasekolah-home', 'KepalaSekolahController@index');

    Route::get('/kepala-sekolah/dokumentasi-kegiatan', 'KepalaSekolahMengelolaKegiatanController@indexDokumentasi')
    ->name('kepsek.pengajuan_dokumentasi_kegiatan.index');

    Route::resource('/kepala-sekolah/mengelola-dokumentasi-kegiatan/mengelola-kegiatan', 'KepalaSekolahDokumentasiController', ['names' => [
        'index' => 'kepsek.kelola_dokumentasi.index',
        'show' => 'kepsek.kelola_dokumentasi.show',
        'store' => 'kepsek.kelola_dokumentasi.store',
        'edit' => 'kepsek.kelola_dokumentasi.edit',
        'destroy' => 'kepsek.kelola_dokumentasi.destroy'
    ]]);

    Route::resource('/kepala-sekolah/mengelola-kegiatan', 'KepalaSekolahMengelolaKegiatanController', ['names' => [
        'index' => 'kepsek.kelola_kegiatan.index',
        'edit' => 'kepsek.kelola_kegiatan.edit',
        'show' => 'kepsek.kelola_kegiatan.show',
        'update' => 'kepsek.kelola_kegiatan.update'
    ]]);
    Route::get('/kepala-sekolah/mengelola-kegiatan/get-data/{id}', 'KepalaSekolahMengelolaKegiatanController@get_data_dan_dokumen_pengajuan')->name('pj.kelola_kegiatan.data_kegiatan');

    //route for showdokumentasi => alias sudahnya Acc/Not dokumentasi kegiatan, menunggu keputusan dari pj
    Route::get('/kepala-sekolah/dokumentasi-kegiatan/{dokumentasi_kegiatan}', 'KepalaSekolahMengelolaKegiatanController@showDokumentasi')
    ->name('kepsek.pengajuan_dokumentasi_kegiatan.show');
    
    Route::resource('/kepala-sekolah/asesmen-ppk', 'KepalaSekolahAssessmenController' , ['names' => [
        'index' => 'kepsek.asesmen.index',
        'create' => 'kepsek.asesmen.create',
        'show' => 'kepsek.asesmen.show',
        'edit' => 'kepsek.asesmen.edit',
    ]]);
    
    Route::post('/kepala-sekolah/asesmen-ppk/store', 'KepalaSekolahAssessmenController@store')->name('kepsek.asesmen.store');
    Route::get('/kepala-sekolah/asesmen-ppk/dokumen/{id_asesmen}/{id}', 'KepalaSekolahAssessmenController@ambil_data_dan_dokumen_table')->name('kepsek.asesmen.ambilDoc');
    Route::get('/kepala-sekolah/asesmen-ppk/get-skor/{id_asesmen}/{id_indikator}/{skor_indikator}', 'KepalaSekolahAssessmenController@ambil_skor_dan_dokumen_table')->name('kepsek.asesmen.ambilSkor');
    Route::put('/kepala-sekolah/asesmen-ppk/save/{id}', 'KepalaSekolahAssessmenController@update')->name('kepsek.asesmen.update');
    Route::put('/kepala-sekolah/asesmen-ppk/save_info/{id_info}', 'KepalaSekolahAssessmenController@update_informasi')->name('kepsek.asesmen.update_informasi');
    Route::put('/kepala-sekolah/asesmen-ppk/update_dokumen/{file_name}/{id_indikator}/{id_asesmen}', 'KepalaSekolahAssessmenController@updateDokumen')->name('kepsek.asesmen.updateDoc');
    Route::post('/kepala-sekolah/asesmen-ppk/delete/{file_name}/{id_indikator}/{id_asesmen}', 'KepalaSekolahAssessmenController@destroy')->name('kepsek.asesmen.destroy');


    //route for editdokumentasi => alias mengajukan acc/pengajuan ulang dokumentasi kegiatan dari pj
    // Route::get('/kepala-sekolah/mengelola-kegiatan/dokumentasi-kegiatan/{dokumentasi_kegiatan}/edit', 'KepalaSekolahMengelolaKegiatanController@editDokumentasi')
    // ->name('kepsek.pengajuan_dokumentasi_kegiatan.edit');

    //for editdokumentasiulang => alias untuk pengajuan ulang dokumentasi kegiatan
    // Route::get('/kepala-sekolah/mengelola-kegiatan/dokumentasi-kegiatan-ulang/{dokumentasi_kegiatan}/edit', 'KepalaSekolahMengelolaKegiatanController@editDokumentasiUlang')
    // ->name('kepsek.pengajuan_dokumentasi_kegiatan.edit_ulang');

    // Route::put('/kepala-sekolah/mengelola-kegiatan/dokumentasi-kegiatan/{dokumentasi_kegiatan}', 'KepalaSekolahMengelolaKegiatanController@updateDokumentasi');

    // Route::put('/kepala-sekolah/mengelola-kegiatan/dokumentasi-kegiatan-ulang/{dokumentasi_kegiatan}', 'KepalaSekolahMengelolaKegiatanController@updateDokumentasiUlang');
    // Route::resource('/kepala-sekolah/mengelola-dokumentasi-kegiatan', 'KepalaSekolahDokumentasiController', ['names' => [
    //     'index' => 'kepsek.dokumentasi_kegiatan.index',
    //     'show' => 'kepsek.dokumentasi_kegiatan.show',
    // ]]);

    // Route::get('/kepala-sekolah/mengelola-dokumentasi-kegiatan/{id_docs}/edit/{id_documentation}', 'KepalaSekolahDokumentasiController@edit')->name('kepsek.dokumentasi_kegiatan.edit');
    
    // Route::put('/kepala-sekolah/mengelola-dokumentasi-kegiatan/{id_docs}/{id_documentation}', 'KepalaSekolahDokumentasiController@update')->name('kepsek.dokumentasi_kegiatan.update');

    // Route::get('/kepala-sekolah/mengelola-dokumentasi-kegiatan/{id_docs}/create', 'KepalaSekolahDokumentasiController@create')->name('kepsek.dokumentasi_kegiatan.create');

    // Route::post('/kepala-sekolah/mengelola-dokumentasi-kegiatan/{date_now}/{id_doc}', 'KepalaSekolahDokumentasiController@store')->name('kepsek.dokumentasi_kegiatan.store');

    // Route::delete('/kepala-sekolah/mengelola-dokumentasi-kegiatan/{id_docs}/{id_documentation}/delete', 'KepalaSekolahDokumentasiController@destroy')->name('kepsek.dokumentasi_kegiatan.destroy');

    // Route::post('/kepala-sekolah/mengelola-dokumentasi-kegiatan/{id_doc}/{file_name}/delete', 'KepalaSekolahDokumentasiController@delete_file');
    
});

Route::get('/404', function(){
    return view("errors.404");
});

//thanks github
Route::fallback(function(){ 
    return response()->view('errors.404', [], 404); 
});