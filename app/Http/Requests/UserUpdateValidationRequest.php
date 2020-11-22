<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateValidationRequest extends FormRequest
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
            "name" => 'required',
            "username_id" => 'required|max:225',
            "email_user" => 'required|max:225',
            'photo_user' => 'mimes:jpeg,png|max:5120',
            "role_id" => 'required',
            'password' => 'required',
            'passwordChecker' => 'required'
        ];
    }

    public function messages()
    {
        return [
            "name.required" => 'Nama User Wajib Diisi',
            'username_id.required' => 'Username Wajib Diisi',
            'username_id.max' => 'Username melebihi 225 karakter',
            'email_user.required' => 'Username Wajib Diisi',
            'email_user.max' => 'Username melebihi 225 karakter',
            // 'photo_user.required' => 'Silahkan Unggah Foto Pengguna!',
            'photo_user.mimes' => 'Silahkan Unggah Foto Pengguna Dengan Ekstensi .jpeg atau .png',
            'photo_user.max' => 'Sistem Hanya Menerima Ukuran Foto Sebesar 5MB',
            'role_id.required' => 'Peran User Wajib Dipilih',
            'password.required' => 'Password User Wajib Diisi',
            'passwordChecker.required' => 'Password User Wajib Diisi Kembali'
        ];
    }
}
