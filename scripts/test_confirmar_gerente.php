<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmarGerente;

try {
    $nome = 'Teste Gerente';
    $url = 'http://localhost/confirmar/exemplo';
    $passwd = '123456';
    Mail::to(env('APP_MAIL'))->send(new ConfirmarGerente($nome, $url, $passwd));
    echo "Mailable enviado\n";
} catch (Throwable $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
