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

// Rotas API para AJAX (retornam JSON)
Route::get('/api/users', function () {
	if (class_exists(\App\Models\User::class)) {
		return \App\Models\User::select('id','name','email')->limit(50)->get();
	}

	// fallback mock
	return collect([['id'=>1,'name'=>'Admin','email'=>'admin@example.com'],['id'=>2,'name'=>'João','email'=>'joao@example.com']]);
});

Route::get('/api/products', function () {
	if (class_exists(\App\Models\ProdutoEstoque::class)) {
		return \App\Models\ProdutoEstoque::select('id','designacao','qtd')->limit(50)->get();
	}
	return collect([['id'=>1,'designacao'=>'Paracetamol 500mg','qtd'=>120],['id'=>2,'designacao'=>'Ibuprofeno 200mg','qtd'=>60]]);
});

