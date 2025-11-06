<?php

use Illuminate\Support\Facades\Route;
use Modules\Diretor\Http\Controllers\HomeController;
use Modules\Diretor\Http\Controllers\EstoqueController;
use Modules\Diretor\Http\Controllers\FornecedoresController;
use Modules\Diretor\Http\Controllers\AtividadesController;
use Modules\Diretor\Http\Controllers\FuncionariosController;

Route::prefix('diretor')->name('diretor.')->group(function () {
    // Dashboard principal
    Route::get('/', [HomeController::class, 'index'])->name('index');
    
    // Gestão de Estoque (medicamentos)
    Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');
    Route::get('/estoque/{id}', [EstoqueController::class, 'show'])->name('estoque.show');
    
    // Gestão de Fornecedores
    Route::get('/fornecedores', [FornecedoresController::class, 'index'])->name('fornecedores.index');
    Route::get('/fornecedores/{id}', [FornecedoresController::class, 'show'])->name('fornecedores.show');
    
    // Registro de Atividades (dispensações, movimentações, logs)
    Route::get('/atividades', [AtividadesController::class, 'index'])->name('atividades.index');
    Route::get('/atividades/{id}', [AtividadesController::class, 'show'])->name('atividades.show');
    
    // Gestão de Funcionários
    Route::get('/funcionarios', [FuncionariosController::class, 'index'])->name('funcionarios.index');
    Route::get('/funcionarios/{id}', [FuncionariosController::class, 'show'])->name('funcionarios.show');
});
