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
            ['nome' => 'Critico', 'regra' => '3M'],
            ['nome' => 'Minimo', 'regra' => '6M'],
            ['nome' => 'Médio', 'regra' => '10M'],
            ['nome' => 'Máximo', 'regra' => '12M']
        ];

        // Itera sobre os níveis e os cadastra no banco de dados
        foreach ($niveis as $nivel) {
            NivelAlerta::create($nivel);
        }
    }
}
