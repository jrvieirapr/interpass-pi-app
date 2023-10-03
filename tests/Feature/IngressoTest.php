<?php

namespace Tests\Feature;

use App\Models\Evento;
use App\Models\Ingressos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngressoTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testIndexRetornaListaDeIngressos()
    {

        // Crie alguns dados de ingresso no banco de dados usando o Factory
        $ingressos = Ingressos::factory(3)->create();

        // Faça uma solicitação para a rota index
        $response = $this->get('/api/ingressos');

        // Verifique se a resposta tem status 200 e se a estrutura JSON esperada está presente
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'chaveIngresso', 'evento_id', 'dataEmissao', 'cliente_id', 'metodoPagamento', 'valorCompra', 'created_at', 'updated_at']]]);
    }

    public function testStoreCriaNovoIngresso()
    {
        // Crie dados de ingresso de exemplo
        $data = Ingressos::factory()->make()->toArray();

        // Faça uma solicitação POST para a rota store com os dados acima
        $response = $this->post('/api/ingressos', $data);

        // Verifique se a resposta tem status 201 e se os dados do ingresso foram retornados
        $response->assertStatus(201)
            ->assertJson($data);
    }

    public function testShowRetornaIngressoExistente()
    {
        // Crie um ingresso no banco de dados usando o Factory
        $ingresso = Ingressos::factory()->create();

        // Faça uma solicitação para a rota show com o ID do ingresso criado
        $response = $this->get("/api/ingressos/{$ingresso->id}");

        // Verifique se a resposta tem status 200 e se os dados do ingresso foram retornados
        $response->assertStatus(200)
            ->assertJson($ingresso->toArray());
    }

    public function testShowRetorna404ParaIngressoInexistente()
    {
        // Faça uma solicitação para a rota show com um ID de ingresso inexistente
        $response = $this->get('/api/ingressos/999');

        // Verifique se a resposta tem status 404 e se a mensagem de erro é retornada
        $response->assertStatus(404)
            ->assertJson(['message' => 'Ingressos não encontrado!']);
    }

    public function testUpdateAtualizaIngressoExistente()
    {
        // Crie um ingresso no banco de dados usando o Factory
        $ingresso = Ingressos::factory()->create();

        // Crie novos dados de ingresso para atualização
        $newData = Ingressos::factory()->make()->toArray();

        // Faça uma solicitação PUT para a rota update com os novos dados
        $response = $this->put("/api/ingressos/{$ingresso->id}", $newData);

        // Verifique se a resposta tem status 200 e se os dados do ingresso atualizados foram retornados
        $response->assertStatus(200)
            ->assertJson($newData);
    }

    public function testUpdateRetorna404ParaIngressoInexistente()
    {
        // Crie novos dados de ingresso para atualização
        $newData = Ingressos::factory()->make()->toArray();

        // Faça uma solicitação PUT para a rota update com um ID de ingresso inexistente
        $response = $this->put('/api/ingressos/999', $newData);

        // Verifique se a resposta tem status 404 e se a mensagem de erro é retornada
        $response->assertStatus(404)
            ->assertJson(['message' => 'Ingressos não encontrado!']);
    }

    public function testDestroyRemoveIngressoExistente()
    {
        // Crie um ingresso no banco de dados usando o Factory
        $ingresso = Ingressos::factory()->create();

        // Faça uma solicitação DELETE para a rota destroy com o ID do ingresso criado
        $response = $this->delete("/api/ingressos/{$ingresso->id}");

        // Verifique se a resposta tem status 200 e se a mensagem de sucesso é retornada
        $response->assertStatus(200)
            ->assertJson(['message' => 'Ingressos deletado com sucesso!']);

        // Verifique se o ingresso foi removido do banco de dados
        $this->assertDatabaseMissing('ingressos', ['id' => $ingresso->id]);
    }

    public function testDestroyRetorna404ParaIngressoInexistente()
    {
        // Faça uma solicitação DELETE para a rota destroy com um ID de ingresso inexistente
        $response = $this->delete('/api/ingressos/999');

        // Verifique se a resposta tem status 404 e se a mensagem de erro é retornada
        $response->assertStatus(404)
            ->assertJson(['message' => 'Ingressos não encontrado!']);
    }
}
