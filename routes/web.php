<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */

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

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Auth\LoginController@showLoginForm');
// Route::put('/forget_password', 'Auth\LoginController@showLoginForm');
Route::post('/password-users/resets', 'Auth\ForgotPasswordController@changeUserPassword')->name('password.changeTempPass');

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
        'destroy' => 'admin.user.destroy',
        'update' => 'admin.user.update'
    ]]);
    

});

Route::group(['middleware' => 'PenanggungJawab'], function(){

    // Route::get('/penanggungjawab-home', 'PJController@index');
    //Dokumentasi index
    Route::get('/penanggung-jawab/unggah-dokumentasi-kegiatan', 'PJMengelolaKegiatanController@indexDokumentasi')->name('pj.dokumentasi_kegiatan.index');

    Route::get('/penanggung-jawab/get-notification', 'UsersNotificationController@getNotification')->name('pj.notification.getData');
    Route::get('/penanggung-jawab/get-more-notification/{request}' , 'UsersNotificationController@getMoreNotification')->name('pj.notification.getMoreData');
    Route::get('/penanggung-jawab/specific-notification/{notification}' , 'UsersNotificationController@getSpecificNotification')->name('pj.notification.specificNotification');
    Route::put('/penanggung-jawab/mark-as-read/', 'UsersNotificationController@markAsReadNotification')->name('pj.notification.markAsRead');
    Route::delete('/penanggung-jawab/notification/delete-notifications' , 'UsersNotificationController@deleteNotification')->name('pj.notification.deleteNotification');

    Route::resource('/penanggung-jawab/mengelola-kegiatan', 'PJMengelolaKegiatanController',['names' =>[
        'index' => 'pj.kelola_kegiatan.index',
        'create' => 'pj.kelola_kegiatan.create',
        'show' => 'pj.kelola_kegiatan.show',
        'store' => 'pj.kelola_kegiatan.store',
        'edit' => 'pj.kelola_kegiatan.edit',
        'update' => 'pj.kelola_kegiatan.update'
    ]]);


   
    //show unggah dokumentasi ulang
    // Route::get('/penanggung-jawab/mengelola-kegiatan/dokumentasi-kegiatan/{dokumentasi_kegiatan}/edit-ulang', 'PJMengelolaKegiatanController@editDokumentasiUlang')
    // ->name('pj.dokumentasi_kegiatan.edit_ulang');
    Route::post('/penanggung-jawab/dokumentasi-kegiatan-ulang/{dokumentasi_kegiatan}/pengajuan-ulang', 'PJMengelolaKegiatanController@uploadDokumentasiUlang')->name('pj.dokumentasi_kegiatan.pengajuan_ulang');
    Route::post('/penanggung-jawab/unggah-dokumentasi-kegiatan/{dokumentasi_kegiatan}', 'PJMengelolaKegiatanController@uploadDokumentasi')->name('pj.dokumentasi_kegiatan.upload');

    Route::post('/penanggung-jawab/unggah-dokumentasi-kegiatan/dokumentasi-kegiatan/baru', 'PJMengelolaKegiatanController@uploadDokumentasiBaru')->name('pj.dokumentasi_kegiatan.upload_baru');
     //Unggah Dokumentasi Ulang
    //show sukses unggah dokumentasi dan belum disetujui dokumentasi
    Route::get('/penanggung-jawab/unggah-dokumentasi-kegiatan/dokumentasi/{dokumentasi_kegiatan}', 'PJMengelolaKegiatanController@showDokumentasi')
    ->name('pj.dokumentasi_kegiatan.show');
    Route::get('/penanggung-jawab/unggah-dokumentasi-kegiatan/{dokumentasi_kegiatan}/edit', 'PJMengelolaKegiatanController@editDokumentasi')
    ->name('pj.dokumentasi_kegiatan.edit');

    // Route::post('/penanggung-jawab/dokumentasi-kegiatan/upload-dokumen-baru/{id_dokumentasi}', 'PJMengelolaKegiatanController@uploadDokumenDokumentasiBaru')->name('pj.dokumentasi_kegiatan.uploadDokumenBaru');
    // Route::post('/penanggung-jawab/dokumentasi-kegiatan/edit-dokumen-dokumentasi/{status_dokumen}/{id}/{id_dokumen}', 'PJMengelolaKegiatanController@uploadDokumenDokumentasiEdit')->name('pj.dokumentasi_kegiatan.editDokumenDokumentasi');
    // Route::delete('/penanggung-jawab/dokumentasi-kegiatan/delete-dokumen-dokumentasi/{status_dokumen}/{id}/{id_dokumen}', 'PJMengelolaKegiatanController@deleteDokumenDokumentasi')->name('pj.dokumentasi_kegiatan.deleteDokumenDokumentasi');

    Route::resource('/penanggung-jawab/user-profile', 'UserProfileController', ['names' => [
        'index' => 'userprofile.pj.index',
        // 'edit' => 'userprofile.pj.edit',
    ]]);

    Route::post('/penanggung-jawab/user-profile/checkPass' , 'UserProfileController@checkerPass')->name('pj.userprofile.check');
    Route::put('/penanggung-jawab/user-profile/change-pass' , 'UserProfileController@update')->name('pj.userprofile.update');
    
    Route::get('/penanggung-jawab/search-notification/{search_notification}/search', 'UsersNotificationController@searchNotification')->name('pj.notification.searchNotify');
    Route::get('/penanggung-jawab/notifications', 'UsersNotificationController@getAllNotifications')->name('pj.userprofile.getAllNotify');
    Route::get('/penanggung-jawab/filter-notifications/{filterChoice}' , 'UsersNotificationController@orderByNotification')->name('pj.userprofile.orderNotify');
    Route::get('/penanggung-jawab/filter-notifications-by/{filterChoiceOne}/{filterChoiceTwo}', 'UsersNotificationController@orderByTwoChoiceNotifications')->name('pj.userprofile.orderTwoConditionNotify');
    // Route::put('/penanggung-jawab/read-notification/', 'UserProfileController@readNotification')->name('pj.userprofile.readNotificationFromProfile');
    Route::get('/penanggung-jawab/redirect', 'UsersNotificationController@linkAccessNotification')->name('pj.userprofile.links');
   
});

