<?php

namespace Tests\Feature;

use App\Models\Cidade;
use App\Models\Estado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CidadeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testListarTodosCidades()
    {
        Cidade::factory()->count(5)->create();

        $response = $this->getJson('/api/cidades/');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['nome', 'created_at', 'updated_at']
                ]
            ]);
    }

    public function testCriarCidadesSucesso()
    {
         $data = Cidade::factory()->make()->toArray();
         $response = $this->postJson('/api/cidades/', $data);

         $response->assertStatus(201)
            ->assertJsonStructure(['nome', 'created_at', 'updated_at']);
    }

    public function testCriacaoCidadesFalha()
    {
        $data = [
            "nome" => 'a',
            "estado_id" => ''
        ];

        $response = $this->postJson('/api/cidades/', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nome']);
    }

    public function testPesquisaCidadesSucesso()
    {
        $cidade = Cidade::factory()->create();

        $response = $this->getJson('/api/cidades/' . $cidade->id);

        $response->assertStatus(200)
            ->assertJson([
                'nome' => $cidade->nome,
            ]);
    }

    public function testPesquisaCidadeComFalha()
    {
        // Fazer pesquisa com um id inexistente
        $response = $this->getJson('/api/cidades/999'); // o 999 nao pode existir

        // Veriicar a resposta
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Cidade não encontrada!'
            ]);
    }

    public function testUpdateCidadeSucesso()
    {
        $cidade = Cidade::factory()->create();

        $newData = Cidade::factory()->make()->toArray();

        $response = $this->putJson('/api/cidades/' . $cidade->id, $newData);

        $response->assertStatus(200)
            ->assertJson([
                'nome' =>  $newData['nome'],
            ]);
    }

    public function testUpdateCidadesNaoExistente()
    {
        $newData = Cidade::factory()->make()->toArray();

        $response = $this->putJson('/api/cidades/999', $newData);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Cidade não encontrada!'
            ]);
    }

   
    
    public function testDeleteCidades()
    {
        // Criar produto fake
        $cidade = Cidade::factory()->create();

        // enviar requisição para Delete
        $response = $this->deleteJson('/api/cidades/' . $cidade->id);

        // Verifica o Delete
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Cidade deletada com sucesso!'
            ]);

        //Verifique se foi deletado do banco
        $this->assertDatabaseMissing('cidades', ['id' => $cidade->id]);
    }

    public function testDeleteCidadeNaoExistente()
    {
        // enviar requisição para Delete
        $response = $this->deleteJson('/api/cidades/999');

        // Verifique a resposta
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Cidade não encontrada!'
            ]);
    }
}
