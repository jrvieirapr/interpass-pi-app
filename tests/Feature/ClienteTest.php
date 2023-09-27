<?php

namespace Tests\Feature;

use Database\Factories\ClienteFactory;
use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**Listar todos os clientes
     * @return void
     */

    public function testListarTodosClientes()
    {
        //Criar 5 clientes
        //Salvar Temporario
        Cliente::factory()->count(5)->create();

        // usar metodo GET para verificar o retorno
        $response = $this->getJson('/api/clientes');

        //Testar ou verificar saida
        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'created_at', 'updated_at']
                ]
            ]);
    }

         /**
     * Criar um Cliente
     */
    public function testCriarClienteSucesso(){

        //Criar o cliente
        $cliente = ClienteFactory::new()->make();

        $data = $cliente->getAttributes();
      

        // Fazer uma requisição POST
        $response = $this->postJson('/api/clientes', $data);


        // Verifique se teve um retorno 201 - Criado com Sucesso
        // e se a estrutura do JSON Corresponde
        $response->assertStatus(201)
            ->assertJsonStructure(['id', 'nomeCliente','idade','sexo','rgIE','cpfCNPJ','email','telefone', 'created_at', 'updated_at']);
    }

        /**
     * Teste de criação com falhas
     *
     * @return void
     */
    public function testCriacaoClienteFalha()
    {
        $data = [
            "nomeCliente" => '',
            "idade" => '',
            "sexo" => '',
            "rgIE" => '',
            "cpfCNPJ" => '',
            "email" => '',
            "telefone" => ''
        ];
         // Fazer uma requisição POST
        $response = $this->postJson('/api/clientes', $data);

        // Verifique se teve um retorno 422 - Falha no salvamento
        // e se a estrutura do JSON Corresponde
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nomeCliente','idade','sexo','rgIE','cpfCNPJ','email','telefone']);
    }
}
