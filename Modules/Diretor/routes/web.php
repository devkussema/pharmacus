<?php

use Illuminate\Support\Facades\Route;
use Modules\Diretor\Http\Controllers\HomeController;
use Modules\Diretor\Http\Controllers\EstoqueController;
use Modules\Diretor\Http\Controllers\FornecedoresController;

Route::prefix('diretor')->name('diretor.')->group(function () {
    // Dashboard principal
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/create', [HomeController::class, 'create'])->name('create');
    Route::post('/', [HomeController::class, 'store'])->name('store');
    Route::get('/{id}', [HomeController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [HomeController::class, 'edit'])->name('edit');
    Route::put('/{id}', [HomeController::class, 'update'])->name('update');
    Route::delete('/{id}', [HomeController::class, 'destroy'])->name('destroy');
    
    // Gestão de Estoque
    Route::resource('estoque', EstoqueController::class);
    
    // Gestão de Fornecedores
    Route::resource('fornecedores', FornecedoresController::class);
});
