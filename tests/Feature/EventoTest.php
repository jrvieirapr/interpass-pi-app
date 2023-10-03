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

    public function test_it_can_list_all_events()
    {
        Evento::factory()->count(5)->create();

        $response = $this->getJson('/api/eventos');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'nomeEvento', 'dataEvento', 'localEvento', 'qtIngresso', 'cidade_id', 'created_at', 'updated_at']
                ]
            ]);
    }

    public function test_it_can_create_an_event()
    {
        $data = Evento::factory()->make()->toArray();

        $response = $this->postJson('/api/eventos', $data);

        $response->assertStatus(201)
            ->assertJsonStructure(['id', 'nomeEvento', 'dataEvento', 'localEvento', 'qtIngresso', 'cidade_id', 'created_at', 'updated_at']);
    }

    public function test_it_can_show_an_event()
    {
        $evento = Evento::factory()->create();

        $response = $this->getJson('/api/eventos/' . $evento->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $evento->id,
                'nomeEvento' => $evento->nomeEvento,
                'dataEvento' => $evento->dataEvento,
                'localEvento' => $evento->localEvento,
                'qtIngresso' => $evento->qtIngresso,
                'cidade_id' => $evento->cidade_id,
            ]);
    }

    public function test_it_can_update_an_event()
    {
        $evento = Evento::factory()->create();

        $newData = Evento::factory()->make()->toArray();

        $response = $this->putJson('/api/eventos/' . $evento->id, $newData);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $evento->id,
                'nomeEvento' => $newData['nomeEvento'],
                'dataEvento' => $newData['dataEvento'],
                'localEvento' => $newData['localEvento'],
                'qtIngresso' => $newData['qtIngresso'],
                'cidade_id' => $newData['cidade_id'],
            ]);
    }

    public function test_it_can_delete_an_event()
    {
        $evento = Evento::factory()->create();

        $response = $this->deleteJson('/api/eventos/' . $evento->id);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Evento deletado com sucesso!'
            ]);

        $this->assertDatabaseMissing('eventos', ['id' => $evento->id]);
    }
}
