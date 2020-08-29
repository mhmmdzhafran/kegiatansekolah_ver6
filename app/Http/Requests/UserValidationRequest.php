<?php

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
            'username_id' => 'required|unique:users|max:255',
            'password' => 'required',
            'passwordChecker' => 'required'
        ];
    }
    public function messages(){
        return[
            'name.required' => 'Masukkan nama user',
            'useraname_id.unique' => 'Username telah diambil, silahkan coba kembali',
            'username_id.required' => 'Masukkan username user',
            'username_id.max' => 'Username melebihi 255 karakter',
            'username_id.unique' => 'Username ID Telah Diambil, Silahkan Pilih Username Baru',
            'role_id.required' => 'Pilih Peran User!',
            'password.required' => 'Masukkan password user',
            'passwordChecker.required' => 'Masukkan password kedua kalinya',
        ];
    }
}
