<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\ArrayInput;

class HelpAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'help:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simula a execução do comando php artisan help all';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Criar uma instância de Output
        $output = new ConsoleOutput();

        // Criar o input para o comando 'php artisan list' (simulando a execução de help all)
        $input = new ArrayInput(['command' => 'list']);

        // Executar o comando 'php artisan list' (comando que lista todos os comandos)
        $this->getApplication()->run($input, $output);
    }
}
