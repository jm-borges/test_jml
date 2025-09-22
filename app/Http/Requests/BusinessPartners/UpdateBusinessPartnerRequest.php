<?php

namespace App\Http\Requests\BusinessPartners;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\BusinessPartnerType;
use App\Rules\CnpjIsValid;

class UpdateBusinessPartnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('business_partner');

        return [
            'name'  => ['sometimes', 'string', 'min:3', 'max:255'],
            'cnpj'  => ['sometimes', 'string', new CnpjIsValid(), Rule::unique('business_partners', 'cnpj')->ignore($id)],
            'email' => ['nullable', 'email', 'max:255'],
            'type'  => ['sometimes', Rule::in(array_column(BusinessPartnerType::cases(), 'value'))],
        ];
    }

    public function messages(): array
    {
        return [
            'name.min'        => 'O nome deve ter pelo menos 3 caracteres.',
            'cnpj.digits'     => 'O CNPJ deve conter exatamente 14 dígitos.',
            'cnpj.unique'     => 'Já existe um parceiro cadastrado com esse CNPJ.',
            'email.email'     => 'O e-mail informado não é válido.',
            'type.in'         => 'O tipo deve ser válido (client ou supplier).',
        ];
    }
}
