<?php

use Illuminate\Support\Facades\Route;
use Modules\Diretor\Http\Controllers\HomeController;
use Modules\Diretor\Http\Controllers\EstoqueController;
use Modules\Diretor\Http\Controllers\FornecedoresController;
use Modules\Diretor\Http\Controllers\RegistroAtividadesController;
use Modules\Diretor\Http\Controllers\EquipeController;
use Modules\Diretor\Http\Controllers\DispensacoesController;
use Modules\Diretor\Http\Controllers\AlertasController;
use Modules\Diretor\Http\Controllers\PerfilController;
use Modules\Diretor\Http\Controllers\ConfiguracoesController;
use Modules\Diretor\Http\Controllers\AjudaController;

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
    Route::get('/registro-atividades', [RegistroAtividadesController::class, 'index'])->name('registro-atividades.index');
    Route::get('/registro-atividades/{id}', [RegistroAtividadesController::class, 'show'])->name('registro-atividades.show');
    
    // Gestão de Equipe
    Route::get('/equipe', [EquipeController::class, 'index'])->name('equipe.index');
    Route::get('/equipe/{id}', [EquipeController::class, 'show'])->name('equipe.show');
    
    // Dispensações
    Route::get('/dispensacoes', [DispensacoesController::class, 'index'])->name('dispensacoes.index');
    Route::get('/dispensacoes/{id}', [DispensacoesController::class, 'show'])->name('dispensacoes.show');
    
    // Alertas Críticos
    Route::get('/alertas', [AlertasController::class, 'index'])->name('alertas.index');
    Route::get('/alertas/{id}', [AlertasController::class, 'show'])->name('alertas.show');
    
    // Perfil
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
    
    // Configurações
    Route::get('/configuracoes', [ConfiguracoesController::class, 'index'])->name('configuracoes');
    Route::post('/configuracoes', [ConfiguracoesController::class, 'store'])->name('configuracoes.store');
    
    // Ajuda
    Route::get('/ajuda', [AjudaController::class, 'index'])->name('ajuda');
});
