<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class uploadDokumenDokumentasiBaruValidationRequest extends FormRequest
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
            "dokumen_dokumentasi_baru.*" => 'required|mimes:pdf|max:5120'
        ];
    }

    public function messages()
    {
        return [
            "dokumen_dokumentasi_baru.*.required" => 'Dokumen Dokumentasi Kegiatan harap diunggah',
            "dokumen_dokumentasi_baru.*.mimes" => 'Sistem dapat menerima file dengan ekstensi .pdf',
            "dokumen_dokumentasi_baru.*.max" => 'Sistem dapat menerima file sebesar 5MB'
        ];
    }
}
