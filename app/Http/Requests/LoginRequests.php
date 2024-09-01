<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequests extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required_without:email|exists:registrasi,username', // Username wajib diisi jika email tidak ada
            'email' => 'required_without:username|exists:registrasi,email', // Email wajib diisi jika username tidak ada
            'password' => 'required|min:8'
        ];
    }
}
