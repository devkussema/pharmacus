<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed das categorias de farmácia
        Categoria::create([
            'nome' => 'Farmácias Hospitalares',
            'tipo' => 'farmacia',
            'descricao' => 'Aquelas que estão localizadas dentro de hospitais e atendem principalmente aos pacientes internados, fornecendo medicamentos prescritos durante a internação e após a alta hospitalar.'
        ]);

        Categoria::create([
            'nome' => 'Farmácias Independentes',
            'tipo' => 'farmacia',
            'descricao' => 'São aquelas que operam de forma independente, não associadas a nenhum hospital ou grande rede. Elas podem ser de propriedade de um farmacêutico individual ou de uma pequena empresa.'
        ]);

        Categoria::create([
            'nome' => 'Farmácias de Rede',
            'tipo' => 'farmacia',
            'descricao' => 'São farmácias que fazem parte de uma rede de estabelecimentos, como grandes cadeias de farmácias. Elas podem ter várias filiais em diferentes localidades e podem oferecer uma ampla variedade de produtos e serviços.'
        ]);

        Categoria::create([
            'nome' => 'Farmácias de Bairro',
            'tipo' => 'farmacia',
            'descricao' => 'São farmácias localizadas em áreas residenciais, geralmente de pequeno porte e que atendem principalmente à comunidade local.'
        ]);

        Categoria::create([
            'nome' => 'Farmácias de Atendimento Especializado',
            'tipo' => 'farmacia',
            'descricao' => 'São aquelas que se especializam em fornecer medicamentos e serviços específicos, como farmácias de manipulação, farmácias de oncologia, entre outras.'
        ]);
    }
}
