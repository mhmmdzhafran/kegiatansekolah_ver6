<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanDokumentasiKegiatanRequest extends FormRequest
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
            // 'akhir_kegiatan' => 'required',
            'dokumentasi_kegiatan_ppk.*' => 'required|mimes:pdf,doc,docx|max:5120',
            'image_kegiatan_ppk.*' => 'required|mimes:jpeg,png|max:5120',
            // 'dokumentasi_kegiatan_ppk' => 'required|mimes:pdf,doc,docx|max:5120',
            // 'image_kegiatan_ppk' => 'required|mimes:jpeg,png|max:5120',
        ];
    }

    public function messages()
    {
        return[
            // 'akhir_kegiatan.required' => 'Tanggal Akhir Kegiatan Wajib Dimasukkan!',
            'dokumentasi_kegiatan_ppk.*.required' => 'Laporan Kegiatan Harap Diunggah dengan ekstensi .pdf atau .doc atau .docx',
            'dokumentasi_kegiatan_ppk.*.mimes' => 'Sistem dapat menerima dokumen dengan ekstensi .pdf atau .doc atau .docx',
            'dokumentasi_kegiatan_ppk.*.max' => 'Laporan Kegiatan harap tidak melebihi dari 5MB',
            'image_kegiatan_ppk.*.required' => 'Dokumen Kegiatan Harap Diunggah dengan ekstensi .jpeg atau .png',
            'image_kegiatan_ppk.*.mimes' => 'Sistem dapat menerima dokumen dengan ekstensi .jpeg atau .png',
            'image_kegiatan_ppk.*.max' => 'Foto Kegiatan harap tidak melebihi dari 5MB',
            // 'dokumentasi_kegiatan_ppk.required' => 'Laporan Kegiatan Harap Diunggah dengan ekstensi .pdf atau .doc atau .docx',
            // 'dokumentasi_kegiatan_ppk.mimes' => 'Sistem dapat menerima dokumen dengan ekstensi .pdf atau .doc atau .docx',
            // 'dokumentasi_kegiatan_ppk.max' => 'Laporan Kegiatan harap tidak melebihi dari 5MB',
            // 'image_kegiatan_ppk.required' => 'Dokumentasi Kegiatan Harap Diunggah dengan ekstensi .jpeg atau .png',
            // 'image_kegiatan_ppk.mimes' => 'Sistem dapat menerima dokumen dengan ekstensi .jpeg atau .png',
            // 'image_kegiatan_ppk.max' => 'Foto Kegiatan harap tidak melebihi dari 5MB',
        ];
    }
}
