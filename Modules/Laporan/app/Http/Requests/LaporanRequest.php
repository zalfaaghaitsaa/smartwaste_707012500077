<?php

namespace Modules\Laporan\Http\Requests; // ⚠️ samakan namespace

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LaporanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }
    
    public function rules(): array
    {
        return [
            'titik_sampahs_id' => 'required|integer|exists:titik_sampahs,id',
            'volume_sampah'    => 'required|integer|min:1',
            'status_kondisi'   => 'required|string',
            'deskripsi'        => 'required|string|min:10',          
            'foto_bukti'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ];
    }

    public function messages(): array
    {
        return [
            'titik_sampahs_id.required' => 'Titik sampah wajib dipilih.',
            'titik_sampahs_id.exists'   => 'Titik sampah yang dipilih tidak valid.',
            'deskripsi.required'    => 'Deskripsi kerusakan wajib diisi.',
            'deskripsi.min'         => 'Deskripsi minimal :min karakter.',
            'foto.image'            => 'File harus berupa gambar.',
            'foto.mimes'            => 'Format foto harus jpg, jpeg, atau png.',
            'foto.max'              => 'Ukuran foto maksimal 2 MB.',
        ];
    }
}
