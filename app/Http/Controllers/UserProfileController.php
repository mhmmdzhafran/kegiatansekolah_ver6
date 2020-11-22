<?php

namespace App\Http\Controllers;

use App\DokumentasiKegiatan;
use App\Http\Requests\CheckerPassValidationRequest;
use App\Http\Requests\UpdatePassValidationRequest;
use App\PengajuanKegiatan;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserProfileController extends Controller
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
        try {
            $data_user = User::findOrFail(Auth::user()->id);
        } catch (\Throwable $th) {
            return response()->json(['messages' => 'Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()], 404);
        } catch(ModelNotFoundException $evt) {
            return response()->json(['messages' => 'Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()], 404);
        }

        $role = Auth::user()->Role->role_title;
        $counter_notification = $data_user->unreadNotifications()->count();
        switch ($role) {
            case 'Penanggung Jawab Kegiatan':
                return view('userprofile.pj.index', compact('data_user' , 'role', 'counter_notification'));
                break;
            case 'Kepala Sekolah':
                return view('userprofile.kepsek.index', compact('data_user' , 'role' , 'counter_notification'));
                break;
            default:
                return redirect()->to('/404');
                break;
        }
    }

    public function checkerPass(CheckerPassValidationRequest $request){
        $user_info = Auth::user()->password;
        $checkRule = Hash::check($request->password, $user_info);
        if ($checkRule) {
            return Response::json(['data' => 'data is valid'], 200);
        }
        return Response::json(['errors' => ['Password Tidak Cocok, Silahkan Masukkan Kembali']], 422);
    }

    // public function getAllNotifications(){
    //     try {
    //         $data_user = User::findOrFail(Auth::user()->id);
    //     } catch (\Throwable $th) {
    //         return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
    //     } catch(ModelNotFoundException $evt) {
    //         return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
    //     }
        
    //     $notification = $data_user->notifications()->paginate(10);        
    //     $role = Auth::user()->Role->role_title;
    //     $counter_notification = $data_user->unreadNotifications()->count();
    //     if (request()->ajax()) {
    //         $notification = $data_user->notifications()->paginate(10);
    //         switch ($role) {
    //             case 'Penanggung Jawab Kegiatan':
    //                 return view('userprofile.pj.notification' , compact('notification' , 'counter_notification'));
    //                 break;
    //             case 'Kepala Sekolah':
    //                 return view('userprofile.kepsek.notification', compact('notification', 'counter_notification'));
    //                 break;
    //             default:
    //                 return redirect()->to('/404');
    //                 break;
    //         }
    //     }
    //     switch ($role) {
    //         case 'Penanggung Jawab Kegiatan':
    //             return view('userprofile.pj.notification_page', compact('notification' , 'counter_notification'));
    //             break;
    //         case 'Kepala Sekolah':
    //             return view('userprofile.kepsek.notification_page', compact('notification' , 'counter_notification'));
    //             break;
    //         default:
    //             return redirect()->to('/404');
    //             break;
    //     }
    // }
    
    // public function searchNotification($searchValue){
    //     try {
    //         $user = User::findOrFail(Auth::user()->id);
    //     } catch (\Throwable $th) {
    //         return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
    //     } catch(ModelNotFoundException $evt) {
    //         return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
    //     }
    //     //thanks stack overflow!
    //     if (request()->ajax()) {
    //         $notification = $user->notifications()
    //         ->Where('notifiable_id' , $user->id)
    //         ->Where(function($query) use ($searchValue){
    //             $query->Where('data','LIKE','%"user_pj":"%'.$searchValue.'%"%')
    //             ->orWhere('data','LIKE','%"nama_kegiatan":"%'.$searchValue.'%"%')
    //             ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$searchValue.'%"%')
    //             ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$searchValue.'%"%')
    //             ->orWhere('data' , 'LIKE' , '%"status_kegiatan:"%'.$searchValue.'%"%')
    //             ->orWhere('data' , 'LIKE', '%"type_notification:"%'.$searchValue.'%"%');
    //         })->paginate(10);
    //         return $this->redirectToRespectivePageNotifications($notification , Auth::user()->Role->role_title);
    //     }
    // }

    // public function orderByNotification($option){
    //     try {
    //         $user = User::findOrFail(Auth::user()->id);
    //     } catch (\Throwable $th) {
    //         return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
    //     } catch(ModelNotFoundException $evt) {
    //         return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
    //     }

    //     if (request()->ajax()) {
    //         $orderChoice = ucwords($option);
    //         if ($orderChoice == "Terlama") {
    //             $notification = $user->oldestNotifications()->paginate(10);
    //         } elseif($orderChoice == "Belum Disetujui" || $orderChoice == "Pengajuan Ulang" || $orderChoice == "Menolak" || $orderChoice == "Sudah Disetujui"){
    //             $notification = $user->notifications()
    //                             ->Where('data' , 'LIKE', '%"status_kegiatan":"'.$orderChoice.'"%')
    //                             ->paginate(10);
    //         } elseif($orderChoice == "Terbaru"){
    //             $notification = $user->notifications()->paginate(10);
    //         }
    //         return $this->redirectToRespectivePageNotifications($notification , Auth::user()->Role->role_title);
    //     }
    // }

    // public function orderByTwoChoiceNotifications($optionOne , $optionTwo){
    //     try {
    //         $user = User::findOrFail(Auth::user()->id);
    //     } catch (\Throwable $th) {
    //         return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
    //     } catch(ModelNotFoundException $evt) {
    //         return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
    //     }

    //     if (request()->ajax()) {
    //         $orderChoice = ucwords($optionTwo);
    //         if ($orderChoice === "Terlama") {
    //             //order by asc
    //             $notification = $user->oldestNotifications()
    //             ->Where('notifiable_id' , $user->id)
    //             ->Where(function($query) use ($optionOne){
    //                 $query->Where('data' , 'LIKE' , '%"status_kegiatan":"%'.$optionOne.'%"%')
    //                 ->orWhere('data','LIKE','%"user_pj":"%'.$optionOne.'%"%')
    //                 ->orWhere('data','LIKE','%"nama_kegiatan":"%'.$optionOne.'%"%')
    //                 ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$optionOne.'%"%')
    //                 ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$optionOne.'%"%')
    //                 ->orWhere('data', 'LIKE' , '%"type_notification":"%'.$optionOne.'%"%');
    //             })
    //             ->paginate(10);
    //         } elseif($orderChoice == "Belum Disetujui" || $orderChoice == "Pengajuan Ulang" || $orderChoice == "Menolak" || $orderChoice == "Sudah Disetujui") {
    //             $notification = $user->notifications()
    //             ->Where('data' , 'LIKE', '%"status_kegiatan":"%'.$orderChoice.'%"%')
    //             ->Where('notifiable_id' , $user->id)
    //             ->Where(function($query) use ($optionOne){
    //                 $query->where('data' , 'LIKE' , '%"status_kegiatan":"%'.$optionOne.'%"%')
    //                 ->orWhere('data','LIKE','%"user_pj":"%'.$optionOne.'%"%')
    //                 ->orWhere('data','LIKE','%"nama_kegiatan":"%'.$optionOne.'%"%')
    //                 ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$optionOne.'%"%')
    //                 ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$optionOne.'%"%')
    //                 ->orWhere('data', 'LIKE' , '%"type_notification":"%'.$optionOne.'%"%');
    //             })->paginate(10);               
    //         } elseif($orderChoice == "Terbaru"){
    //             $notification = $user->notifications()
    //             ->Where('notifiable_id' , $user->id)
    //             ->Where(function($query) use ($optionOne){
    //                 $query->Where('data' , 'LIKE' , '%"status_kegiatan":"%'.$optionOne.'%"%')
    //                 ->orWhere('data','LIKE','%"user_pj":"%'.$optionOne.'%"%')
    //                 ->orWhere('data','LIKE','%"nama_kegiatan":"%'.$optionOne.'%"%')
    //                 ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$optionOne.'%"%')
    //                 ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$optionOne.'%"%')
    //                 ->orWhere('data', 'LIKE' , '%"type_notification":"%'.$optionOne.'%"%');
    //             })->paginate(10);
    //         }
    //         return $this->redirectToRespectivePageNotifications($notification , Auth::user()->Role->role_title);
            
    //     }

    // }

    // public function readNotification(Request $request){
    //     $notification = Auth::user()->notifications->where('id' , $request->data)->first();
    //     if ($notification === null) {
    //         return response()->json(['errors' => ['Notification Not Found']], 404);
    //     }
    //     // $newLink = $notification->data['link_changed'];
    //     $notification->markAsRead();
    //     return response()->json(['data' => 'Notification Successfully read'], 200);
    // }

    // public function linkAccessNotification(Request $request){
    //     $links = "";
    //     if (Auth::user()->Role->role_title == "Kepala Sekolah") {
    //         $notification = Auth::user()->notifications->where('id' , $request->data)->first();
    //         if ($request->type == "Proposal Kegiatan") {
    //             try {
    //                 $pengajuan_kegiatan = PengajuanKegiatan::findOrFail($notification->data['kegiatan_id']);
    //             } catch (\Throwable $th) {
    //                 return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
    //             } catch(ModelNotFoundException $evt) {
    //                 return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
    //             }
    //             $links = $this->kepalaSekolahAccessLinks($notification, $request->type, $pengajuan_kegiatan);
    //         } elseif($request->type == "Laporan Kegiatan"){
    //             try {
    //                 $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($notification->data['kegiatan_id']);
    //             } catch (\Throwable $th) {
    //                 return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
    //             } catch(ModelNotFoundException $evt) {
    //                 return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
    //             }
    //             $links = $this->kepalaSekolahAccessLinks($notification, $request->type, $dokumentasi_kegiatan);
    //         }
    //     } else {
    //         $links = $request->linkAccess;
    //     }
    //     return response()->json(['data' => 'Connecting View' , 'redirect_link' => $links], 200);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePassValidationRequest $request)
    {
        //
        //for changing password
        try {
            $user = User::findOrFail(Auth::user()->id);
        } catch (\Throwable $th) {
            return Response::json(['messages' => $th->getMessage()], 404);
        } catch(ModelNotFoundException $e) {
            return Response::json(['messages' => "Data Anda Tidak Dapat Ditemukkan, Silahkan Kontak Admin! ID yang diberikan: ".Auth::user()->id."System Error Code: ".$e->getMessage()], 404);
        }
        $passwordInput = $request->passwordBaru;
        $passwordChecker = $request->passwordChecker;
        if ($passwordInput != $passwordChecker) {
            return Response::json(['errors' => ['Password Anda Tidak Cocok, Silahkan Isi Ulang Kembali']], 422);
        } 
        $input['password'] = bcrypt($passwordChecker);
        $updatePass = $user->update($input);
        if (!$updatePass) {
            return Response::json(['errors' => ['Terdapat Kendala Saat Melakukan Pengubahan Password, Silahkan Coba Kembali!']], 422);
        }
        return Response::json(['message' => 'data is valid'], 200);
    }

    // public function redirectToRespectivePageNotifications($notification , $roles){
    //     switch ($roles) {
    //         case 'Penanggung Jawab Kegiatan':
    //             return view('userprofile.pj.notification', compact('notification'));
    //             break;
    //         case 'Kepala Sekolah':
    //             return view('userprofile.kepsek.notification', compact('notification'));
    //             break;
    //         default:
    //             return redirect()->to('/404');
    //             break;
    //     }
    // }

    // private function kepalaSekolahAccessLinks($notification_data, $type, $data_kegiatan){
    //     if ($type == "Proposal Kegiatan") {
    //         foreach ($data_kegiatan->statusKegiatan as $status) {
    //             $status_kegiatan_id = $status->pivot->status_kegiatan_id;
    //         }
    //         if ($status_kegiatan_id == 1) {
    //             $link = $notification_data->data['link_changed'];
    //         } elseif($status_kegiatan_id == 3) {
    //             $link = $notification_data->data['link'];
    //         } elseif($status_kegiatan_id == 5){
    //             $link = $notification_data->data['link_changed'];
    //         }
    //     } elseif($type == "Laporan Kegiatan"){
    //         foreach ($data_kegiatan->statusKegiatan as $status) {
    //             $status_kegiatan_id = $status->pivot->status_kegiatan_id;
    //         }
    //         if ($status_kegiatan_id == 1) {
    //             $link = $notification_data->data['link_changed'];
    //         } elseif($status_kegiatan_id == 3) {
    //             $link = $notification_data->data['link'];
    //         } elseif($status_kegiatan_id == 5){
    //             $link = $notification_data->data['link_changed'];
    //         }
    //     }
    //     return $link;
    // }
}
