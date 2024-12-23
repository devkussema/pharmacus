<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClearTablesSeeder extends Seeder
{
    /**
     * Lista das tabelas a serem limpas
     *
     * @var array
     */
    protected $tables = [
        'estoques', 'confirmar_baixas',
        'pedido_itens', 'produto_estoques', 'relatorio_estoque_alerta',
        'saldo_estoques',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Desabilitar a verificação de chave estrangeira
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Loop através das tabelas e limpando cada uma
        foreach ($this->tables as $table) {
            try {
                // Limpa a tabela
                DB::table($table)->truncate();
                echo ("Tabela '$table' limpa com sucesso.\n");
            } catch (\Exception $e) {
                echo ("Erro ao limpar a tabela '$table': " . $e->getMessage());
            }
        }

        // Reabilitar a verificação de chave estrangeira
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        echo  "Tabelas limpas com sucesso.";
    }
}
