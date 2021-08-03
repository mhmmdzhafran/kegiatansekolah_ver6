<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
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
            "dokumentasi_kegiatan_ppk.*" => 'required|mimes:pdf,doc,docx|max:5120',
            'image_kegiatan_ppk.*' => 'required|mimes:jpeg,png|max:5120',
            'add_link_video.*' => 'required|url',
            'add_link_article.*' => 'required|url'
            // 'dokumentasi_kegiatan_ppk' => 'required|mimes:pdf,doc,docx|max:5120',
            // 'image_kegiatan_ppk' => 'required|mimes:jpeg,png|max:5120',
        ];
    }

    public function messages()
    {
        return[
            // 'akhir_kegiatan.required' => 'Tanggal Akhir Kegiatan Wajib Dimasukkan!',
            'dokumentasi_kegiatan_ppk.*.required' => 'Dokumen Kegiatan Wajib Diunggah dengan ekstensi .pdf, .doc, atau .docx',
            'dokumentasi_kegiatan_ppk.*.mimes' => 'Dokumen Kegiatan yang diunggah harus berekstensi .pdf, .doc, atau .docx',
            'dokumentasi_kegiatan_ppk.*.max' => 'Dokumen Kegiatan harap tidak melebihi dari 5MB',
            'image_kegiatan_ppk.*.mimes' => 'Sistem dapat menerima foto dengan ekstensi .jpeg atau .png',
            'image_kegiatan_ppk.*.required' => 'Foto Kegiatan Harap Diunggah dengan ekstensi .jpeg atau .png',
            'image_kegiatan_ppk.*.max' => 'Foto Kegiatan harap tidak melebihi dari 5MB',
            'add_link_video.*.required' => 'Link Video Kegiatan harap dicantumkan!',
            'add_link_video.*.url' => 'Link Video Kegiatan tidak valid!',
            'add_link_article.*.required' => 'Link Artikel Kegiatan harap dicantumkan!',
            'add_link_article.*.url' => 'Link Arikel Kegiatan tidak valid!'
            // 'dokumentasi_kegiatan_ppk.required' => 'Laporan Kegiatan Harap Diunggah dengan ekstensi .pdf atau .doc atau .docx',
            // 'dokumentasi_kegiatan_ppk.mimes' => 'Sistem dapat menerima dokumen dengan ekstensi .pdf atau .doc atau .docx',
            // 'dokumentasi_kegiatan_ppk.max' => 'Laporan Kegiatan harap tidak melebihi dari 5MB',
            // 'image_kegiatan_ppk.required' => 'Dokumentasi Kegiatan Harap Diunggah dengan ekstensi .jpeg atau .png',
            // 'image_kegiatan_ppk.mimes' => 'Sistem dapat menerima dokumen dengan ekstensi .jpeg atau .png',
            // 'image_kegiatan_ppk.max' => 'Foto Kegiatan harap tidak melebihi dari 5MB',
        ];
    }
}
