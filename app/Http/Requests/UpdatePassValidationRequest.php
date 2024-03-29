<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassValidationRequest extends FormRequest
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
            'passwordBaru' => 'required',
            'passwordChecker' => 'required|same:passwordBaru'
        ];
    }

    public function messages()
    {
        return [
            'passwordBaru.required' => 'Masukkan Password Baru Anda!',
            'passwordChecker.required' => 'Masukkan Password Baru Anda Kembali!',
            'passwordChecker.same' => 'Password Tidak Sama, Silahkan Masukkan Password Kembali',
        ];
    }
}
