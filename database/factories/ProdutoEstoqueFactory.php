<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Farmacia;
use App\Models\GrupoFarmacologico;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProdutoEstoque>
 */
class ProdutoEstoqueFactory extends Factory
{
    protected $model = \App\Models\ProdutoEstoque::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'designacao' => $this->faker->word,
            'dosagem' => $this->faker->randomNumber(2),
            'forma' => $this->faker->word,
            'tipo' => 'medicamento',
            // procura um registro existente ou cria um novo via factory quando ausente
            'farmacia_id' => Farmacia::inRandomOrder()->first()?->id ?? Farmacia::factory()->create()->id,
            'caixa' => $this->faker->randomNumber(2),
            'caxinha' => $this->faker->randomNumber(2),
            'unidade' => $this->faker->randomNumber(2),
            'qtd_total' => $this->faker->randomNumber(3),
            'origem_destino' => $this->faker->city,
            'num_lote' => $this->faker->randomNumber(5),
            'data_producao' => $this->faker->date('Y-m-d', 'now'),
            'data_expiracao' => $this->faker->date('Y-m-d', 'now + 5 years'),
            'data_recepcao' => $this->faker->date('Y-m-d', 'now'),
            'num_documento' => $this->faker->randomNumber(8),
            'qtd_embalagem' => $this->faker->randomNumber(2),
            'grupo_farmaco_id' => GrupoFarmacologico::inRandomOrder()->first()?->id ?? GrupoFarmacologico::factory()->create()->id,
            'obs' => $this->faker->sentence,
            'qtd' => $this->faker->randomNumber(3),
        ];
    }
}
