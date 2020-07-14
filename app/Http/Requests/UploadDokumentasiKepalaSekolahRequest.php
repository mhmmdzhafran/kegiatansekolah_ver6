<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadDokumentasiKepalaSekolahRequest extends FormRequest
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
            'dokumen_kegiatan' => 'mimes:pdf,jpeg,docx,png,xlsx'
        ];
    }

    public function messages()
    {
        return[
            //
            'dokumen_kegiatan.mimes' => 'Sistem menerima dokumen dengan ekstensi .pdf, .jpeg, .docx, .png, dan .xlsx'
        ];
    }
}
