<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'phone' => $this->faker->phoneNumber,
            'birth_date' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'is_super_admin' => false,
            'preferred_currency' => 'BRL',
            'preferred_language' => 'pt',
            'timezone' => 'America/Sao_Paulo',
            'date_format' => 'd/m/Y',
            'country_code' => 'BR',
            'thousands_separator' => '.',
            'decimal_separator' => ',',
            'created_by' => null,
        ];
    }
}
