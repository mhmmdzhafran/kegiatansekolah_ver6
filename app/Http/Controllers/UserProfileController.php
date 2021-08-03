<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Http\Controllers;

use App\Http\Requests\CheckerPassValidationRequest;
use App\Http\Requests\UpdatePassValidationRequest;
use App\Repository\FindDataRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserProfileController extends Controller
{

    protected $findData;
    public function __construct(FindDataRepository $findDataRepository)
    {
        $this->middleware('auth');
        $this->findData = $findDataRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $role = Auth::user()->Role->role_title;
        $counter_notification = Auth::user()->unreadNotifications->count();
        switch ($role) {
            case 'Penanggung Jawab Kegiatan':
                return view('userprofile.pj.index', compact('role', 'counter_notification'));
                break;
            case 'Kepala Sekolah':
                return view('userprofile.kepsek.index', compact('role' , 'counter_notification'));
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
        $user =  $this->findData->findDataModel(Auth::user()->id, 'User');
        if (gettype($user) == 'string') {
            return Response::json(['messages' => 'Data User Anda tidak dapat ditemukan, Silahkan Coba Kembali dan cek Database untuk melihat User ini! id yang diberikan dalam user db: '.Auth::user()->id.'System Error Code: '.$user], 404);
        }
        $input['password'] = bcrypt($request->passwordChecker);
        $updatePass = $user->update($input);
        if (!$updatePass) {
            return Response::json(['errors' => ['Terdapat Kendala Saat Melakukan Pengubahan Password, Silahkan Coba Kembali!']], 422);
        }
        return Response::json(['message' => 'data is valid'], 200);
    }

   
}
