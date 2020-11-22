<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanDokumentasiBaruRequest extends FormRequest
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
            "nama_kegiatan" => 'required|unique:pengajuan_kegiatans,PJ_nama_kegiatan|unique:dokumentasi_kegiatans,nama_kegiatan',
            "nilai_ppk" => 'required',
            "kegiatan_berbasis" => 'required',
            "dokumentasi_kegiatan_ppk.*" => 'required|mimes:pdf,doc,docx|max:5120',
            'image_kegiatan_ppk.*' => 'required|mimes:jpeg,png|max:5120',
            "mulai_kegiatan" => 'required',
            "akhir_kegiatan" => 'required'
        ];
    }
    public function messages()
    {
        return [
            "nama_kegiatan.required" => 'Nama Kegiatan Harus Dimasukkan',
            "nama_kegiatan.unique" => 'Nama Kegiatan Sudah Diambil, Silahkan Isi Nama Kegiatan Yang Lain',
            "nilai_ppk.required" => 'Nilai PPK Wajib Dipilih!',
            "kegiatan_berbasis.required" => 'Kegiatan Berbasis Wajib Dipilih',
            'dokumentasi_kegiatan_ppk.*.required' => 'Dokumen Kegiatan Wajib Diunggah dengan ekstensi .pdf, .doc, atau .docx',
            'dokumentasi_kegiatan_ppk.*.mimes' => 'Dokumen Kegiatan yang diunggah harus berekstensi .pdf, .doc, atau .docx',
            'dokumentasi_kegiatan_ppk.*.max' => 'Dokumen Kegiatan harap tidak melebihi dari 5MB',
            'image_kegiatan_ppk.*.mimes' => 'Sistem dapat menerima dokumen dengan ekstensi .jpeg atau .png',
            'image_kegiatan_ppk.*.required' => 'Dokumen Kegiatan Harap Diunggah dengan ekstensi .jpeg atau .png',
            'image_kegiatan_ppk.*.max' => 'Foto Kegiatan harap tidak melebihi dari 5MB',
            'mulai_kegiatan.required' => 'Awal Kegiatan Wajib Diisi',
            'akhir_kegiatan.required' => 'Akhir Kegiatan Wajib Diisi'
        ];
    }
}
