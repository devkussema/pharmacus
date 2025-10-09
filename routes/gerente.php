<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gerente\FuncionarioController;

/**
 * Rotas do módulo Gerente.
 *
 * Autor: Augusto Kussema
 * Data de criação: 2025-10-01
 */


Route::name('gerente.')->group(static function (): void {
    // Subrotas para funcionalidades de funcionários
    Route::name('funcionarios.')->prefix('funcionarios')->group(static function (): void {
        Route::get('/', [FuncionarioController::class, 'index'])->name('index');
        Route::get('/filtrar', [FuncionarioController::class, 'filtrar'])->name('filtrar');
        Route::post('/status', [FuncionarioController::class, 'alterarStatus'])->name('status');
        Route::post('/permissoes', [FuncionarioController::class, 'alternarPermissoes'])->name('permissao');
        Route::delete('/{id}', [FuncionarioController::class, 'destroy'])->name('destroy');
    });
});

// Para debug - remover depois
Route::get('/debug-permissoes/{userId?}', function($userId = null) {
    return debugPermissoes($userId);
});
