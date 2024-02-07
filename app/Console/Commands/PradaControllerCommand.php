<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PradaControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prada:controller {nome}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um controller na pasta App/Prada';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nomeController = $this->argument('nome');

        $nomeArquivo = ucfirst($nomeController) . 'Controller.php';

        $caminho = app_path('Prada/Controllers/' . $nomeArquivo);

        if (file_exists($caminho)) {
            $this->error('O controller ' . $nomeController . ' já existe.');
            return;
        }

        // Crie o conteúdo do arquivo do controller
        $conteudo = "<?php\n\nnamespace App\Prada\Controllers;\n\nuse App\Http\Controllers\Controller;\n\nclass " . ucfirst($nomeController) . "Controller extends Controller\n{\n    // Adicione suas funções aqui\n}\n";

        // Crie o arquivo do controller
        file_put_contents($caminho, $conteudo);

        $this->info('O controller ' . $nomeController . ' foi criado com sucesso.');
    }
}
