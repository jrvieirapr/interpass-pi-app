<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'nomeEvento' => "" . $this->faker->word . " " . $this->faker->numberBetween($int1 = 0, $int2 = 99999),
            'dataEvento' => $this->faker->date(),
            'localEvento' => "" . $this->faker->word . " " . $this->faker->numberBetween($int1 = 0, $int2 = 99999),
            'qtIngresso' => $this->faker->numberBetween($int = 0, $int2 = 99999),
        ];
    }
}
