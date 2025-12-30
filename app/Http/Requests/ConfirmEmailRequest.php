<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmEmailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'userId' => ['required', 'integer'],
            'hash' => ['required', 'string'],
            'token' => ['required', 'string'],
            'full_url' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'full_url' => $this->fullUrl(),
        ]);
    }
}
