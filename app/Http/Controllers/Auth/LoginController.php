<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    
    public function redirectTo(){
        $roles = Auth::user()->Role->role_title;

        switch ($roles) {
            case 'Admin':
                return '/admin/users';
                break;
            case 'Kepala Sekolah':
                return '/kepala-sekolah/mengelola-kegiatan';
                break;
            case 'Penanggung Jawab Kegiatan':
                return '/penanggung-jawab/mengelola-kegiatan';
                break;
            default:
                return '/';
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return "username_id";
    }
}
