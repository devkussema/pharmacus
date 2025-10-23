<?php

/**
 * Rotas de Preview e Landing Page
 * 
 * @author Augusto Kussema
 * @date 2024-01-15
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PreviewController, LandingPage\HomeController as LPHomeController};

// Landing Page
Route::prefix('landingpager')->group(function () {
    Route::get('/', [LPHomeController::class, 'index'])->name('lp.home');
    Route::get('/blog-single', [LPHomeController::class, 'blog_single'])->name('lp.blog_single');
});

// Preview
Route::prefix('preview')->group(function () {
    Route::prefix('v3')->group(function () {
        Route::get('/recuperar-senha', [PreviewController::class, 'recuperarSenha'])->name('preview.recuperar_senha');
        Route::get('/', [PreviewController::class, 'index'])->name('preview.index');
        Route::get('/login', [PreviewController::class, 'login'])->name('preview.login');
        Route::get('/registar', [PreviewController::class, 'registar'])->name('preview.registar');
        Route::get('/redefinir-senha/sucesso', [PreviewController::class, 'resetSenhaSuccess'])->name('preview.reset_senha_success');
        Route::get('/redefinir-senha', [PreviewController::class, 'resetSenhaForm'])->name('preview.reset_senha');
    });
});