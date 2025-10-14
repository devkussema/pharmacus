<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:db {--path=storage/backups}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um dump do banco de dados usando as credenciais do .env e guarda em storage/backups';

    public function handle(): int
    {
        $connection = Config::get('database.default');
        $config = Config::get("database.connections.{$connection}");

        if ($config['driver'] !== 'mysql') {
            $this->error('Backup por mysqldump suportado apenas para MySQL');
            return self::FAILURE;
        }

        $host = $config['host'] ?? '127.0.0.1';
        $port = $config['port'] ?? '3306';
        $database = $config['database'] ?? env('DB_DATABASE');
        $username = $config['username'] ?? env('DB_USERNAME');
        $password = $config['password'] ?? env('DB_PASSWORD');

        $path = $this->option('path') ?? 'storage/backups';
        if (!is_dir(base_path($path))) {
            mkdir(base_path($path), 0755, true);
        }

        $timestamp = date('Ymd_His');
        $filename = "{$path}/backup_{$database}_{$timestamp}.sql.gz";

        // Construir command seguro. Se password estiver vazio, omitimos -p
        $passwordPart = ($password !== null && $password !== '') ? "-p'" . addslashes($password) . "'" : '';

        $cmd = "mysqldump -h {$host} -P {$port} -u {$username} {$passwordPart} {$database} | gzip > " . base_path($filename);

        $this->info('Executando backup do DB para: ' . $filename);

        $output = null;
        $returnVar = null;
        exec($cmd, $output, $returnVar);

        if ($returnVar !== 0) {
            $this->error('Erro ao executar mysqldump. Código: ' . $returnVar);
            return self::FAILURE;
        }

        $this->info('Backup criado com sucesso: ' . $filename);
        return self::SUCCESS;
    }
}
