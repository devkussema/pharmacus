<?php
// Script de teste para enviar email utilizando as configurações do Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Bootstrapping the application kernel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

try {
    Mail::raw('Teste Mailpit from script', function ($m) {
        $m->to(env('APP_MAIL'))->subject('Teste Mailpit');
    });
    echo "Mail enviado (verifique o Mailpit)\n";
} catch (Throwable $e) {
    echo "Erro ao enviar mail: " . $e->getMessage() . "\n";
}
