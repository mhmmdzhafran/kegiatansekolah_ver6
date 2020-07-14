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
            "username_id" => 'required|max:255',
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
            'username_id.max' => 'Username melebihi 255 karakter',
            'role_id.required' => 'Peran User Wajib Dipilih',
            'password.required' => 'Password User Wajib Diisi',
            'passwordChecker.required' => 'Password User Wajib Diisi Kembali'
        ];
    }
}
