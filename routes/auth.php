<?php

/**
 * Rotas de Autenticação e Autorização
 * 
 * @author Augusto Kussema
 * @date 2024-01-15
 */

use Illuminate\Support\Facades\Route;
use App\Prada\Controllers\{AuthController, ConfirmarController, AutenticarUserController, GerenteFarmaciaController};

Route::prefix('auth')->middleware('guest')->group(function () {
    // Autenticação básica
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('entrar');
    Route::get('/registar', [AuthController::class, 'registar'])->name('registar');
    Route::post('/registar', [AuthController::class, 'store'])->name('registar.store');
    Route::get('/conta_criada', [AuthController::class, 'conta_criada'])->name('conta_criada');

    // Recuperação de senha
    Route::prefix('recuperar_senha')->group(function () {
        Route::get('', [AuthController::class, 'recuperarSenha'])->name('recuperar_senha');
        Route::post('', [AuthController::class, 'alterar_senha'])->name('alterar_senha');
        Route::get('password_reset', [AuthController::class, 'password_reset'])->name('password.reset');
        Route::get('password_reset?token={token}&email={email}', [AuthController::class, 'password_reset'])->name('password.reset.link');
        Route::post('password_reset', [AuthController::class, 'post_password_reset'])->name('post.password.reset');
    });

    // Confirmação de email
    Route::prefix('confirmar')->group(function () {
        Route::get('/email/{token}', [AuthController::class, 'confirmar_email'])->name('auth.confirmar_email');
        Route::post('/email', [AuthController::class, 'confirmar_email_store'])->name('auth.confirmar_email_store');
        Route::get('/{token}', [ConfirmarController::class, 'funcionario'])->name('confirmar.funcionario');
        Route::post('/', [ConfirmarController::class, 'concluir'])->name('confirmar.funcionario.concluir');
    });

    // Autenticação de gestores
    Route::prefix('autenticar')->group(function () {
        Route::post('/usuario', [AutenticarUserController::class, 'gerenteFarmacia'])->name('autenticar.gerenteFarmacia');
    });

    Route::prefix('gestor')->group(function () {
        Route::get('/confirmar/conta/{token}', [GerenteFarmaciaController::class, 'confirmar'])->name('gestor.token');
    });
});

// Logout (disponível apenas para usuários autenticados)
Route::middleware('auth')->post('/logout', function () {
    if (auth()->check()) {
        // Registrar evento de logout
        try {
            \App\Models\UserAuthLog::create([
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'action' => 'logout',
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            // Falha ao gravar log: não bloquear logout
        }
        \Illuminate\Support\Facades\Auth::logout();
    }
    return redirect()->route('login');
})->name('logout');