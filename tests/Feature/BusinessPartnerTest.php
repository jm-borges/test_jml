<?php

namespace Tests\Feature;

use App\Models\BusinessPartner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class BusinessPartnerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    private function validCnpj(): string
    {
        return '11444777000161';
    }

    private function invalidCnpj(): string
    {
        return '12345678000190';
    }

    #[Test]
    public function can_list_business_partners_with_filters()
    {
        BusinessPartner::factory()->create(['name' => 'Fornecedor XPTO', 'type' => 'supplier', 'cnpj' => $this->validCnpj()]);
        BusinessPartner::factory()->create(['name' => 'Cliente ABC', 'type' => 'client', 'cnpj' => '11444777000162']);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/business-partners?q=XPTO&type=supplier');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['name' => 'Fornecedor XPTO']);
    }

    #[Test]
    public function can_create_business_partner_successfully()
    {
        $payload = [
            'name' => 'Novo Fornecedor',
            'cnpj' => $this->validCnpj(),
            'email' => 'contato@fornecedor.com',
            'type' => 'supplier',
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/v1/business-partners', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Novo Fornecedor']);

        $this->assertDatabaseHas('business_partners', [
            'cnpj' => $this->validCnpj()
        ]);
    }

    #[Test]
    public function cannot_create_business_partner_with_invalid_data()
    {
        $payload = [
            'name' => 'No',
            'cnpj' => $this->invalidCnpj(),
            'email' => 'invalid-email',
            'type' => 'invalid_type',
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/v1/business-partners', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'cnpj', 'email', 'type']);
    }

    #[Test]
    public function can_update_business_partner()
    {
        $partner = BusinessPartner::factory()->create(['cnpj' => $this->validCnpj()]);

        $payload = ['name' => 'Nome Atualizado'];

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson("/api/v1/business-partners/{$partner->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Nome Atualizado']);

        $this->assertDatabaseHas('business_partners', ['id' => $partner->id, 'name' => 'Nome Atualizado']);
    }

    #[Test]
    public function can_delete_business_partner()
    {
        $partner = BusinessPartner::factory()->create(['cnpj' => $this->validCnpj()]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson("/api/v1/business-partners/{$partner->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Deletado com sucesso']);

        $this->assertSoftDeleted('business_partners', ['id' => $partner->id]);
    }
}
