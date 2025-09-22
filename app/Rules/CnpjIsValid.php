<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CnpjIsValid implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cnpj = $this->sanitize($value);

        if (! $this->hasValidLength($cnpj)) {
            $fail('O CNPJ deve conter exatamente 14 dígitos.');
            return;
        }

        if ($this->allDigitsAreEqual($cnpj)) {
            $fail('O CNPJ informado é inválido.');
            return;
        }

        if (! $this->hasValidCheckDigits($cnpj)) {
            $fail('O CNPJ informado é inválido.');
            return;
        }
    }

    /**
     * Remove tudo que não é dígito
     */
    private function sanitize(string $cnpj): string
    {
        return preg_replace('/\D/', '', $cnpj);
    }

    /**
     * Verifica se o CNPJ tem 14 dígitos
     */
    private function hasValidLength(string $cnpj): bool
    {
        return strlen($cnpj) === 14;
    }

    /**
     * Checa se todos os dígitos são iguais (ex.: 11111111111111)
     */
    private function allDigitsAreEqual(string $cnpj): bool
    {
        return preg_match('/^(\d)\1{13}$/', $cnpj) === 1;
    }

    /**
     * Valida os dígitos verificadores do CNPJ
     */
    private function hasValidCheckDigits(string $cnpj): bool
    {
        $numbers = substr($cnpj, 0, 12);
        $digits = substr($cnpj, 12, 2);

        return $digits === $this->calculateCheckDigits($numbers);
    }

    /**
     * Calcula os dígitos verificadores do CNPJ
     */
    private function calculateCheckDigits(string $numbers): string
    {
        $calculateDigit = function (string $num) {
            $length = strlen($num);
            $sum = 0;
            $pos = $length - 7;

            for ($i = 0; $i < $length; $i++) {
                $sum += $num[$i] * $pos;
                $pos--;
                if ($pos < 2) $pos = 9;
            }

            $digit = (10 * $sum) % 11;
            return $digit < 10 ? $digit : 0;
        };

        $firstDigit = $calculateDigit($numbers);
        $secondDigit = $calculateDigit($numbers . $firstDigit);

        return $firstDigit . $secondDigit;
    }
}
