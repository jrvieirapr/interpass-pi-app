<?php

namespace Tests\Feature;

use Database\Factories\EventoFactory;
use App\Models\Evento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**Listar todos os eventos
     * @return void
     */

    public function testListarTodosEventos()
    {
        //Criar 5 eventos
        //Salvar Temporario
        Evento::factory()->count(5)->create();

        // usar metodo GET para verificar o retorno
        $response = $this->getJson('/api/eventos');

        //Testar ou verificar saida
        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'created_at', 'updated_at']
                ]
            ]);
    }
}
