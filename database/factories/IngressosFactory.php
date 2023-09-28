<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingressos>
 */
class IngressosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chaveIngresso' => "" . $this->faker->word . " " . $this->faker->numberBetween($int1 = 0, $int2 = 99999),
            'evento_id' => function () {
                return Evento::factory()->create()->id;
            },
            'dataEmissao' => $this->faker->date(),
            'cliente_id' => function () {
                return Cliente::factory()->create()->id;
            },
            'metodoPagamento' => "" . $this->faker->word . " " . $this->faker->numberBetween($int1 = 0, $int2 = 99999),
            'valorCompra' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
