<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255|regex:/^[\\p{L} ]+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->mixedCase()->numbers(),
            ]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatorio',
            'name.string' => 'O nome deve ser um texto valido',
            'name.regex' => 'O nome deve conter apenas letras (com ou sem acentos) e espaços',
            'name.max' => 'O nome deve ter no maximo 255 caracteres',
            'name.min' => 'O nome deve ter no minimo 3 caracteres',


            'email.required' => 'O e-mail é obrigatório.',
            'email.string'   => 'O e-mail deve ser um texto válido.',
            'email.email'    => 'Informe um e-mail válido.',
            'email.max'      => 'O e-mail pode ter no máximo :max caracteres.',
            'email.unique'   => 'Este e-mail já está em uso.',

            'password.required'  => 'A senha é obrigatória.',
            'password.string'    => 'A senha deve ser um texto válido.',
            'password.confirmed' => 'A confirmação da senha não confere.',

            'password.min'           => 'A senha deve conter no mínimo :min caracteres.',
            'password.mixed'         => 'A senha deve conter ao menos uma letra maiúscula e uma minúscula.',
            'password.numbers'       => 'A senha deve conter ao menos um número.',
        ];
    }
}
