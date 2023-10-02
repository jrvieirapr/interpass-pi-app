<?php

namespace Tests\Feature;

use App\Models\Estado;
use App\Models\Pais;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EstadoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testListarTodosEstados()
    {
        $estados = Estado::factory()->count(5)->create();  

        $response = $this->getJson('/api/estados');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'nome', 'created_at', 'updated_at']
                ]
            ]);
    }

    public function testCriarEstadoSucesso()
    {

        $pais = Pais::factory()->create();

        $data = [
            'nome' => $this->faker->unique()->word,
            'pais_id' => $pais->id
        ];

        $response = $this->postJson('/api/estados', $data);

        $response->assertStatus(201)
            ->assertJsonStructure(['id', 'nome', 'created_at', 'updated_at']);
    }

    public function testCriacaoEstadoFalha()
    {
        $data = [
            'nome' => '', // Deve falhar devido à validação
            'pais_id' => ''
        ];

        $response = $this->postJson('/api/estados', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nome', 'pais_id']);
    }

    public function testPesquisaEstadoSucesso()
    {
        $estado = Estado::factory()->create();

        $response = $this->getJson('/api/estados/' . $estado->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $estado->id,
                'nome' => $estado->nome,
            ]);
    }

    public function testPesquisaEstadoComFalha()
    {
        $response = $this->getJson('/api/estados/999');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Estado não encontrado!'
            ]);
    }

    public function testUpdateEstadoSucesso()
    {
        $estado = Estado::factory()->create();

        $newData = [
            'nome' => 'Novo Estado',
            'pais_id' => $estado->pais_id
        ];

        $response = $this->putJson('/api/estados/' . $estado->id, $newData);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $estado->id,
                'nome' => 'Novo Estado', // Verifique se o nome foi atualizado
            ]);
    }

    public function testUpdateEstadoNaoExistente()
    {
        $newData = Estado::factory()->make()->toArray();

        $response = $this->putJson('/api/estados/999', $newData);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Estado não encontrado!'
            ]);
    }

    public function testDeleteEstado()
    {
        $estado = Estado::factory()->create();

        $response = $this->deleteJson('/api/estados/' . $estado->id);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Estado deletado com sucesso!'
            ]);

        $this->assertDatabaseMissing('estados', ['id' => $estado->id]);
    }

    public function testDeleteEstadoNaoExistente()
    {
        $response = $this->deleteJson('/api/estados/999');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Estado não encontrado!'
            ]);
    }
}