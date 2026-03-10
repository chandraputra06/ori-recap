<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNetflixWeekAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'tanggal_terjual' => ['nullable', 'date'],
            'durasi_habis' => ['nullable', 'date'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email akun wajib diisi.',
            'email.email' => 'Format email akun tidak valid.',
            'password.required' => 'Password akun wajib diisi.',
            'tanggal_terjual.date' => 'Tanggal terjual harus berupa tanggal yang valid.',
            'durasi_habis.date' => 'Durasi habis harus berupa tanggal yang valid.',
        ];
    }
}