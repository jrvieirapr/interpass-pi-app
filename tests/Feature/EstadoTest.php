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
        Estado::factory()->count(5)->create();

        $response = $this->getJson('/api/estados/');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['nome', 'created_at', 'updated_at']
                ]
            ]);
    }

    public function testCriarEstadosSucesso()
    {

         $data = [
            'nome' => "" . $this->faker->word . " " .
            $this->faker->numberBetween($int1 = 0, $int2 = 99999),

         ];

         $response = $this->postJson('/api/estados/', $data);

         $response->assertStatus(201)
            ->assertJsonStructure(['nome', 'created_at', 'updated_at']);
    }

    public function testCriacaoEstadosFalha()
    {
        $data = [
            "nome" => 'a',
        ];

        $response = $this->postJson('/api/estado/', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nome']);
    }

    public function testPesquisaEstadosSucesso()
    {
        $estado = Estado::factory()->create();

        $response = $this->getJson('/api/estados/' . $estado);

        $response->assertStatus(200)
            ->assertJson([
                'nome' => $estado->id,
            ]);
    }

    public function testPesquisaEstadosComFalha()
    {
        $response = $this->getJson('/api/estados/999');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Estado não encontrado'
            ]);
    }

    public function testUpdateEstadosSucesso()
    {
        $estado = Estado::factory()->create();

        $newData = [
            'nome' => 'Novo Estado',

        ];

        $response = $this->putJson('/api/estados/' . $estado->id, $newData);

        $response->assertStatus(200)
            ->assertJson([
                'nome' =>  $estado->id,
            ]);
    }

    public function testUpdateEstadosNaoExistente()
    {
        $tipo = Pais::factory()->create();


        $newData = [
            'nome' => 'Novo Estado',
            'pais_id' => $tipo->id
        ];

        $response = $this->putJson('/api/estados/999', $newData);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Estado não encontrado'
            ]);

    }

    public function testUpdateEstadosMesmoNome()
    {
        $estado = Estado::factory()->create();

        // Data para update
        $sameData = [
            'nome' => $estado->estado,
            
        ];

        // Faça uma chamada PUT
        $response = $this->putJson('/api/estados/' . $estado->id, $sameData);

        // Verifique a resposta
        $response->assertStatus(200)
            ->assertJson([
                'nome' => $estado->id,

            ]);
    }

    public function testUpdateEstadosNomeDuplicado()
    {
        // Crie um tipo fake
        $estado = Estado::factory()->create();
        $atualizar = Estado::factory()->create();

        // Data para update
        $sameData = [
            'nome' => $estado->nome,
            'pais_id' => $estado->pais->id
        ];

        // Faça uma chamada PUT
        $response = $this->putJson('/api/estados/' . $atualizar->id, $sameData);

        // Verifique a resposta
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nome']);
    }

    public function testDeleteEstados()
    {
        // Criar produto fake
        $estado = Estado::factory()->create();

        // enviar requisição para Delete
        $response = $this->deleteJson('/api/estados/' . $estado->id);

        // Verifica o Delete
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Estado deletado com sucesso!'
            ]);

        //Verifique se foi deletado do banco
        $this->assertDatabaseMissing('estados', ['id' => $estado->id]);
    }

    public function testDeleteEstadoNaoExistente()
    {
        // enviar requisição para Delete
        $response = $this->deleteJson('/api/estados/999');

        // Verifique a resposta
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Estado não encontrado!'
            ]);
    }

}


