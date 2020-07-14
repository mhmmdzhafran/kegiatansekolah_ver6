<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadDokumentasiPJRequest extends FormRequest
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
            "ganti_dokumen" => 'mimes:pdf,png,jpeg,docx,xlsx',
        ];
    }

    public function messages()
    {
        return[
            "ganti_dokumen.mimes" => 'Sistem dapat menerima dokumen dengan ekstensi .pdf, .docx, .xlsx, .png, dan .jpeg',
        ];
    }
}
