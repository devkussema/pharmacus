<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CleanDbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenha todas as tabelas no banco de dados, exceto a tabela de migrações
        $tables = DB::select('SHOW TABLES');
        $migrationsTable = 'migrations';

        foreach ($tables as $table) {
            $tableName = reset($table);

            if ($tableName !== $migrationsTable) {
                // Desativa temporariamente a verificação de chaves estrangeiras para permitir a exclusão
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                // Limpa a tabela
                DB::table($tableName)->truncate();
                // Restaura a verificação de chaves estrangeiras
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
            }
        }
    }
}
