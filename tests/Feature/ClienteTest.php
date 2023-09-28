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

             /**
     * Teste de pesquisa de registro
     *
     * @return void
     */
    public function testPesquisaClienteSucesso()
    {
        // Criar um cliente
        $cliente = Cliente::factory()->create();

        // Fazer pesquisa
        $response = $this->getJson('/api/clientes/' . $cliente->id);   
        
        // Verificar saida
        $response->assertStatus(200)
            ->assertJson([
                'id' => $cliente->id,
                'nomeCliente' => $cliente->nomeCliente,
                'idade' => $cliente->idade,
                'sexo' => $cliente->sexo,
                'rgIE' => $cliente->rgIE,
                'cpfCNPJ' => $cliente->cpfCNPJ,
                'email' => $cliente->email,                
                'telefone' => $cliente->telefone,                
            ]);
    }

                /**
     * Teste de pesquisa de registro com falha
     *
     * @return void
     */
    public function testPesquisaClienteComFalha()
    {
        // Fazer pesquisa com um id inexistente
        $response = $this->getJson('/api/clientes/999'); // o 999 nao pode existir

        // Veriicar a resposta
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Cliente não encontrado'
            ]);
    }

                /**
     *Teste de upgrade com sucesso
     *
     * @return void
     */
    public function testUpdateClienteSucesso()
    {
        // Crie um cliente fake
        $cliente = Cliente::factory()->create();

        // Dados para update
        $newData = [
            "nomeCliente" => 'carlos',
            "idade" => 25,
            "sexo" => 'M',
            "rgIE" => '123456788',
            "cpfCNPJ" => '123456787',
            "email" => 'carlos@carlos.com',
            "telefone" => '12341234'

        ];

        // Faça uma chamada PUT
        $response = $this->putJson('/api/clientes/' . $cliente->id, $newData);

        //dd($response);
        // Verifique a resposta
        $response->assertStatus(200)
            ->assertJson([
                'id' => $cliente->id,
                "nomeCliente" => 'carlos',
                "idade" => 25,
                "sexo" => 'M',
                "rgIE" => '123456788',
                "cpfCNPJ" => '123456787',
                "email" => 'carlos@carlos.com',
                "telefone" => '12341234'
            ]);
    }

            /**
     * Testando com falhas
     *
     * @return void
     */
    public function testUpdateClienteDataInvalida()
    {
        // Crie um cliente falso
        $cliente = Cliente::factory()->create();

        // Crie dados falhos
        $invalidData = [
            'rgIE' => '', // Invalido: status vazio
        ];

        // faça uma chamada PUT
        $response = $this->putJson('/api/clientes/' . $cliente->id, $invalidData);

        // Verificar se teve um erro 422
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['rgIE']);
    }

                /**
     * Teste update de marca
     *
     * @return void
     */
    public function testUpdateClienteNaoExistente()
    {

        // Dados para update
        $newData = [
            "nomeCliente" => 'carlos',
            "idade" => 25,
            "sexo" => 'M',
            "rgIE" => '123456788',
            "cpfCNPJ" => '123456787',
            "email" => 'carlos@carlos.com',
            "telefone" => '12341234'

        ];
        // Faça uma chamada PUT
        $response = $this->putJson('/api/clientes/9999', $newData);

        // Verificar o retorno 404
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Cliente não encontrado'
            ]);
    }

               /**
     * Teste de upgrade com os mesmos dados
     *
     * @return void
     */
    public function testUpdateClienteMesmosDados()
    {
        // Crie um cliente fake
        $cliente = Cliente::factory()->create();

        // Data para update
        $sameData = [
            'rgIE' => $cliente->rgIE,             
        ];

        // Faça uma chamada PUT
        $response = $this->putJson('/api/clientes/' . $cliente->id, $sameData);

        // Verifique a resposta
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['rgIE']);
    }

                /**
     * Teste upgrade com nome duplicado
     *
     * @return void
     */
    public function testUpdateClienteStatusDuplicado()
    {
        // Crie dois clientes fakes
        $clienteExistente = Cliente::factory()->create();
        $clienteUpgrade = Cliente::factory()->create();

        // Para para upgrade
        $newData = [
            'rgIE' => $clienteExistente->rgIE,            
        ];

        // Faça o put 
        $response = $this->putJson('/api/clientes/' . $clienteUpgrade->id, $newData);

        // Verifique a resposta
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['rgIE']);
    }

                /**
     * Teste de deletar com sucesso
     *
     * @return void
     */
    public function testDeleteCliente()
    {
        // Criar cliente fake
        $cliente = Cliente::factory()->create();
      

        // // enviar requisição para Delete
        $response = $this->deleteJson('/api/clientes/' . $cliente->id);

        // Verificar o Delete
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Cliente deletado com sucesso!'
            ]);

        //Verifique se foi deletado do banco
        $this->assertDatabaseMissing('clientes', ['id' => $cliente->id]);
    }

        /**
     * Teste remoção de registro inexistente
     *
     * @return void
     */
    public function testDeleteClienteNaoExistente()
    {
        // enviar requisição para Delete
        $response = $this->deleteJson('/api/clientes/999');

        // Verifique a resposta
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Cliente não encontrado!'
            ]);
    }
}
