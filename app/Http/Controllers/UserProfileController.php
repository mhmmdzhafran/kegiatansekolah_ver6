<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckerPassValidationRequest;
use App\Http\Requests\UpdatePassValidationRequest;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        switch ($role) {
            case 'Penanggung Jawab Kegiatan':
                return view('userprofile.pj.index', compact('data_user' , 'role'));
                break;
            case 'Kepala Sekolah':
                return view('userprofile.kepsek.index', compact('data_user' , 'role'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
