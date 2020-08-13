<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class uploadEditedDokumenDokumentasiValidationRequest extends FormRequest
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
            "edited_dokumen" => "required|mimes:pdf|max:5120"
        ];
    }

    public function messages()
    {
        return [
            "edited_dokumen.required" => 'Dokumen Pengganti Wajib Diunggah!',
            "edited_dokumen.mimes" => 'Sistem dapat menerima file dengan ekstensi .pdf',
            "edited_dokumen.max" => 'Sistem Dapat Menampung File sebesar 5MB'
        ];
    }
}
