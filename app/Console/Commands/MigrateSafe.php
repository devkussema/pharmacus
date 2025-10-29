<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
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
        $migrations = File::files(database_path('migrations'));

        foreach ($migrations as $migration) {
            $path = 'database/migrations/' . $migration->getFilename();

            $this->info("🚀 Rodando: {$migration->getFilename()}");
            $exitCode = Artisan::call('migrate', ['--path' => $path]);

            if ($exitCode !== 0) {
                $this->error("❌ Falhou: {$migration->getFilename()} — ignorando...");
            } else {
                $this->info("✅ Sucesso: {$migration->getFilename()}");
            }
        }

        $this->info('🎉 Migrations concluídas (ignorando falhas).');
    }
}
