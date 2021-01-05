<?php

namespace App\Http\Controllers;

use App\Repository\FindDataRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersNotificationController extends Controller
{
    //
    protected $findData;
    public function __construct(FindDataRepository $findDataRepository)
    {
        $this->middleware('auth');
        $this->findData = $findDataRepository;
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

    public function markAsReadNotification(Request $request){
        if ($request->data != null) {
            $notification = Auth::user()->notifications->where('id',$request->data)->first();
            if ($request->page == 'accessLinks') {
                if ($notification == null) {
                    return response()->json(['errors' => ['Notification Not Found']], 404);
                }
                return $this->getLinkMarkAsRead($notification, $request->type);
            } elseif($request->page == 'read'){
                if ($notification == null) {
                    return response()->json(['errors' => ['Notification Not Found']], 404);
                }
                $notification->markAsRead();
                
                return $this->getLastNotification($request->lastRequest , 'read');
            }
        } else {
            return response()->json(['errors' => ['Tidak dapat menemukan notifikasi']], 404);
        }
    }

    public function getAllNotifications(){
    
        $notification = Auth::user()->notifications()->paginate(10);        
        $role = Auth::user()->Role->role_title;
        $counter_notification = Auth::user()->unreadNotifications()->count();
        if (request()->ajax()) {
            $notification = Auth::user()->notifications()->paginate(10);
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
       
        if (request()->ajax()) {
            $notification = Auth::user()->notifications()
            ->Where('notifiable_id' , Auth::user()->id)
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
        
        
        if (request()->ajax()) {
            $orderChoice = ucwords($option);
            if ($orderChoice == "Terlama") {
                $notification = Auth::user()->oldestNotifications()->paginate(10);
            } elseif($orderChoice == "Belum Disetujui" || $orderChoice == "Pengajuan Ulang" || $orderChoice == "Menolak" || $orderChoice == "Sudah Disetujui" || $orderChoice == 'Sudah Mengunggah Dokumentasi'){
                $notification = Auth::user()->notifications()
                                ->Where('data' , 'LIKE', '%"status_kegiatan":"'.$orderChoice.'"%')
                                ->paginate(10);
            } elseif($orderChoice == "Terbaru"){
                $notification = Auth::user()->notifications()->paginate(10);
            }
            return $this->redirectToRespectivePageNotifications($notification , Auth::user()->Role->role_title);
        }
    }

    public function orderByTwoChoiceNotifications($optionOne , $optionTwo){
       

        if (request()->ajax()) {
            $orderChoice = ucwords($optionTwo);
            if ($orderChoice === "Terlama") {
                //order by asc
                $notification = Auth::user()->oldestNotifications()
                ->Where('notifiable_id' , Auth::user()->id)
                ->Where(function($query) use ($optionOne){
                    $query->Where('data' , 'LIKE' , '%"status_kegiatan":"%'.$optionOne.'%"%')
                    ->orWhere('data','LIKE','%"user_pj":"%'.$optionOne.'%"%')
                    ->orWhere('data','LIKE','%"nama_kegiatan":"%'.$optionOne.'%"%')
                    ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$optionOne.'%"%')
                    ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$optionOne.'%"%')
                    ->orWhere('data', 'LIKE' , '%"type_notification":"%'.$optionOne.'%"%');
                })
                ->paginate(10);
            } elseif($orderChoice == "Belum Disetujui" || $orderChoice == "Pengajuan Ulang" || $orderChoice == "Menolak" || $orderChoice == "Sudah Disetujui" || $orderChoice == 'Sudah Mengunggah Dokumentasi') {
                $notification = Auth::user()->notifications()
                ->Where('data' , 'LIKE', '%"status_kegiatan":"%'.$orderChoice.'%"%')
                ->Where('notifiable_id' , Auth::user()->id)
                ->Where(function($query) use ($optionOne){
                    $query->where('data' , 'LIKE' , '%"status_kegiatan":"%'.$optionOne.'%"%')
                    ->orWhere('data','LIKE','%"user_pj":"%'.$optionOne.'%"%')
                    ->orWhere('data','LIKE','%"nama_kegiatan":"%'.$optionOne.'%"%')
                    ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$optionOne.'%"%')
                    ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$optionOne.'%"%')
                    ->orWhere('data', 'LIKE' , '%"type_notification":"%'.$optionOne.'%"%');
                })->paginate(10);               
            } elseif($orderChoice == "Terbaru"){
                $notification = Auth::user()->notifications()
                ->Where('notifiable_id' , Auth::user()->id)
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

    public function deleteNotification(Request $request){
       
        $findNotification = Auth::user()->notifications->where('id' , $request->notificationID)->first();
        if (is_null($findNotification)) {
            return response()->json(['errors' => ['Tidak menemukan notifikasi']], 422);    
        }
        $deleteNotification = $findNotification->delete();
        if ($deleteNotification) {
            return $this->getLastNotification($request->lastRequest, 'delete');
        }
        return response()->json(['errors' => ['destroy notification id unsuccessful']], 422);    
    }

    public function getLastNotification($lastNotificationCounter, $state){
        if ($lastNotificationCounter > 0) {
            $getLastNotification = Auth::user()->unreadNotifications->sortByDesc('created_at')->skip($lastNotificationCounter)->take(1);
            if (!is_null($getLastNotification)) {
                if ($state == 'read') {
                    return response()->json(['data' => 'Notification Successfully read', 'data_notification' => $getLastNotification], 200);
                } elseif($state == 'delete'){
                    return response()->json(['data' => 'destroy notification id success', 'data_notification' => $getLastNotification], 200);
                }
            } else {
                if ($state == 'read') {
                    return response()->json(['data' => 'Notification Successfully read', 'data_notification' => false], 200); 
                } elseif($state == 'delete'){
                    return response()->json(['data' => 'destroy notification id success', 'data_notification' => false], 200);
                }      
            }
        } else {
            if ($state == 'read') {
                return response()->json(['data' => 'Notification Successfully read', 'data_notification' => false], 200);
            } elseif($state == 'delete') {
                return response()->json(['data' => 'destroy notification id success', 'data_notification' => false], 200);
            }
        }
    }

    
    public function getLinkMarkAsRead($notification,$tipeKegiatan){
       
            if (Auth::user()->Role->role_title == "Kepala Sekolah") {
                if ($tipeKegiatan == "Proposal Kegiatan") {
                    $pengajuan_kegiatan = $this->findData->findDataModel($notification->data['kegiatan_id'], 'Proposal');
                    if(gettype($pengajuan_kegiatan) != 'string'){
                        $link = $this->kepalaSekolahNotificationLinkAccess($notification, $tipeKegiatan, $pengajuan_kegiatan);
                    } else {
                        return response()->json(['messages' => $pengajuan_kegiatan], 404);
                    }
                } elseif($tipeKegiatan == "Laporan Kegiatan"){
                    $dokumentasi_kegiatan = $this->findData->findDataModel($notification->data['kegiatan_id'], 'Laporan');
                    if(gettype($dokumentasi_kegiatan) != 'string'){
                        $link = $this->kepalaSekolahNotificationLinkAccess($notification, $tipeKegiatan, $dokumentasi_kegiatan);
                    } else {
                        return response()->json(['messages' => $dokumentasi_kegiatan], 404);
                    }
                }
            } else {
                $link = $notification->data['link'];
            }
            $notification->markAsRead();
            return response()->json(['status' => 'Read Success' , 'link_data' => $link], 200);
        
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
                $pengajuan_kegiatan = $this->findData->findDataModel($notification->data['kegiatan_id'], 'Proposal');
                if (gettype($pengajuan_kegiatan) == 'string') {
                    return response()->json(['messages' => [$pengajuan_kegiatan]], 404);
                }
              
                $links = $this->kepalaSekolahNotificationLinkAccess($notification, $request->type, $pengajuan_kegiatan);
            } elseif($request->type == "Laporan Kegiatan"){
                $dokumentasi_kegiatan = $this->findData->findDataModel($notification->data['kegiatan_id'] , 'Laporan');
                if (gettype($dokumentasi_kegiatan) == 'string') {
                    return response()->json(['messages' => [$dokumentasi_kegiatan]], 404);
                }
               
                $links = $this->kepalaSekolahNotificationLinkAccess($notification, $request->type, $dokumentasi_kegiatan);
            }
        } else {
            $links = $request->linkAccess;
        }
        return response()->json(['data' => 'Connecting View' , 'redirect_link' => $links], 200);
    }

    private function kepalaSekolahNotificationLinkAccess($notification_data, $kegiatan_type , $data_kegiatan){
        foreach ($data_kegiatan->statusKegiatan as $status) {
            $status_kegiatan = $status->pivot->status_kegiatan_id;
        }
        if ($kegiatan_type == "Proposal Kegiatan") {
            if ($status_kegiatan == 1) {
                $link = $notification_data->data['link_changed'];
            } elseif($status_kegiatan == 3) {
                $link = $notification_data->data['link'];
            } elseif($status_kegiatan == 4){
                $link = $notification_data->data['link_changed'];
            }else if($status_kegiatan == 5){
                $link = $notification_data->data['link_changed'];
            }
        } elseif($kegiatan_type == "Laporan Kegiatan"){
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

}