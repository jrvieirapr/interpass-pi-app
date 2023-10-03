<?php

namespace Database\Factories;

use App\Models\Cidade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomeEvento' => "" . $this->faker->unique()->word(),
            'dataEvento' => $this->faker->date(),
            'localEvento' => "" . $this->faker->unique()->country(),
            'qtIngresso' => $this->faker->numberBetween($int = 0, $int2 = 99999),
            'cidade_id' => function () {
                return Cidade::factory()->create()->id;
            },
        ];
    }
}
