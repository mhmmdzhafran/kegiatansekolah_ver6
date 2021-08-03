<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required',
            'role_id' => 'required',
            'username_id' => 'required|unique:users,username_id|max:255',
            'email_user' => 'required|unique:users,email_user|max:255',
            'photo_user' => 'required|mimes:jpeg,png|max:5120',
            'password' => 'required',
            'passwordChecker' => 'required|same:password'
        ];
    }
    public function messages(){
        return[
            'name.required' => 'Masukkan nama user',
            'username_id.unique' => 'Username telah diambil, silahkan coba kembali',
            'username_id.required' => 'Masukkan username user',
            'username_id.max' => 'Username melebihi 255 karakter',
            'email_user.unique' => 'Email telah diambil oleh User lain, silahkan coba kembali',
            'email_user.required' => 'Masukkan Email user',
            'email_user.max' => 'Email User melebihi 255 karakter',
            'photo_user.required' => 'Silahkan Unggah Foto Pengguna!',
            'photo_user.mimes' => 'Silahkan Unggah Foto Pengguna Dengan Ekstensi .jpeg atau .png',
            'photo_user.max' => 'Sistem Hanya Menerima Ukuran Foto Sebesar 5MB',
            'role_id.required' => 'Pilih Peran User!',
            'password.required' => 'Masukkan password user',
            'passwordChecker.required' => 'Masukkan password kedua kalinya',
            'passwordChecker.same' => 'Password tidak cocok, Silahkan masukkan kembali',
        ];
    }
}
