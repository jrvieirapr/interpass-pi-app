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
            'chaveIngresso' => (string) $this->faker->unique()->randomNumber(6),
            'evento_id' => function () {
                return Evento::factory()->create()->id;
            },
            'dataEmissao' => $this->faker->date,
            'cliente_id' => function () {
                return Cliente::factory()->create()->id;
            },
            'metodoPagamento' => $this->faker->randomElement(['Cartão de Crédito', 'Boleto', 'Transferência']),
            'valorCompra' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}