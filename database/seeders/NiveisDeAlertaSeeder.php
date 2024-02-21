<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NivelAlerta;

class NiveisDeAlertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $niveis = [
            ['nome' => 'Critico', 'regra' => '3'],
            ['nome' => 'Minimo', 'regra' => '6'],
            ['nome' => 'Médio', 'regra' => '10'],
            ['nome' => 'Máximo', 'regra' => '12']
        ];

        // Itera sobre os níveis e os cadastra no banco de dados
        foreach ($niveis as $nivel) {
            NivelAlerta::create($nivel);
        }
    }
}
