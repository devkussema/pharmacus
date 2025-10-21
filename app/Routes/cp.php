<?php

/**
 * autor: Augusto Kussema
 * Data: 2025-10-21 12:00 (Luanda)
 * Descrição: Registos de rotas para a área administrativa (painel de controlo) — definições de recurso com nomeação do índice.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;

Route::resource('dashboard', DashboardController::class)->only(['index'])->names(['index' => 'cp.admin.index']);

// Regista o resource 'users' com nomes completos para permitir uso consistente em views
Route::resource('users', UsersController::class)->names([
    'index' => 'cp.users.index',
    'create' => 'cp.users.create',
    'store' => 'cp.users.store',
    'show' => 'cp.users.show',
    'edit' => 'cp.users.edit',
    'update' => 'cp.users.update',
    'destroy' => 'cp.users.destroy',
]);


