<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mailer\WelcomeController;
use App\Http\Controllers\Mailer\RecoverController;

/*
|--------------------------------------------------------------------------
| Rotas de E-mail
|--------------------------------------------------------------------------
|
| Aqui são definidas as rotas relacionadas ao envio de e-mails,
| como boas-vindas e redefinição de senha.
|
*/

Route::middleware(['web'])->group(function () {
    // Enviar e-mail de boas-vindas
    Route::post('/usuario/enviar-boas-vindas/{id}', [WelcomeController::class, 'enviarBoasVindas'])
        ->whereUuid('id')
        ->name('usuario.enviar.email.boas.vindas');

    // Enviar e-mail de redefinição de senha
    Route::post('/usuario/enviar-email-redefinicao/{id}', [RecoverController::class, 'enviarEmailRedefinicao'])
        ->whereUuid('id')
        ->name('usuario.enviar.email.redefinicao');
});