Route::group(['middleware' => 'KepalaSekolah'], function(){

    // Route::get('/kepalasekolah-home', 'KepalaSekolahController@index');

    Route::get('/kepala-sekolah/dokumentasi-kegiatan', 'KepalaSekolahMengelolaKegiatanController@indexDokumentasi')
    ->name('kepsek.pengajuan_dokumentasi_kegiatan.index');

    Route::get('/kepala-sekolah/get-notification', 'UsersNotificationController@getNotification')->name('kepsek.notification.getData');
    Route::get('/kepala-sekolah/get-more-notification/{request}' , 'UsersNotificationController@getMoreNotification')->name('kepsek.notification.getMoreData');
    Route::get('/kepala-sekolah/specific-notification/{notification}' , 'UsersNotificationController@getSpecificNotification')->name('kepsek.notification.specificNotification');
    Route::put('/kepala-sekolah/mark-as-read/', 'UsersNotificationController@markAsReadNotification')->name('kepsek.notification.markAsRead');
    Route::delete('/kepala-sekolah/notification/delete-notifications' , 'UsersNotificationController@deleteNotification')->name('kepsek.notification.deleteNotification');
   

    Route::resource('/kepala-sekolah/mengelola-kegiatan', 'KepalaSekolahMengelolaKegiatanController', ['names' => [
        'index' => 'kepsek.kelola_kegiatan.index',
        'edit' => 'kepsek.kelola_kegiatan.edit',
        'show' => 'kepsek.kelola_kegiatan.show',
        'update' => 'kepsek.kelola_kegiatan.update'
    ]]);
   
    //route for showdokumentasi => alias sudahnya Acc/Not dokumentasi kegiatan, menunggu keputusan dari pj
    Route::get('/kepala-sekolah/dokumentasi-kegiatan/{dokumentasi_kegiatan}', 'KepalaSekolahMengelolaKegiatanController@showDokumentasi')
    ->name('kepsek.pengajuan_dokumentasi_kegiatan.show');
    Route::get('/kepala-sekolah/dokumentasi-kegiatan/{dokumentasi_kegiatan}/edit', 'KepalaSekolahMengelolaKegiatanController@editDokumentasi')
    ->name('kepsek.pengajuan_dokumentasi_kegiatan.edit');
    Route::get('/kepala-sekolah/get-kegiatan/{dokumentasi_kegiatan}/{type_kegiatan}', 'KepalaSekolahMengelolaKegiatanController@get_data_kegiatan')
    ->name('kepsek.pengajuan_dokumentasi_kegiatan.get_kegiatan');
    Route::put('/kepala-sekolah/dokumentasi-kegiatan/{dokumentasi_kegiatan}/keputusan', 'KepalaSekolahMengelolaKegiatanController@updateDokumentasi')
    ->name('kepsek.pengajuan_dokumentasi_kegiatan.update');

    
    Route::resource('/kepala-sekolah/asesmen-ppk', 'KepalaSekolahAssessmenController' , ['names' => [
        'index' => 'kepsek.asesmen.index',
        'create' => 'kepsek.asesmen.create',
        'show' => 'kepsek.asesmen.show',
        'edit' => 'kepsek.asesmen.edit'
    ]]);
    
    Route::post('/kepala-sekolah/asesmen-ppk/store', 'KepalaSekolahAssessmenController@store')->name('kepsek.asesmen.store');
    Route::delete('/kepala-sekolah/asesmen-ppk/{id_asesmen}/delete' , 'KepalaSekolahAssessmenController@destroyAsesmen')->name('kepsek.asesmen.deleteAsesmenFull');
    Route::get('/kepala-sekolah/asesmen-ppk/dokumen/{id_asesmen}/{id}', 'KepalaSekolahAssessmenController@ambil_data_detail_asesmen')->name('kepsek.asesmen.ambilDetail');
    Route::get('/kepala-sekolah/asesmen-ppk/get-skor/{id_asesmen}/{id_indikator}/{skor_indikator}', 'KepalaSekolahAssessmenController@getSaranSkorDanDokumenAsesmen')->name('kepsek.asesmen.ambilSkor');
    Route::put('/kepala-sekolah/asesmen-ppk/save/{id}', 'KepalaSekolahAssessmenController@update')->name('kepsek.asesmen.update');
    Route::put('/kepala-sekolah/asesmen-ppk/save_info/{id_info}', 'KepalaSekolahAssessmenController@update_informasi')->name('kepsek.asesmen.update_informasi');
    Route::put('/kepala-sekolah/asesmen-ppk/update_dokumen/{file_name}/{id_indikator}/{id_asesmen}', 'KepalaSekolahAssessmenController@updateDokumen')->name('kepsek.asesmen.updateDoc');
    Route::post('/kepala-sekolah/asesmen-ppk/delete/{file_name}/{id_indikator}/{id_asesmen}', 'KepalaSekolahAssessmenController@destroy')->name('kepsek.asesmen.destroy');

    Route::resource('/kepala-sekolah/user-profile', 'UserProfileController', ['names' => [
        'index' => 'userprofile.kepsek.index',
       
    ]]);

    Route::post('/kepala-sekolah/user-profile/checkPass' , 'UserProfileController@checkerPass')->name('kepsek.userprofile.check');
    Route::put('/kepala-sekolah/user-profile/change-pass' , 'UserProfileController@update')->name('kepsek.userprofile.update');
    Route::get('/kepala-sekolah/search-notification/{search_notification}/search', 'UsersNotificationController@searchNotification')->name('kepsek.notification.searchNotify');
    Route::get('/kepala-sekolah/notifications', 'UsersNotificationController@getAllNotifications')->name('kepsek.userprofile.getAllNotify');
    Route::get('/kepala-sekolah/filter-notifications/{filterChoice}' , 'UsersNotificationController@orderByNotification')->name('kepsek.userprofile.orderNotify');
    Route::get('/kepala-sekolah/filter-notifications-by/{filterChoiceOne}/{filterChoiceTwo}', 'UsersNotificationController@orderByTwoChoiceNotifications')->name('kepsek.userprofile.orderTwoConditionNotify');
    
    Route::get('/kepala-sekolah/redirect', 'UsersNotificationController@linkAccessNotification')->name('kepsek.userprofile.links');
    
});

Route::get('/404', function(){
    return view("errors.404");
});


Route::fallback(function(){ 
    return response()->view('errors.404', [], 404); 
});