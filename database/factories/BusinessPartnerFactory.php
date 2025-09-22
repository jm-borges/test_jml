<?php

namespace Database\Factories;

use App\Models\BusinessPartner;
use App\Enums\BusinessPartnerType;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessPartnerFactory extends Factory
{
    protected $model = BusinessPartner::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'cnpj' => $this->faker->numerify('##############'),
            'email' => $this->faker->unique()->companyEmail,
            'type' => $this->faker->randomElement([
                BusinessPartnerType::CLIENT->value,
                BusinessPartnerType::SUPPLIER->value,
            ]),
        ];
    }
}
