<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sexo = ['M','F'];
        return [
            'nomeCliente' => "" . $this->faker->word . " " . $this->faker->numberBetween($int1 = 0, $int2 = 99999),
            'idade' => $this->faker->numberBetween($int = 0, $int2 = 99999),
            'sexo' => $sexo[$this->faker->numberBetween($int = 0, $int2 = 1)],
            'rgIE' => "" . $this->faker->word . " " . $this->faker->numberBetween($int1 = 0, $int2 = 99999),
            'cpfCNPJ' => "" . $this->faker->word . " " . $this->faker->numberBetween($int1 = 0, $int2 = 99999),
            'email' => "" . $this->faker->email(),
            'telefone' => "" . $this->faker->word . " " . $this->faker->numberBetween($int1 = 0, $int2 = 99999),
        ];
    }
}
