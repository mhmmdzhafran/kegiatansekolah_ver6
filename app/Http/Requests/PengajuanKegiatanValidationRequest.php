<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanKegiatanValidationRequest extends FormRequest
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
            'PJ_nama_kegiatan' => 'required|unique:pengajuan_kegiatans,PJ_nama_kegiatan|unique:dokumentasi_kegiatans,nama_kegiatan',
            'nilai_ppk' => 'required',
            'kegiatan_berbasis' => 'required',
            'mulai_kegiatan' => 'required',
            'akhir_kegiatan' => 'required',
            'dokumen_kegiatan' => 'required|max:5120|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'PJ_nama_kegiatan.required' => 'Nama Kegiatan Wajib Dimasukkan!',
            'PJ_nama_kegiatan.unique' => 'Nama Kegiatan Telah Diambil, Silahkan Pilih Nama Kegiatan Baru',
            'nilai_ppk.required' => 'Nilai PPK Wajib dipilih!',
            'kegiatan_berbasis.required' => 'Tempat Kegiatan Untuk Melakukan PPK Wajib Dipilih!',
            'mulai_kegiatan.required' => 'Tanggal Mulai Kegiatan Wajib Dimasukkan!',
            'akhir_kegiatan.required' => 'Tanggal Akhir Kegiatan Wajib Dimasukkan!',
            'dokumen_kegiatan.required' => 'Silahkan Unggah Dokumen Proposal Kegiatan!',
            'dokumen_kegiatan.mimes' => 'Sistem dapat menerima dokumen dengan ekstensi .pdf',
            'dokumen_kegiatan.max' => 'Sistem dapat menerima file hanya 5MB',
            'dokumen_kegiatan.uploaded' => 'Sistem gagal melakukan upload, pastikan ukuran file tidak melebihi 5MB / cek internet Anda'
        ];
    }
}
