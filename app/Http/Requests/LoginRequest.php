<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => strtolower($this->input('email')),
        ]);
    }

    public function rules(): array
    {
        return [
                'email' => 'required|string|email|exists:users,email',
                'password' => 'required|string|min:8',
            ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'email.email' => 'O email deve ser um email valido',
            'email.required' => 'O campo email deve ser preenchido',
            'email.exists' => 'O email não existe, crie uma conta primeiro',
            'email.string' => 'o email deve ser um texto valido',

            'password.required' => 'A senha é obrigatorio',
            'password.string' => 'A senha deve ser um texto valido',
            'password.min' => 'A senha deve ter no minimo 8 caracteres',
        ];
    }
}
