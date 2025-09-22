<?php

namespace App\Models;

use App\Enums\BusinessPartnerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessPartner extends Model
{
    /** @use HasFactory<\Database\Factories\BusinessPartnerFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'cnpj',
        'email',
        'type',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => BusinessPartnerType::class,
        ];
    }
}
