<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PreviewController;
// O prefixo 'preview' e o nome 'preview.' já são aplicados pelo RouteServiceProvider

Route::prefix('dashboard')->group(function () { // URL base será /preview/v3
    // Rota para as páginas do dashboard. Ex: /preview/v3/ ou /preview/v3/settings
    Route::get('/{page?}', [PreviewController::class, 'dashboardPage'])
        ->name('dashboard.page') // Nome da rota: preview.dashboard.page
        ->where('page', '[a-zA-Z0-9_-]+'); // Restringe caracteres permitidos para o nome da página
});
