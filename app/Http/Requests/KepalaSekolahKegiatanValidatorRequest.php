<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KepalaSekolahKegiatanValidatorRequest extends FormRequest
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
            'keterangan' => 'max:255'
        ];
    }
    public function messages()
    {
        return [
            'keterangan.max' => 'Karakter dalam Keterangan melebihi 255 kata'
        ];
    }
}
