<?php

use Illuminate\Support\Facades\Route;

use App\Prada\Controllers\HomeController;
use App\Prada\Controllers\AuthController;
use App\Prada\Controllers\FarmaciaController;
use App\Prada\Controllers\CategoriaController;
use App\Prada\Controllers\GerenteFarmaciaController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/main', [HomeController::class, 'home'])->name('main');
    Route::get('/produtos', [HomeController::class, 'produto'])->name('produto');
    Route::get('/categorias', [HomeController::class, 'categoria'])->name('categoria');

    Route::prefix('categoria')->group(function () {
        Route::post('/', [CategoriaController::class, 'store'])->name('categoria.store');
    });

    Route::prefix('gestor')->group(function () {
        Route::post('/', [GerenteFarmaciaController::class, 'store'])->name('gestor.store');
        Route::get('/confirmar/conta/{token}', [GerenteFarmaciaController::class, 'confirmar'])->name('gestor.token');
    });

    Route::prefix('farmacia')->group(function () {
        Route::get('/', [FarmaciaController::class, 'index'])->name('farmacia');

        // Rota para exibir o formulário de criação de farmácia
        Route::get('/create', [FarmaciaController::class, 'create'])->name('farmacia.create');
    
        // Rota para processar o formulário de criação de farmácia
        Route::post('/store', [FarmaciaController::class, 'store'])->name('farmacia.store');
    
        // Rota para exibir detalhes da farmácia
        Route::get('/{farmacia}', [FarmaciaController::class, 'show'])->name('farmacia.show');
    
        // Rota para exibir o formulário de edição de farmácia
        Route::get('/{farmacia}/edit', [FarmaciaController::class, 'edit'])->name('farmacia.edit');
        
        Route::get('/get/{id}', [FarmaciaController::class, 'get'])->name('farmacia.get');
    
        // Rota para processar o formulário de edição de farmácia
        Route::post('/farmacia', [FarmaciaController::class, 'update'])->name('farmacia.update');
    
        // Rota para excluir a farmácia
        Route::delete('/{farmacia}', [FarmaciaController::class, 'destroy'])->name('farmacia.destroy');
    });

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/'); // Redireciona para a página inicial após o logout
    })->name('logout');
});

Route::prefix('auth')->middleware('guest')->group(function () {
    Route::prefix('')->group(function () {
        Route::get('/confirmar/conta/{token}', [GerenteFarmaciaController::class, 'confirmar'])->name('gestor.token');
    });

    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('entrar');
    Route::get('/registar', [AuthController::class, 'registar'])->name('registar');
    Route::post('/registar', [AuthController::class, 'store'])->name('registar.store');
});

Route::prefix('api')->group(function () {
    Route::get('/check-session', [AuthController::class, 'checkSession']);
    Route::get('/check-session-expiration', [AuthController::class, 'checkSessionExpiration']);
    Route::get('/check-user-status', [AuthController::class, 'checkUserStatus']);
});
