<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class MigrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Chama o comando de backup
            Artisan::call('migrate');

            echo ('Migrate realizado com sucesso!');
        } catch (\Exception $e) {
            echo ('Erro ao realizar o Migrate: ' . $e->getMessage());
        }
    }
}
