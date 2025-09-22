<?php

namespace App\Http\Requests\BusinessPartners;

use Illuminate\Foundation\Http\FormRequest;

class GetBusinessPartnersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'q' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'q.string' => 'O filtro deve ser um texto.',
            'q.max'    => 'O filtro não pode passar de 255 caracteres.',
        ];
    }
}
