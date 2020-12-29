<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TempPasswordValidationRequest extends FormRequest
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
            'username_id_user' => 'required|exists:users,username_id'
        ];
    }

    public function messages()
    {
        return [
            'username_id_user.required' => 'Masukkan Username Anda!',
            'username_id_user.exists' => 'Username Tidak Terdaftar Dalam Sistem, Silahkan Masukkan Username Kembali'
        ];
    }
}
