<?php

/**
 * Rotas de Administração e Gestão
 * 
 * @author Augusto Kussema
 * @date 2024-01-15
 */

use Illuminate\Support\Facades\Route;
use App\Prada\Controllers\{
    PermissoesController,
    UsuarioController,
    AreaHospitalarController,
    FarmaciaController,
    GerenteFarmaciaController,
    ConfigController,
    CargoController,
    CategoriaController,
    DocumentsController,
    PrintController,
    PrateleiraController,
    GrupoFarmacologicoController as GFC
};

Route::middleware(['auth', 'is.status', 'is.online'])->group(function () {
    
    // Gestão de usuários
    Route::prefix('u')->group(function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('usuario');
        Route::put('/', [UsuarioController::class, 'addCargo'])->name('usuario.addCargo');
        Route::get('/editar/{id}', [UsuarioController::class, 'edit'])->name('usuario.editar');
        Route::put('bloquear/{id}', [UsuarioController::class, 'blockUser'])->name('u.bloquear');
        Route::get('desbloquear/{id}', [UsuarioController::class, 'unblockUser'])->name('u.desbloquear');
        Route::get('{username}', [UsuarioController::class, 'perfil'])->name('u.perfil');
        Route::post('alterar-senha', [UsuarioController::class, 'updatePassword'])->name('u.altSenha');
    });

    // Atualização de usuário via modal (AJAX)
    Route::patch('/usuario/{user}', [UsuarioController::class, 'update'])->name('usuario.update');
    Route::get('/usuario/{user}/edit', [UsuarioController::class, 'edit'])->name('usuario.edit');

    // Gestão de áreas hospitalares
    Route::prefix('areas_hospitalares')->group(function () {
        Route::get('', [AreaHospitalarController::class, 'index'])->name('a_h.index');
        Route::post('add/cargo', [AreaHospitalarController::class, 'addCargo'])->name('a_h.addCargo');
        Route::put('/a_h/{id}', [AreaHospitalarController::class, 'update']);
        Route::delete('/apagar/{id}', [AreaHospitalarController::class, 'destroy'])->name('a_h.destroy');
        Route::post('', [AreaHospitalarController::class, 'store'])->name('a_h.index.store');
        Route::post('toggle-status/{id}', [AreaHospitalarController::class, 'toggleStatus'])->name('a_h.toggle_status');
    // Atualizar flag de log de estoque para uma relação farmacia_areas_hospitalares
    Route::post('set-log-estoque/{id}', [AreaHospitalarController::class, 'setLogEstoque'])->name('a_h.set_log_estoque');
        Route::get('/statUs', [AreaHospitalarController::class, 'getStatDia'])->name('a_h.get_stat_dia');
    });

    // Gestão de farmácias
    Route::prefix('farmacia')->group(function () {
        Route::get('/', [FarmaciaController::class, 'index'])->name('farmacia');
        Route::get('/stat', [FarmaciaController::class, 'getStatDia'])->name('farmacia.get_stat_dia');
        Route::get('/create', [FarmaciaController::class, 'create'])->name('farmacia.create');
        Route::post('/store', [FarmaciaController::class, 'store'])->name('farmacia.store');
        Route::get('/{farmacia}', [FarmaciaController::class, 'show'])->name('farmacia.show');
        Route::get('/{farmacia}/edit', [FarmaciaController::class, 'edit'])->name('farmacia.edit');
        Route::get('/get/{id}', [FarmaciaController::class, 'get'])->name('farmacia.get');
        Route::put('/{farmacia}', [FarmaciaController::class, 'update'])->name('farmacia.update');
        Route::delete('/apagar/{farmacia}', [FarmaciaController::class, 'destroy'])->name('farmacia.destroy');
    });

    // Gestão de gestores
    Route::prefix('gestor')->group(function () {
        Route::post('/', [GerenteFarmaciaController::class, 'store'])->name('gestor.store');
    });

    // Gestão de permissões
    Route::prefix('permissoes')->group(function () {
        Route::post('/', [PermissoesController::class, 'store'])->name('permissoes.store');
    });

    // Gestão de cargos
    Route::prefix('cargos')->group(function () {
        Route::post('/', [CargoController::class, 'store'])->name('cargo.store');
    });

    // Gestão de categorias
    Route::prefix('categoria')->group(function () {
        Route::post('/', [CategoriaController::class, 'store'])->name('categoria.store');
    });

    // Gestão de grupos farmacológicos
    Route::prefix('grupos_farmacologicos')->group(function () {
        Route::get('/', [GFC::class, 'index'])->name('grupos_farmacologicos.index');
    });

    // Gestão de prateleiras
    Route::prefix('prateleira')->group(function () {
        Route::get('/', [PrateleiraController::class, 'index'])->name('prateleira.show');
        Route::get('/add', [PrateleiraController::class, 'add'])->name('prateleira.add');
        Route::post('/add', [PrateleiraController::class, 'store'])->name('prateleira.store');
        Route::delete('/delete/{id}', [PrateleiraController::class, 'destroy'])->name('prateleira.destroy');
        Route::post('/toggle-status/{id}', [PrateleiraController::class, 'toggleStatus']);
        Route::get('/get/all', [PrateleiraController::class, 'getPrateleiras'])->name('prateleira.all');
    });

    // Gestão de documentos
    Route::prefix('documentos')->group(function () {
        Route::get('/', [DocumentsController::class, 'index'])->name('documents.index');
        Route::get('/create', [DocumentsController::class, 'create'])->name('documents.create');
        Route::post('/', [DocumentsController::class, 'store'])->name('documents.store');
        Route::get('/{document}', [DocumentsController::class, 'show'])->name('documents.show');
        Route::get('/{document}/download', [DocumentsController::class, 'download'])->name('documents.download');
        Route::get('/{document}/preview', [DocumentsController::class, 'preview'])->name('documents.preview');
        Route::delete('/{document}', [DocumentsController::class, 'destroy'])->name('documents.destroy');
        Route::patch('/{document}/restore', [DocumentsController::class, 'restore'])->name('documents.restore');
        Route::patch('/{document}/archive', [DocumentsController::class, 'archive'])->name('documents.archive');
        Route::get('/api/stats', [DocumentsController::class, 'stats'])->name('documents.stats');
    });

    // Configurações do sistema
    Route::prefix('definicoes')->group(function () {
        Route::get('/site', [ConfigController::class, 'index'])->name('config.site');
        Route::post('/site/set_config', [ConfigController::class, 'set_config'])->name('config.set_config');
    });

    // Impressão e relatórios
    Route::prefix('print')->group(function () {
        Route::get('/estoque', [PrintController::class, 'index'])->name('print.estoque');
        Route::get('/estoque/{estoque_id}', [PrintController::class, 'view'])->name('print.view');
        Route::get('/nivel_alerta', [PrintController::class, 'nivel_alerta'])->name('print.nivel_alerta');
    });
});