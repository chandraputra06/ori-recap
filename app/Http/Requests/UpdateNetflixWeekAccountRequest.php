<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNetflixWeekAccountRequest extends FormRequest
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
}