<?php

namespace Tests\Feature;

use App\Models\Pais;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaisTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    public function testListarTodosPaises()
    {
        Pais::factory()->count(5)->create();

        $response = $this->getJson('/api/paises/');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'nome', 'created_at', 'updated_at']
                ]
            ]);
    }

    public function testCriarPaisesSucesso()
    {

        $data = [
            'nome' => "" . $this->faker->word . " " .
                $this->faker->numberBetween($int1 = 0, $int2 = 99999),

        ];

        $response = $this->postJson('/api/paises/', $data);

        $response->assertStatus(201)
            ->assertJsonStructure(['id', 'nome', 'created_at', 'updated_at']);
    }

    public function testCriacaoPaisesFalha()
    {
        $data = [
            "nome" => '',
        ];

        $response = $this->postJson('/api/paises/', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nome']);
    }

    public function testPesquisaPaisesSucesso()
    {
        $tipo = Pais::factory()->create();

        $response = $this->getJson('/api/paises/' . $tipo->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $tipo->id,
                'nome' => $tipo->nome,
            ]);
    }

    public function testPesquisaPaisesComFalha()
    {
        $response = $this->getJson('/api/paises/999');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Pais não encontrado'
            ]);
    }

    public function testUpdatePaisesSucesso()
    {
        $tipo = Pais::factory()->create();

        $newData = [
            'nome' => 'Novo Pais',

        ];

        $response = $this->putJson('/api/paises/' . $tipo->id, $newData);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $tipo->id,
                'nome' =>  $newData['nome'],
            ]);
    }

    public function testUpdatePaisesNaoExistente()
    {
        $tipo = Pais::factory()->create();

        $newData = [
            'nome' => 'Novo Pais',
            'tipo_id' => $tipo->id,
        ];

        $response = $this->putJson('/api/paises/999', $newData);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Pais não encontrado'
            ]);
    }



    public function testDeletePaisesNaoExistente()
    {
        $response = $this->deleteJson('/api/paises/999');

        $response->assertStatus(404)
            ->assertJSon([
                'message' => 'Pais não encontrado!'
            ]);
    }
}