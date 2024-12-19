<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clear-tables {--confirm}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpa os dados de várias tabelas no banco de dados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Lista das tabelas a serem limpadas
        $tables = [
            'estoques', 'confirmar_baixas',
            'pedido_itens', 'produto_estoques', 'relatorio_estoque_alerta',
            'saldo_estoques',
        ];

        $confirm = $this->option('confirm');

        // Pergunta de confirmação
        if (!$this->confirm('Tem certeza de que deseja limpar os dados das tabelas: ' . implode(', ', $tables) . '?')) {
            $this->info('Operação cancelada.');
            return; // Sai do comando se o usuário não confirmar
        }

        // Loop através das tabelas e limpando cada uma
        foreach ($tables as $table) {
            try {
                // Desabilita a verificação de chave estrangeira
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');

                // Limpa a tabela
                DB::table($table)->truncate();

                // Reabilita a verificação de chave estrangeira
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                $this->info("Tabela '$table' limpa com sucesso.");
            } catch (\Exception $e) {
                $this->error("Erro ao limpar a tabela '$table': " . $e->getMessage());
            }
        }
    }
}
