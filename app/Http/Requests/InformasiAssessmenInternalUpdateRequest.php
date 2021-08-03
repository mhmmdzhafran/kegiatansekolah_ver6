<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformasiAssessmenInternalUpdateRequest extends FormRequest
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
            'indikator' => 'required',
            'file.*' => 'required|mimes:pdf|max:5120',
        ];
    }

    public function messages()
    {
        return[
            'indikator.required' => 'Skor Penilaian Wajib diisi! Silahkan Pilih Salah Satu Skor',
            'file.*.mimes' => 'Sistem hanya menerima dokumen dengan ekstensi .pdf',
            'file.*.max' => 'Dokumen Asesmen harap tidak melebihi 5MB',
            'file.*.required' => 'Dokumen Asesmen Harap Diunggah'
        ];
    }
}
