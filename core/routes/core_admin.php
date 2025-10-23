<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoreAdmin\DashboardController;

/**
 * Rotas mínimas do Core Admin (scaffolding para design)
 * - Sem middleware específico por enquanto (apenas para testes de design)
 * - Prefixo: /core_admin
 * - Nome das rotas: core_admin.*
 */

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
Route::get('/users', [DashboardController::class, 'users'])->name('users');
Route::get('/products', [DashboardController::class, 'products'])->name('products');
Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');

// Rotas auxiliares (placeholders)
Route::get('/coming-soon', function () {
	return view()->file(base_path('core/views/admin/coming_soon.blade.php'));
})->name('coming_soon');

