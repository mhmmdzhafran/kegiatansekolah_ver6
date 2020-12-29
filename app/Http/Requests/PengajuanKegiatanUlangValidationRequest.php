<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PengajuanKegiatanUlangValidationRequest extends FormRequest
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
            'PJ_nama_kegiatan' => ['required', 'unique:dokumentasi_kegiatans,nama_kegiatan', Rule::unique('pengajuan_kegiatans' , 'PJ_nama_kegiatan')->ignore($this->mengelola_kegiatan)],
            'nilai_ppk' => 'required',
            'kegiatan_berbasis' => 'required',
            'mulai_kegiatan' => 'required|date|before_or_equal:akhir_kegiatan',
            'akhir_kegiatan' => 'required|date|after_or_equal:mulai_kegiatan',
            'dokumen_kegiatan' => 'required|max:5120|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'PJ_nama_kegiatan.required' => 'Nama Kegiatan Wajib Dimasukkan!',
            'PJ_nama_kegiatan.unique' => 'Nama Kegiatan Telah Diambil, Silahkan Pilih Nama Kegiatan yang Lain!',
            'nilai_ppk.required' => 'Nilai PPK Wajib dipilih!',
            'kegiatan_berbasis.required' => 'Tempat Kegiatan Untuk Melakukan PPK Wajib Dipilih!',
            'mulai_kegiatan.required' => 'Tanggal Mulai Kegiatan Wajib Dimasukkan!',
            'mulai_kegiatan.before_or_equal' => 'Tanggal Mulai Kegiatan harus lebih dulu atau sama dengan Tanggal Akhir Kegiatan',
            'akhir_kegiatan.required' => 'Tanggal Akhir Kegiatan Wajib Dimasukkan!',
            'akhir_kegiatan.after_or_equal' => 'Tanggal Akhir Kegiatan harus setelah atau sama dengan Tanggal Mulai Kegiatan',
            'dokumen_kegiatan.required' => 'Silahkan Unggah Dokumen Proposal Kegiatan!',
            'dokumen_kegiatan.mimes' => 'Sistem dapat menerima dokumen dengan ekstensi .pdf',
            'dokumen_kegiatan.max' => 'Sistem dapat menerima file hanya 5MB',
            'dokumen_kegiatan.uploaded' => 'Sistem gagal melakukan upload, pastikan ukuran file tidak melebihi 5MB / cek internet Anda'
        ];
    }
}
