<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_lengkap' =>"required",
            'registrasi_id' => 'required|exists:registrasi,id',
            'no_hp' => 'required|unique:profil',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:ratio=1/1', // Validasi gambar
            'image.max' => 'Gambar tidak boleh lebih dari 2MB.',
            'image.dimensions' => 'Gambar harus memiliki rasio 1:1.',
        ];
    }
}
