<?php

namespace App\Http\Controllers;

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
        $userNotifications =  Auth::user()->notifications->sortByDesc('created_at')->take(9);
        $userUnreadNotifications = Auth::user()->unreadNotifications->sortByDesc('created_at');
        if (request()->ajax()) {
            if (!is_null($userNotifications)) {
                return response()->json(['notifications' => $userNotifications, 'unreadNotifications' => $userUnreadNotifications], 200);
            }
        }
    }

    public function getMoreNotification($lastRequest){
        $userNotifications = Auth::user()->notifications->sortByDesc('created_at')->skip($lastRequest)->take(9);
        if (request()->ajax()) {
            if (!is_null($userNotifications)) {
                return response()->json(['moreNotifications' => $userNotifications], 200);
            }
        }
    }

    public function getSpecificNotification($notification_id){
        $getNotification = Auth::user()->notifications->where('id' , $notification_id)->first();
        if (request()->ajax()) {
            return response()->json(['data' => $getNotification], 200);
        }
    }

    public function markAsReadNotification(Request $request){
        if ($request->data !== null) {
            $notification = Auth::user()->notifications->where('id',$request->data)->first();
            if ($notification["read_at"] !== null) {
                return response()->json(['data' => 'Connecting View'], 200);
            }
            $notification->markAsRead();
            return response()->json(['data' => 'Read Success'], 200);
        }
        return response()->json(['data_error' => 'Tidak dapat menemukan notifikasi'], 404);
    }
}
