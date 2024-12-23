<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Backup\BackupServiceProvider;
use Illuminate\Support\Facades\Artisan;

class BackupDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Chama o comando de backup
            Artisan::call('backup:run');

            echo ('Backup realizado com sucesso!');
        } catch (\Exception $e) {
            echo ('Erro ao realizar o backup: ' . $e->getMessage());
        }
    }
}
