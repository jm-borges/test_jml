<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusinessPartner;

class BusinessPartnerSeeder extends Seeder
{
    public function run(): void
    {
        BusinessPartner::factory()->count(20)->create();

        BusinessPartner::factory()->create([
            'name' => 'Fornecedor XPTO',
            'cnpj' => '12345678000190',
            'email' => 'contato@xpto.com',
            'type' => 'supplier',
        ]);

        BusinessPartner::factory()->create([
            'name' => 'Cliente ABC',
            'cnpj' => '98765432000109',
            'email' => 'contato@abc.com',
            'type' => 'client',
        ]);
    }
}
