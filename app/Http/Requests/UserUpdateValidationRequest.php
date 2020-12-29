<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            "username_id" => ['required' , 'max:255', Rule::unique('users' , 'username_id')->ignore($this->user)],
            "email_user" => ['required' , 'max:255', Rule::unique('users' , 'email_user')->ignore($this->user)],
            'photo_user' => 'mimes:jpeg,png|max:5120',
            "role_id" => 'required',
            'password' => 'required',
            'passwordChecker' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            "name.required" => 'Nama User Wajib Diisi',
            'username_id.required' => 'Username Wajib Diisi',
            'username_id.max' => 'Username melebihi 255 karakter',
            'username_id.unique' => 'Username Telah Diambil',
            'email_user.required' => 'Email Wajib Diisi',
            'email_user.max' => 'Email melebihi 255 karakter',
            'email_user.unique' => 'Email User Telah diambil',
            // 'photo_user.required' => 'Silahkan Unggah Foto Pengguna!',
            'photo_user.mimes' => 'Silahkan Unggah Foto Pengguna Dengan Ekstensi .jpeg atau .png',
            'photo_user.max' => 'Sistem Hanya Menerima Ukuran Foto Sebesar 5MB',
            'role_id.required' => 'Peran User Wajib Dipilih',
            'password.required' => 'Password User Wajib Diisi',
            'passwordChecker.required' => 'Password User Wajib Diisi Kembali',
            'passwordChecker.same' => 'Password Tidak Cocok, Silahkan masukkan kembali',
        ];
    }
}
