<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDokumenAsesmenRequest extends FormRequest
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
            'ubah_dokumen' => 'required|mimes:pdf|max:5120'
        ];
    }

    public function messages()
    {
        return[
            'ubah_dokumen.required' => 'Harap Unggah Dokumen Pengganti dengan Ekstensi .pdf',
            'ubah_dokumen.mimes' => 'Sistem dapat menerima Dokumen dengan Ekstensi .pdf',
            'ubah_dokumen.max' => 'Sistem dapat menerima file sebesar 5MB',
            'ubah_dokumen.uploaded' => 'Sistem gagal melakukan upload, pastikan ukuran file tidak melebihi 5MB / cek internet Anda'
        ];
    }
}
