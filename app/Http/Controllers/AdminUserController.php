<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Http\Controllers;

use App\Http\Requests\UserValidationRequest;
use App\Http\Requests\UserUpdateValidationRequest;
use App\Mail\CreatedUserAccountMail;
use App\Mail\DeletedUserAccountMail;
use App\Mail\UpdatedUserAccountMail;
use App\Repository\FindDataRepository;
use App\Role;
use App\Services\FileUploadService;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class AdminUserController extends Controller
{
    protected $findData;
    protected $fileService;
    public function __construct(FindDataRepository $findDataRepository, FileUploadService $fileUploadService)
    {
        $this->middleware('auth');
        $this->findData = $findDataRepository;
        $this->fileService = $fileUploadService;
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
                    $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-warning rounded-pill btn-sm mb-2">Edit</button>';
                    $aksi.= '<button type="button" data-toggle="modal" id="'.$data->id.'" 
                    data-target="#DeleteModal" class="btn btn-sm btn-danger rounded-pill delete mb-2" disabled>Delete</button>';    
                } else {
                    $aksi = '<button type="button" name="Edit" id="'.$data->id.'" class="edit btn btn-warning rounded-pill btn-sm mb-2">Edit</button>';
                    $aksi.= '<button type="button" data-toggle="modal" id="'.$data->id.'" 
                    data-target="#DeleteModal" class="btn btn-sm btn-danger rounded-pill delete" mb-2>Delete</button>';    
                }
                return $aksi;
            })
            ->rawColumns(['Aksi'])->make(true);
        }
        return view('admin.user.index', compact('roles'));
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
            'password'
        ]);
        $fileImage = $request->file('photo_user');
        $customNameFile = "USER-ACC-".$request->username_id."-".$fileImage->getClientOriginalName();
        $moveImage = $this->fileService->storeSingleFile($fileImage, $customNameFile, 'upload_img_user');
        if (gettype($moveImage) == 'boolean' && !$moveImage) {
            return response()->json(['errors' => ['Sistem Tidak Dapat Menyimpan Foto User, Silahkan Coba Kembali']], 422);
        }
        $input['photo_user'] = $customNameFile;
        $input['password'] = bcrypt($request->password);
        $user = User::create($input);
        if (!$user) {
            $this->fileService->removeSingleFile($input['photo_user'], 'delete_user_img');
            return Response::json(['message' => 'saving data is error', 'errors' => ['Terjadi Kendala saat melakukan Penyimpanan, Silahkan coba kembali']],422);
        }
        $getUser = User::where([
            'name' => $request->name, 
            'username_id' => $request->username_id,
            'email_user' => $request->email_user,
            'role_id' => $request->role_id
        ])->first();
        if (empty($getUser)) {
            return response()->json(['message' => 'cannot get user' , 'errors' => ['User Tidak Dapat Ditemukan, Silahkan Coba Kembali']], 422);
        } 
       
        $url = url('/login');
        Mail::to($request->email_user)->send(new CreatedUserAccountMail($getUser, $request->passwordChecker, $url));
        return Response::json(['data' => 'data is valid' , 'store_message' => 'Akun Pengguna Berhasil Dibentuk'], 200);
           
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
            $user =  $this->findData->findDataModel($id, 'User');
            if (gettype($user) == 'string') {
                return Response::json(['messages' => 'Data User PPK tidak dapat ditemukan, Silahkan Coba Kembali dan cek Database untuk melihat User ini! id yang diberikan dalam user db: '.$id.'System Error Code: '.$user], 404);
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
        $user =  $this->findData->findDataModel($id, 'User');
        if (gettype($user) == 'string') {
            return Response::json(['messages' => 'Data User PPK tidak dapat ditemukan, Silahkan Coba Kembali dan cek Database untuk melihat User ini! id yang diberikan dalam user db: '.$id.'System Error Code: '.$user], 404);
        }
        $customNameFile = '';
        $input = $request->only([
            'name', 
            'username_id',
            'email_user',
            'photo_user',
            'role_id',
            'password'
        ]);
        $fileImage = $request->file('photo_user');
        
        if (empty($fileImage)) {
            if (is_null($user->photo_user)) {
                return response()->json(['errors' => ['Silahkan Unggah Foto Pengguna!']], 422);
            } else {
                $customNameFile = $user->photo_user;       
            }
        } else {
            $customNameFile = "USER-ACC-".$request->username_id."-".$fileImage->getClientOriginalName();
            if (!is_null($user->photo_user)) {
                $this->fileService->removeSingleFile($user->photo_user, 'delete_user_img');
            }
            $moveImage = $this->fileService->storeSingleFile($fileImage, $customNameFile, 'upload_img_user');
            if (gettype($moveImage) == 'boolean' && !$moveImage) {
                return response()->json(['errors' => ['Sistem Tidak Dapat Menyimpan Foto User, Silahkan Coba Kembali']], 422);
            }
        }
        
        $input['password'] = bcrypt($request->password);
        $input['photo_user'] = $customNameFile;
        $update_user = $user->update($input);
        if (!$update_user) {
            return Response::json(['message' => 'data is invalid', 'errors' => ['Tidak dapat melakukan pembaruan, Silahkan coba kembali']], 422);
        }
        
        $url = url('/login');
        Mail::to($request->email_user)->send(new UpdatedUserAccountMail($user, $request->passwordChecker, $url));
        if ($user->id == Auth::user()->id && $user->Role->role_title == 'Admin') {
            return Response::json(['message' => 'data is valid' , 'store_message' => 'Pengguna Berhasil Diperbarui', 'state_refresh' => true, 'new_name' => $user->name, 'state' => false], 200);
        } elseif($user->id == Auth::user()->id && $user->Role->role_title != 'Admin'){
            return Response::json(['message' => 'data is valid' , 'store_message' => 'Pengguna Berhasil Diperbarui', 'state_refresh' => true, 'state' => true], 200);    
        }
        return Response::json(['message' => 'data is valid' , 'store_message' => 'Pengguna Berhasil Diperbarui', 'state_refresh' => false, 'state' => false], 200);
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
        $user =  $this->findData->findDataModel($id, 'User');
        if (gettype($user) == 'string') {
            return Response::json(['messages' => 'Data User PPK tidak dapat ditemukan, Silahkan Coba Kembali dan cek Database untuk melihat User ini! id yang diberikan dalam user db: '.$id.'System Error Code: '.$user], 404);
        }
        $user_photo = $user->photo_user;
        if (!is_null($user_photo)) {
            $this->fileService->removeSingleFile($user_photo, 'delete_user_img');
        }
        
        Mail::to($user->email_user)->send(new DeletedUserAccountMail($user->username_id, $user->Role->role_title, $user->name));
        $delete = $user->delete();
        if (!$delete) {
            return Response::json(['message' => 'data is not deleted', 'notification' => "Penghapusan User Tidak Berhasil, Silahkan Coba Kembali"], 422);
        }
        return Response::json(['message' => 'data is deleted', 'notification' => "Berhasil Menghapus Data Pengguna!"], 200);
    }
}