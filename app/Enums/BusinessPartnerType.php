<?php

namespace App\Enums;

enum BusinessPartnerType: string
{
    case CLIENT = 'client';
    case SUPPLIER = 'supplier';

    /**
     * Retorna o label em português para exibição.
     */
    public function label(): string
    {
        return match ($this) {
            self::CLIENT => 'Cliente',
            self::SUPPLIER => 'Fornecedor',
        };
    }

    /**
     * Retorna todos os valores com seus labels.
     */
    public static function options(): array
    {
        return array_map(
            fn(self $case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ],
            self::cases()
        );
    }
}
