<?php

namespace Modules\TitikSampah\Http\Requests; // ⚠️ samakan dengan namespace file hasil generate milikmu

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TitikSampahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'nama_tps'        => 'required|string|max:255', 
            'kecamatan'       => 'required|string|max:255',
            'deskripsi'       => 'required|string|max:255',
            'kapasitas_kg'    => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_tps.required'        => 'Nama TPS wajib diisi.',
            'kecamatan.required'       => 'Kecamatan wajib diisi.',
            'deskripsi.required'       => 'Deskripsi wajib diisi.',
            'kapasitas_kg.required'    => 'Kapasitas/kg wajib diisi.',
            'max'                      => ':attribute tidak boleh lebih dari :max karakter.', // pesan umum untuk semua aturan max
        ];
    }
}
