<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequests extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required',
            'email' => 'required|email|unique:registrasi',
            'password' => 'required|min:8',
            'password' => 'required|same:password|min:8',
            'nip' => 'nullable|unique:registrasi',
            'nik' => 'nullable|unique:registrasi',
            'no_hp' => 'nullable|unique:registrasi',
            'foto' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048|', // Validasi gambar
            'foto_ktp' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048|', // Validasi gambar
            // 'foto' => 'nullable|foto|mimes:jpeg,png,jpg,gif|max:2048|dimensions:ratio=1/1', // Validasi gambar
            // 'foto_ktp' => 'nullable|foto_ktp|mimes:jpeg,png,jpg,gif|max:2048|dimensions:ratio=4/3', // Validasi gambar
            'foto.max' => 'Gambar tidak boleh lebih dari 2MB.',
            'foto.dimensions' => 'Gambar harus memiliki rasio 1:1.',
        ];
    }
}
