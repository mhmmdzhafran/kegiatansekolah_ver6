<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TempPasswordValidationRequest;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Request;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function changeUserPassword(TempPasswordValidationRequest $request){
        $user = User::where('username_id' , $request->username_id_user)->first();
        if (is_null($user)) {
            return Response::json(['errors' => ['Tidak Menemukan User Dengan Nama: '.$request->username_id_user." Silahkan Masukkan Username Kembali"]], 422);
        }
        $passGenerate = $this->createTempPassword();
        $input['password'] = bcrypt($passGenerate);
        $update = $user->update($input);
        if (!$update) {
            return Response::json(['errors' => ['Tidak Dapat Menyimpan Password Sementara Anda, Silahkan Coba Kembali']], 422);
        }
        return Response::json(['message' => 'success ubah', 'tempPass' => $passGenerate], 200);
    }

    protected function createTempPassword(){
        $data = Str::random(9);
        return $data;
    }
}
