<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        $userId = $this->user()?->id;

        return [
            'name' => 'required|string|min:3|max:255|regex:/^[\\p{L} ]+$/u',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
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
        ];
    }
}
