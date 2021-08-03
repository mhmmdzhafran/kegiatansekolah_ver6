<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformasiAssessmenInternalRequest extends FormRequest
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
            'no_hp' => 'required|numeric|digits:12',
            'email_kepsek' => 'required|email'
        ];
    }

    public function messages()
    {
        return[
            'nama_sekolah.required' => 'Nama Sekolah Wajib Diisi',
            'alamat_sekolah.required' => 'Alamat Sekolah Wajib Diisi',
            'nama_kepsek.required' => 'Nama Kepala Sekolah Wajib Diisi',
            'no_hp.required' => 'Nomor HP Kepala Sekolah Wajib Diisi',
            'no_hp.numeric' => 'Nomor HP Wajib berbentuk Numerik',
            'no_hp.digits' => 'Nomor HP Harus Terdiri dari 12 Angka Numerik',
            'email_kepsek.required' => 'Email Wajib Diisi',
            'email_kepsek.email' => 'Email Tidak Valid'
        ];
    }
}
