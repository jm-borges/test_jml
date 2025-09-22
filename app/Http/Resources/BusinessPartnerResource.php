<?php

namespace App\Http\Resources;

use App\Models\BusinessPartner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessPartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var BusinessPartner $this */

        return [
            'id' => $this->id,
            'name' => $this->name,
            'cnpj' => $this->formatCnpj($this->cnpj),
            'email' => $this->email,
            'type' => [
                'value' => $this->type->value,
                'label' => $this->type->label(),
            ],
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }

    private function formatCnpj(?string $cnpj): ?string
    {
        if (! $cnpj) {
            return null;
        }

        return preg_replace(
            "/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/",
            "$1.$2.$3/$4-$5",
            $cnpj
        );
    }
}
