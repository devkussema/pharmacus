<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\ProdutoEstoque;

class PostProdutoToEstoque extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:produto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera um produto e envia via POST para a rota estoque.store';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $produto = ProdutoEstoque::factory()->make()->toArray();

        // Obter o token CSRF
        $csrfToken = csrf_token();

        // URL explícita ou método route correto
        $url = "http://pharmacus.me/estoque/adder"; // Certifique-se de que a rota está correta

        // Incluir o token CSRF no cabeçalho da requisição
        $response = Http::withHeaders([
            'X-CSRF-TOKEN' => $csrfToken,
        ])->post($url, $produto);

        if ($response->successful()) {
            $this->info('Produto enviado com sucesso!');
        } else {
            $this->error('Falha ao enviar o produto.');
            $this->error($response->body());
        }

        return 0;
    }
}
