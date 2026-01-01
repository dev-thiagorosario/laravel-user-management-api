<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
                'current_password' => 'required|string|min:8',
                'new_password' => 'required|string|min:8|different:current_password',
                'new_password_confirmation' => 'required|string|same:new_password',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'A senha atual é obrigatória.',
            'current_password.string' => 'A senha atual deve ser um texto válido.',
            'current_password.min' => 'A senha atual deve ter no mínimo 8 caracteres.',

            'new_password.required' => 'A nova senha é obrigatória.',
            'new_password.string' => 'A nova senha deve ser um texto válido.',
            'new_password.min' => 'A nova senha deve ter no mínimo :min caracteres.',
            'new_password.different' => 'A nova senha deve ser diferente da senha atual.',

            'new_password_confirmation.required' => 'A confirmação da nova senha é obrigatória.',
            'new_password_confirmation.string' => 'A confirmação da nova senha deve ser um texto válido.',
            'new_password_confirmation.same' => 'A confirmação da nova senha não confere com a nova senha.',
        ];
    }
}
