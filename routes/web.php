<?php

use Illuminate\Support\Facades\Route;

use App\Prada\Controllers\HomeController;
use App\Prada\Controllers\AuthController;
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

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/'); // Redireciona para a página inicial após o logout
    })->name('logout');
});

Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('entrar');
    Route::get('/registar', [AuthController::class, 'registar'])->name('registar');
    Route::post('/registar', [AuthController::class, 'store'])->name('registar.store');
});
