<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidationRequest;
use App\Http\Requests\UserUpdateValidationRequest;
use App\Mail\CreatedUserAccountMail;
use App\Mail\DeletedUserAccountMail;
use App\Mail\UpdatedUserAccountMail;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class AdminUserController extends Controller
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
        $user = User::with('Role')->get();
        $roles = Role::pluck('role_title', 'id')->all();
        if (request()->ajax()) {
            return datatables()->of($user)->addColumn('Aksi', function($data){
                if (Auth::user()->username_id == $data->username_id) {
                    $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-warning rounded-pill btn-sm">Edit</button>';
                    $aksi.= '&nbsp;&nbsp;';
                    $aksi.= '<button type="button" data-toggle="modal" id="'.$data->id.'" 
                    data-target="#DeleteModal" class="btn btn-sm btn-danger rounded-pill delete" disabled>Delete</button>';    
                } else {
                    $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-warning rounded-pill btn-sm">Edit</button>';
                    $aksi.= '&nbsp;&nbsp;';
                    $aksi.= '<button type="button" data-toggle="modal" id="'.$data->id.'" 
                    data-target="#DeleteModal" class="btn btn-sm btn-danger rounded-pill delete">Delete</button>';    
                }
                return $aksi;
            })
            ->editColumn('created_at', function($data){
                return $data->created_at->timezone('Asia/Jakarta')->toDateTimeString();
            })
            ->editColumn('updated_at', function($data){
                return $data->updated_at->timezone('Asia/Jakarta')->toDateTimeString();
            })
            ->rawColumns(['Aksi'])->make(true);
        }
        return view('admin.user.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $roles = Role::pluck('role_title', 'id')->all();
        // return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserValidationRequest $request)
    {
        //
        $input = $request->only([
            'name', 
            'username_id',
            'email_user',
            'photo_user',
            'role_id',
            'password',
            'passwordChecker'
        ]);
        if ($request->password != $request->passwordChecker) {
            return Response::json(['data' => 'data is not valid', 'errors' => ['Password yang diberikan tidak cocok, Silahkan masukkan password kembali']], 422);
        }
        $fileImage = $request->file('photo_user');
        $customNameFile = $this->photoUserChecker($fileImage->getClientOriginalName(), $request->username_id);
        // if (gettype($customNameFile) == 'array') {
        //     return $customNameFile;
        // }
        $input['photo_user'] = $customNameFile;
        $input['password'] = bcrypt($request->password);
        $moveImage = $fileImage->move('kegiatan/admin/foto_user/',$customNameFile);
        if (!$moveImage) {
            return response()->json(['errors' => ['Sistem Tidak Dapat Menyimpan Foto User, Silahkan Coba Kembali']], 422);
        }
        $user = User::create($input);
        if (!$user) {
            return Response::json(['message' => 'saving data is error', 'errors' => ['Terjadi Kendala saat melakukan Penyimpanan, Silahkan coba kembali']],422);
        }
        $getUser = $this->getUserData($request->name, $request->username_id, $request->email_user, $request->role_id);
        if (gettype($getUser) == 'array') {
            return $getUser;
        }
        $url = url('/login');
        Mail::to($request->email_user)->send(new CreatedUserAccountMail($getUser, $request->passwordChecker, $url));
        return Response::json(['data' => 'data is valid' , 'store_message' => 'Akun Pengguna Berhasil Dibentuk'], 200);
           
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
        if (request()->ajax()) {
            // try{
            //     $user = User::findOrFail($id);
            // } catch(ModelNotFoundException $e){
            //     return response()->json(['messages' => 'Data User tidak dapat ditemukkan, silahkan cek database untuk mengetahui lebih lanjut! ID yang diberikan:'.$id." System Error Code: ".$e->getMessage()], 404);
            // } catch(\Throwable $th){
            //     return response()->json(['messages' => $th->getMessage()], 404);
            // }
            $user = $this->checkUser($id);
            if (gettype($user) == 'array') {
                return $user;
            }
            return Response::json(['data' => $user, 'data_foto' => $user->photo_user], 200);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateValidationRequest $request, $id)
    {
        //
        // try{
        //     $user = User::findOrFail($id);
        // } catch(ModelNotFoundException $e){
        //     return Response::json(['messages' => 'Data User PPK tidak dapat ditemukan, Silahkan Coba Kembali dan cek Database untuk melihat User ini! id yang diberikan dalam user db: '.$id.'System Error Code: '.$e->getMessage()], 404); 
        // } catch(\Throwable $th){
        //     return Response::json(['messages' =>  $th->getMessage()], 404); 
        // }
        $user = $this->checkUser($id);
        if (gettype($user) == 'array') {
            return $user;
        }
        if ($request->password != $request->passwordChecker) {
            return Response::json(['data' => 'data is not valid', 'errors' => ['Password yang diberikan tidak cocok, Silahkan masukkan password kembali']], 422);
        }
        $input = $request->only([
            'name', 
            'username_id',
            'email_user',
            'photo_user',
            'role_id',
            'password',
            'passwordChecker'
        ]);
        $fileImage = $request->file('photo_user');
        if (empty($fileImage)) {
            if (is_null($user->photo_user)) {
                return response()->json(['errors' => ['Silahkan Unggah Foto Pengguna!']], 422);
            } else {
                $customNameFile = $user->photo_user;       
            }
        } else {
            $customNameFile = $this->photoUserChecker($fileImage->getClientOriginalName(), $request->username_id);
            // if (gettype($customNameFile) == 'array') {
            //     return $customNameFile;
            // }
            if (!is_null($user->photo_user)) {
                if (file_exists(public_path('kegiatan/admin/foto_user/'.$user->photo_user))) {
                    unlink(public_path('kegiatan/admin/foto_user/'.$user->photo_user));
                }  
            }
            $moveImage = $fileImage->move('kegiatan/admin/foto_user/',$customNameFile);
            if (!$moveImage) {
                return response()->json(['errors' => ['Sistem Tidak Dapat Menyimpan Foto User, Silahkan Coba Kembali']], 422);
            }
        }
        $input['password'] = bcrypt($request->password);
        $input['photo_user'] = $customNameFile;
        $update_user = $user->update($input);
        if (!$update_user) {
            return Response::json(['message' => 'data is invalid', 'errors' => ['Tidak dapat melakukan pembaruan, Silahkan coba kembali']], 422);
        }
        $getUser = $this->getUserData($request->name, $request->username_id, $request->email_user, $request->role_id);
        if (gettype($getUser) == 'array') {
            return $getUser;
        }
        $url = url('/login');
        Mail::to($request->email_user)->send(new UpdatedUserAccountMail($getUser, $request->passwordChecker, $url));
        return Response::json(['message' => 'data is valid' , 'store_message' => 'Pengguna Berhasil Diperbarui'], 200);
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
        // try{
        //     $user = User::findOrFail($id);
        // } catch(ModelNotFoundException $e){
        //     return Response::json(['messages' => 'Data User PPK tidak dapat ditemukan, Silahkan Coba Kembali dan cek Database untuk melihat User ini! id yang diberikan dalam user db: '.$id.'System Error Code: '.$e->getMessage()], 404);
        // } catch(\Throwable $th){
        //     return Response::json(['messages' => $th->getMessage()], 404);
        // }
        $user = $this->checkUser($id);
        if (gettype($user) == 'array') {
            return $user;
        }
        $user_photo = $user->photo_user;
        if (!is_null($user_photo)) {
            if (file_exists(public_path('kegiatan/admin/foto_user/'.$user_photo))) {
                unlink(public_path('kegiatan/admin/foto_user/'.$user_photo));
            }
            // if (!$deleteImage) {
            //     return response()->json(['errors' => ['Tidak Dapat Menghapus Foto User, Silahkan Coba Kembali']], 422);
            // }
        }
        
        Mail::to($user->email_user)->send(new DeletedUserAccountMail($user->username_id, $user->Role->role_title, $user->name));
        $delete = $user->delete();
        if (!$delete) {
            return Response::json(['message' => 'data is not deleted', 'notification' => "Penghapusan User Tidak Berhasil, Silahkan Coba Kembali"], 422);
        }
        return Response::json(['message' => 'data is deleted', 'notification' => "Berhasil Menghapus Data Pengguna!"], 200);
    }

    private function getUserData($name, $username_id, $email_user, $role_id){
        $getUser = User::where([
            'name' => $name, 
            'username_id' => $username_id,
            'email_user' => $email_user,
            'role_id' => $role_id
        ])->first();
        if (empty($getUser)) {
            return response()->json(['message' => 'cannot get user' , 'errors' => ['User Tidak Dapat Ditemukan, Silahkan Coba Kembali']], 422);
        } else {
            return $getUser;
        }
    }

    private function photoUserChecker($photo, $username){
        // $customNameFile = Carbon::now()->toDateString()."USER-ACC-".$username."-".$photo;
        // if(file_exists(public_path('kegiatan/admin/foto_user/'.$customNameFile))){
            //     return response()->json(['errors' => ['File dengan nama yang sama telah diunggah, Silahkan Mengganti Penamaan File / Mengganti Foto User Yang Lain']], 422);
            // }
        $customNameFile = "USER-ACC-".$username."-".$photo;
        return $customNameFile;
    }

    private function checkUser($userID){
        try{
            $user = User::findOrFail($userID);
        } catch(ModelNotFoundException $e){
            return Response::json(['messages' => 'Data User PPK tidak dapat ditemukan, Silahkan Coba Kembali dan cek Database untuk melihat User ini! id yang diberikan dalam user db: '.$userID.'System Error Code: '.$e->getMessage()], 404);
        } catch(\Throwable $th){
            return Response::json(['messages' => $th->getMessage()], 404);
        }
        return $user;
    }
}