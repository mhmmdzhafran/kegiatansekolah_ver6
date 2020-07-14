<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentEksternalValidationRequest extends FormRequest
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
            'nama_sekolah' => 'required',
            'alamat_sekolah' => 'required',
            'nama_kepsek' => 'required',
            'no_hp' => 'required|numeric',
            'email_kepsek' => 'required|email',
            'indikator' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_sekolah.required' => 'Nama Sekolah Harus Terisi',
            'alamat_sekolah.required' => 'Alamat Sekolah Harus Terisi',
            'nama_kepsek.required' => 'Nama Kepala Sekolah Harus Terisi',
            'no_hp.required' => 'Nomor HP dari Kepala Sekolah Harus Terisi',
            'no_hp.numeric' => 'Nomor HP tidak berisi angka numerik',
            'email_kepsek.required' => 'Email Kepala Sekolah Harus Terisi',
            'email_kepsek.email' => 'Pengisian Email tidak valid',
            'indikator.required' => 'Skor Indikator Harus Terisi'
        ];
    }
}
