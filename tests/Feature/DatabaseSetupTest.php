<?php

namespace Tests\Feature;

use Database\Seeders\BusinessPartnerSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DatabaseSetupTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function migrations_and_seeders_run_correctly()
    {
        $this->seed(UserSeeder::class);
        $this->seed(BusinessPartnerSeeder::class);

        $this->assertDatabaseCount('users', 11);
        $this->assertDatabaseHas('users', ['email' => 'admin@example.com']);

        $this->assertDatabaseCount('business_partners', 22);
        $this->assertDatabaseHas('business_partners', ['cnpj' => '12345678000190']);
        $this->assertDatabaseHas('business_partners', ['cnpj' => '98765432000109']);
    }
}
