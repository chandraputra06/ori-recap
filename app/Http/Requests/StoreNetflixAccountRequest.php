<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNetflixAccountRequest extends FormRequest
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
            'tanggal_reset' => ['nullable', 'date'],
            'tipe_sharing' => ['required', 'in:1P1U 1 Bulan,1P2U 1 Bulan,1P1U 1 Week,DIBELI'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email akun wajib diisi.',
            'email.email' => 'Format email akun tidak valid.',
            'password.required' => 'Password akun wajib diisi.',
            'tanggal_reset.date' => 'Tanggal reset harus berupa tanggal yang valid.',
            'tipe_sharing.required' => 'Tipe sharing wajib dipilih.',
            'tipe_sharing.in' => 'Tipe sharing yang dipilih tidak valid.',
        ];
    }
}