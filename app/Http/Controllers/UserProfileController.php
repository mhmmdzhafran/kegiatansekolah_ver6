<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckerPassValidationRequest;
use App\Http\Requests\UpdatePassValidationRequest;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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
        $data_user = User::findOrFail(Auth::user()->id);
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

    //function notification sementara kepsek dulu
    
    public function getAllNotifications(){
        $data_user = User::findOrFail(Auth::user()->id);
        $notification = $data_user->notifications()->paginate(10);        
        $role = Auth::user()->Role->role_title;
        $counter_notification = $data_user->unreadNotifications()->count();
        if (request()->ajax()) {
            $notification = $data_user->notifications()->paginate(10);
            switch ($role) {
                case 'Penanggung Jawab Kegiatan':
                    //belom ada
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
                return view('userprofile.pj.index', compact('notification'));
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
            
        } catch(ModelNotFoundException $evt) {

        }
        //thanks stack overflow!
        if (request()->ajax()) {
            $notification= $user->notifications()
            ->Where('data','LIKE','%"user_pj":"'.$searchValue.'"%')
            ->orWhere('data','LIKE','%"nama_proposal_kegiatan":"'.$searchValue.'"%')
            ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$searchValue.'%"%')
            ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$searchValue.'%"%')
            ->orderBy('created_at' , 'desc')
            ->paginate(10);
            return view('userprofile.kepsek.notification', compact('notification'));
        }
    }

    public function orderByNotification($option){
        try {
            $user = User::findOrFail(Auth::user()->id);
        } catch (\Throwable $th) {
            // return response()->json[]
        } catch(ModelNotFoundException $evt) {

        }

        if (request()->ajax()) {
            $orderChoice = ucwords($option);
            if ($orderChoice == "Terlama") {
                $notification = $user->oldestNotifications()->paginate(10);
                return view('userprofile.kepsek.notification', compact('notification'));
            } elseif($orderChoice == "Sudah Mengunggah Dokumentasi" || $orderChoice == "Belum Disetujui"){
                $notification = $user->notifications()
                                ->Where('data' , 'LIKE', '%"status_kegiatan":"'.$orderChoice.'"%')
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
                return view('userprofile.kepsek.notification', compact('notification'));
            } elseif($orderChoice == "Terbaru"){
                $notification = $user->notifications()->paginate(10);
                return view('userprofile.kepsek.notification', compact('notification'));
            }
        }
    }

    public function orderByTwoChoiceNotifications($optionOne , $optionTwo){
        try {
            $user = User::findOrFail(Auth::user()->id);
        } catch (\Throwable $th) {
            //throw $th;
        } catch (ModelNotFoundException $evt) {

        }

        if (request()->ajax()) {
            $orderChoice = ucwords($optionTwo);
            if ($orderChoice === "Terlama") {
                //order by asc
                $notification = $user->oldestNotifications()
                ->Where('data' , 'LIKE' , '%"status_kegiatan":"'.$optionOne.'"%')
                ->orWhere('data','LIKE','%"user_pj":"'.$optionOne.'"%')
                ->orWhere('data','LIKE','%"nama_proposal_kegiatan":"'.$optionOne.'"%')
                ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$optionOne.'%"%')
                ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$optionOne.'%"%')
                ->paginate(10);
                return view('userprofile.kepsek.notification', compact('notification'));
            } elseif($orderChoice === "Belum Disetujui" || $orderChoice === "Sudah Mengunggah Dokumentasi") {
                $notification = $user->notifications()
                ->Where('data' , 'LIKE', '%"status_kegiatan":"%'.$orderChoice.'%"%')
                ->Where(function($query) use ($optionOne){
                    $query->where('data' , 'LIKE' , '%"status_kegiatan":"'.$optionOne.'"%')
                    ->orWhere('data','LIKE','%"user_pj":"'.$optionOne.'"%')
                    ->orWhere('data','LIKE','%"nama_proposal_kegiatan":"'.$optionOne.'"%')
                    ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$optionOne.'%"%')
                    ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$optionOne.'%"%');
                })->paginate(10);               
                return view('userprofile.kepsek.notification', compact('notification'));
            } elseif($orderChoice == "Terbaru"){
                $notification = $user->notifications()
                ->Where('data' , 'LIKE' , '%"status_kegiatan":"'.$optionOne.'"%')
                ->orWhere('data','LIKE','%"user_pj":"'.$optionOne.'"%')
                ->orWhere('data','LIKE','%"nama_proposal_kegiatan":"'.$optionOne.'"%')
                ->orWhere('data' , 'LIKE' , '%"nilai_ppk":"%'.$optionOne.'%"%')
                ->orWhere('data' , 'LIKE' , '%"kegiatan_berbasis":"%'.$optionOne.'%"%')
                ->paginate(10);
                return view('userprofile.kepsek.notification', compact('notification'));
            }
            
        }

    }

    public function readNotification(Request $request){
        $notification = Auth::user()->notifications->where('id' , $request->data)->first();
        if ($notification === null) {
            return response()->json(['errors' => ['Notification Not Found']], 404);
        } 
        $notification->markAsRead();
        return response()->json(['data' => 'Notification Successfully read'], 200);
    }

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
        $id = Auth::user()->id;
        try {
            $user = User::findOrFail($id);
        } catch (\Throwable $th) {
            return Response::json(['messages' => $th->getMessage()], 404);
        } catch(ModelNotFoundException $e) {
            return Response::json(['messages' => ["Data Anda Tidak Dapat Ditemukkan, Silahkan Kontak Admin! ID yang diberikan: ".$id."System Error Code: ".$e->getMessage()]], 404);
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

}
