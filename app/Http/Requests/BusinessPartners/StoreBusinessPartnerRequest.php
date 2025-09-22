<?php

namespace App\Http\Requests\BusinessPartners;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\BusinessPartnerType;
use App\Rules\CnpjIsValid;

class StoreBusinessPartnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'min:3', 'max:255'],
            'cnpj'  => ['required', 'string', 'unique:business_partners,cnpj', new CnpjIsValid()],
            'email' => ['nullable', 'email', 'max:255'],
            'type'  => ['required', Rule::in(array_column(BusinessPartnerType::cases(), 'value'))],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'O nome é obrigatório.',
            'name.min'        => 'O nome deve ter pelo menos 3 caracteres.',
            'cnpj.required'   => 'O CNPJ é obrigatório.',
            'cnpj.digits'     => 'O CNPJ deve conter exatamente 14 dígitos.',
            'cnpj.unique'     => 'Já existe um parceiro cadastrado com esse CNPJ.',
            'email.email'     => 'O e-mail informado não é válido.',
            'type.required'   => 'O tipo é obrigatório.',
            'type.in'         => 'O tipo deve ser válido (client ou supplier).',
        ];
    }
}
