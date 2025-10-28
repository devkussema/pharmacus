<?php

/**
 * autor: Augusto Kussema
 * Data: 2025-10-21 12:00 (Luanda)
 * Descrição: Registos de rotas para a área administrativa (painel de controlo) — definições de recurso com nomeação do índice.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UsersPermissionsController;
use App\Http\Controllers\Admin\AreaHospitalar;

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

// Rotas para editar permissões de um utilizador (visualizar/actualizar)
Route::get('users/{user}/permissions', [UsersPermissionsController::class, 'edit'])->name('cp.users.permissions.edit');
Route::put('users/{user}/permissions', [UsersPermissionsController::class, 'update'])->name('cp.users.permissions.update');

Route::resource('area_hospitalar', AreaHospitalar::class)->names([
    'index' => 'cp.area_hospitalar.index',
    'create' => 'cp.area_hospitalar.create',
    'store' => 'cp.area_hospitalar.store',
    'show' => 'cp.area_hospitalar.show',
    'edit' => 'cp.area_hospitalar.edit',
    'update' => 'cp.area_hospitalar.update',
    'destroy' => 'cp.area_hospitalar.destroy',
]);
