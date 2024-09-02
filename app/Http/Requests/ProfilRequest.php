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
            'registrasi_id' => 'required|exists:registrasi,id',
            'namadepan' => 'required',
            'namabelakang' => 'required',
            'no_hp' => 'required|unique:profil'
        ];
    }
}
