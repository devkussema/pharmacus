<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MigrateSafe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:safe';
    protected $description = 'Executa todas as migrations e ignora as que falharem';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("🚀 Iniciando migrations seguras...\n");

        // Garante que a tabela migrations exista
        if (!DB::getSchemaBuilder()->hasTable('migrations')) {
            $this->warn("⚠️  A tabela 'migrations' não existe — criando automaticamente...");
            Artisan::call('migrate:install');
        }

        // Busca todas as migrations já executadas
        $executadas = DB::table('migrations')->pluck('migration')->toArray();

        // Lista todos os arquivos da pasta
        $arquivos = File::files(database_path('migrations'));
        $total = count($arquivos);
        $contador = 0;

        foreach ($arquivos as $migration) {
            $contador++;
            $nome = pathinfo($migration->getFilename(), PATHINFO_FILENAME);

            // Ignora se já estiver na tabela migrations
            if (in_array($nome, $executadas)) {
                $this->line("⏭️  [$contador/$total] Ignorada (já aplicada): $nome");
                continue;
            }

            // Tenta rodar a migration
            $this->line("▶️  [$contador/$total] Rodando: $nome");
            try {
                $exitCode = Artisan::call('migrate', [
                    '--path' => 'database/migrations/' . $migration->getFilename(),
                    '--force' => true,
                ]);

                if ($exitCode === 0) {
                    $this->info("✅  Sucesso: $nome");
                } else {
                    $this->error("❌  Falhou (código $exitCode): $nome — ignorando...");
                }
            } catch (\Throwable $e) {
                $this->error("💥 Erro em $nome: " . $e->getMessage());
            }

            $this->newLine();
        }

        $this->info("🎉 Migrations seguras concluídas!");
        return Command::SUCCESS;
    }
}
