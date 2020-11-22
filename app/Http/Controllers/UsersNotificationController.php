<?php

namespace App\Http\Controllers;

use App\DokumentasiKegiatan;
use App\PengajuanKegiatan;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersNotificationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getNotification(){
        $userNotifications =  Auth::user()->unreadNotifications->sortByDesc('created_at')->take(9);
        $userUnreadNotifications = Auth::user()->unreadNotifications->sortByDesc('created_at');
        if (request()->ajax()) {
            if (!is_null($userNotifications)) {
                return response()->json(['notifications' => $userNotifications, 'unreadNotifications' => $userUnreadNotifications], 200);
            }
        }
    }

    // public function getMoreNotification($lastRequest){
    //     $userNotifications = Auth::user()->notifications->sortByDesc('created_at')->skip($lastRequest)->take(9);
    //     if (request()->ajax()) {
    //         if (!is_null($userNotifications)) {
    //             return response()->json(['moreNotifications' => $userNotifications], 200);
    //         }
    //     }
    // }

    public function markAsReadNotification(Request $request){
        if ($request->data != null) {
            $notification = Auth::user()->notifications->where('id',$request->data)->first();
            if ($request->page == 'accessLinks') {
                $link = "";
                if ($notification["read_at"] !== null) {
                    if (Auth::user()->Role->role_title == "Kepala Sekolah") {
                        if ($request->type == "Proposal Kegiatan") {
                            $pengajuan_kegiatan = $this->getDataKegiatan($request->type, $notification->data['kegiatan_id']);
                            if (gettype($pengajuan_kegiatan) != 'array') {
                                $link = $this->kepalaSekolahNotificationLinkAccess($notification, $request->type, $pengajuan_kegiatan);   
                            } else {
                                return $pengajuan_kegiatan;
                            }
                        } elseif($request->type == "Laporan Kegiatan"){
                            $dokumentasi_kegiatan = $this->getDataKegiatan($request->type, $notification->data['kegiatan_id']);
                            if(gettype($dokumentasi_kegiatan) != 'array'){
                                $link = $this->kepalaSekolahNotificationLinkAccess($notification, $request->type, $dokumentasi_kegiatan);
                            } else {
                                return $dokumentasi_kegiatan;
                            }
                        }
                    } else {
                        $link = $notification->data['link'];   
                    }
                    return response()->json(['status' => 'Connecting View' , 'link_data' => $link], 200);
                } else {
                    if (Auth::user()->Role->role_title == "Kepala Sekolah") {
                        if ($request->type == "Proposal Kegiatan") {
                            $pengajuan_kegiatan = $this->getDataKegiatan($request->type, $notification->data['kegiatan_id']);
                            if(gettype($pengajuan_kegiatan) != 'array'){
                                $link = $this->kepalaSekolahNotificationLinkAccess($notification, $request->type, $pengajuan_kegiatan);
                            } else {
                                return $pengajuan_kegiatan;
                            }
                        } elseif($request->type == "Laporan Kegiatan"){
                            $dokumentasi_kegiatan = $this->getDataKegiatan($request->type, $notification->data['kegiatan_id']);
                            if(gettype($dokumentasi_kegiatan) != 'array'){
                                $link = $this->kepalaSekolahNotificationLinkAccess($notification, $request->type, $dokumentasi_kegiatan);
                            } else {
                                return $dokumentasi_kegiatan;
                            }
                        }
                    } else {
                        $link = $notification->data['link'];
                    } 
                    $notification->markAsRead();
                    return response()->json(['status' => 'Read Success' , 'link_data' => $link], 200);
                }
            } elseif($request->page == 'read'){
                if ($notification == null) {
                    return response()->json(['errors' => ['Notification Not Found']], 404);
                }
                $notification->markAsRead();
                if ($request->lastRequest > 0) {
                    $getLastNotification = Auth::user()->unreadNotifications->sortByDesc('created_at')->skip($request->lastRequest)->take(1);
                    if (!is_null($getLastNotification)) {
                        return response()->json(['data' => 'Notification Successfully read', 'data_notification' => $getLastNotification], 200);
                    } else {
                        return response()->json(['data' => 'Notification Successfully read', 'data_notification' => false], 200);        
                    }
                }
                return response()->json(['data' => 'Notification Successfully read', 'data_notification' => false], 200);
            }
        }
        return response()->json(['errors' => ['Tidak dapat menemukan notifikasi']], 404);
    }

    public function getAllNotifications(){
        try {
            $data_user = User::findOrFail(Auth::user()->id);
        } catch (\Throwable $th) {
            return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
        } catch(ModelNotFoundException $evt) {
            return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
        }
        
        $notification = $data_user->notifications()->paginate(10);        
        $role = Auth::user()->Role->role_title;
        $counter_notification = $data_user->unreadNotifications()->count();
        if (request()->ajax()) {
            $notification = $data_user->notifications()->paginate(10);
            switch ($role) {
                case 'Penanggung Jawab Kegiatan':
                    return view('userprofile.pj.notification' , compact('notification' , 'counter_notification'));
                    break;
                case 'Kepala Sekolah':
                    return view('userprofile.kepsek.notification', compact('notification', 'counter_notification'));
                    break;
                default:
                    return redirect()->to('/404');
                    break;
            }
        }
        switch ($role) {
            case 'Penanggung Jawab Kegiatan':
                return view('userprofile.pj.notification_page', compact('notification' , 'counter_notification'));
                break;
            case 'Kepala Sekolah':
                return view('userprofile.kepsek.notification_page', compact('notification' , 'counter_notification'));
                break;
            default:
                return redirect()->to('/404');
                break;
        }
    }
    
    public function searchNotification($searchValue){
        try {
            $user = User::findOrFail(Auth::user()->id);
        } catch (\Throwable $th) {
            return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
        } catch(ModelNotFoundException $evt) {
            return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
        }
        //thanks stack overflow!
        if (request()->ajax()) {
            $notification = $user->notifications()
            ->Where('notifiable_id' , $user->id)
            ->Where(function($query) use ($searchValue){
                $query->Where('data','LIKE','%"user_pj":"%'.$searchValue.'%"%')
                ->orWhere('data','LIKE','%"nama_kegiatan":"%'.$searchValue.'%"%')
                ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$searchValue.'%"%')
                ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$searchValue.'%"%')
                ->orWhere('data' , 'LIKE' , '%"status_kegiatan:"%'.$searchValue.'%"%')
                ->orWhere('data' , 'LIKE', '%"type_notification:"%'.$searchValue.'%"%');
            })->paginate(10);
            return $this->redirectToRespectivePageNotifications($notification , Auth::user()->Role->role_title);
        }
    }

    public function orderByNotification($option){
        try {
            $user = User::findOrFail(Auth::user()->id);
        } catch (\Throwable $th) {
            return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
        } catch(ModelNotFoundException $evt) {
            return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
        }

        if (request()->ajax()) {
            $orderChoice = ucwords($option);
            if ($orderChoice == "Terlama") {
                $notification = $user->oldestNotifications()->paginate(10);
            } elseif($orderChoice == "Belum Disetujui" || $orderChoice == "Pengajuan Ulang" || $orderChoice == "Menolak" || $orderChoice == "Sudah Disetujui"){
                $notification = $user->notifications()
                                ->Where('data' , 'LIKE', '%"status_kegiatan":"'.$orderChoice.'"%')
                                ->paginate(10);
            } elseif($orderChoice == "Terbaru"){
                $notification = $user->notifications()->paginate(10);
            }
            return $this->redirectToRespectivePageNotifications($notification , Auth::user()->Role->role_title);
        }
    }

    public function orderByTwoChoiceNotifications($optionOne , $optionTwo){
        try {
            $user = User::findOrFail(Auth::user()->id);
        } catch (\Throwable $th) {
            return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
        } catch(ModelNotFoundException $evt) {
            return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
        }

        if (request()->ajax()) {
            $orderChoice = ucwords($optionTwo);
            if ($orderChoice === "Terlama") {
                //order by asc
                $notification = $user->oldestNotifications()
                ->Where('notifiable_id' , $user->id)
                ->Where(function($query) use ($optionOne){
                    $query->Where('data' , 'LIKE' , '%"status_kegiatan":"%'.$optionOne.'%"%')
                    ->orWhere('data','LIKE','%"user_pj":"%'.$optionOne.'%"%')
                    ->orWhere('data','LIKE','%"nama_kegiatan":"%'.$optionOne.'%"%')
                    ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$optionOne.'%"%')
                    ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$optionOne.'%"%')
                    ->orWhere('data', 'LIKE' , '%"type_notification":"%'.$optionOne.'%"%');
                })
                ->paginate(10);
            } elseif($orderChoice == "Belum Disetujui" || $orderChoice == "Pengajuan Ulang" || $orderChoice == "Menolak" || $orderChoice == "Sudah Disetujui") {
                $notification = $user->notifications()
                ->Where('data' , 'LIKE', '%"status_kegiatan":"%'.$orderChoice.'%"%')
                ->Where('notifiable_id' , $user->id)
                ->Where(function($query) use ($optionOne){
                    $query->where('data' , 'LIKE' , '%"status_kegiatan":"%'.$optionOne.'%"%')
                    ->orWhere('data','LIKE','%"user_pj":"%'.$optionOne.'%"%')
                    ->orWhere('data','LIKE','%"nama_kegiatan":"%'.$optionOne.'%"%')
                    ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$optionOne.'%"%')
                    ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$optionOne.'%"%')
                    ->orWhere('data', 'LIKE' , '%"type_notification":"%'.$optionOne.'%"%');
                })->paginate(10);               
            } elseif($orderChoice == "Terbaru"){
                $notification = $user->notifications()
                ->Where('notifiable_id' , $user->id)
                ->Where(function($query) use ($optionOne){
                    $query->Where('data' , 'LIKE' , '%"status_kegiatan":"%'.$optionOne.'%"%')
                    ->orWhere('data','LIKE','%"user_pj":"%'.$optionOne.'%"%')
                    ->orWhere('data','LIKE','%"nama_kegiatan":"%'.$optionOne.'%"%')
                    ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$optionOne.'%"%')
                    ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$optionOne.'%"%')
                    ->orWhere('data', 'LIKE' , '%"type_notification":"%'.$optionOne.'%"%');
                })->paginate(10);
            }
            return $this->redirectToRespectivePageNotifications($notification , Auth::user()->Role->role_title);
            
        }

    }

    public function redirectToRespectivePageNotifications($notification , $roles){
        switch ($roles) {
            case 'Penanggung Jawab Kegiatan':
                return view('userprofile.pj.notification', compact('notification'));
                break;
            case 'Kepala Sekolah':
                return view('userprofile.kepsek.notification', compact('notification'));
                break;
            default:
                return redirect()->to('/404');
                break;
        }
    }

    public function linkAccessNotification(Request $request){
        $links = "";
        if (Auth::user()->Role->role_title == "Kepala Sekolah") {
            $notification = Auth::user()->notifications->where('id' , $request->data)->first();
            if ($request->type == "Proposal Kegiatan") {
                try {
                    $pengajuan_kegiatan = PengajuanKegiatan::findOrFail($notification->data['kegiatan_id']);
                } catch (\Throwable $th) {
                    return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
                } catch(ModelNotFoundException $evt) {
                    return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
                }
                $links = $this->kepalaSekolahNotificationLinkAccess($notification, $request->type, $pengajuan_kegiatan);
            } elseif($request->type == "Laporan Kegiatan"){
                try {
                    $dokumentasi_kegiatan = DokumentasiKegiatan::findOrFail($notification->data['kegiatan_id']);
                } catch (\Throwable $th) {
                    return response()->json(['messages' => ['Terdapat Error Ketika Mengambil Notifikasi, System Error Message: '.$th->getMessage()]], 404);
                } catch(ModelNotFoundException $evt) {
                    return response()->json(['messages' => ['Data User Tidak Dapat Ditemukan!, System Error Message: '.$evt->getMessage()]], 404);
                }
                $links = $this->kepalaSekolahNotificationLinkAccess($notification, $request->type, $dokumentasi_kegiatan);
            }
        } else {
            $links = $request->linkAccess;
        }
        return response()->json(['data' => 'Connecting View' , 'redirect_link' => $links], 200);
    }

    private function kepalaSekolahNotificationLinkAccess($notification_data, $kegiatan_type , $data_kegiatan){
        if ($kegiatan_type == "Proposal Kegiatan") {
            foreach ($data_kegiatan->statusKegiatan as $status) {
                $status_kegiatan_id = $status->pivot->status_kegiatan_id;
            }
            if ($status_kegiatan_id == 1) {
                $link = $notification_data->data['link_changed'];
            } elseif($status_kegiatan_id == 3) {
                $link = $notification_data->data['link'];
            } elseif($status_kegiatan_id == 4){
                $link = $notification_data->data['link_changed'];
            }else if($status_kegiatan_id == 5){
                $link = $notification_data->data['link_changed'];
            }
        } elseif($kegiatan_type == "Laporan Kegiatan"){
            foreach ($data_kegiatan->statusKegiatan as $status) {
                $status_kegiatan = $status->pivot->status_kegiatan_id;
            }
            if ($status_kegiatan == 2) {
                $link = $notification_data->data['link_changed'];
               
            } elseif($status_kegiatan == 3){
                $link = $notification_data->data['link'];
               
            } elseif ($status_kegiatan == 4) {
                $link = $notification_data->data['link_changed'];
            } elseif($status_kegiatan == 6){
                $link = $notification_data->data['link_changed'];
               
            }
        }
        return $link;
    }

    private function getDataKegiatan($type, $requestID){
        if ($type == "Proposal Kegiatan") {
            try {
                $kegiatan = PengajuanKegiatan::findOrFail($requestID);
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json(['messages' => $th->getMessage()], 404);
            } catch (ModelNotFoundException $e){
                return response()->json(['messages' => $e->getMessage()], 404);
            }
            return $kegiatan;
        } elseif($type == "Laporan Kegiatan"){
            try {
                $kegiatan = DokumentasiKegiatan::findOrFail($requestID);
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json(['messages' => $th->getMessage()], 404);
            } catch (ModelNotFoundException $e){
                return response()->json(['messages' => $e->getMessage()], 404);
            }
            return $kegiatan;
        }
    }

}