<?php

/**
 * Rotas de API do Sistema Pharmacus
 *
 * @author Augusto Kussema
 * @date 2024-01-15
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\ProdutoApiController;
use App\Prada\Controllers\{EstoqueController, AreaHospitalarController, FarmaciaController, UsuarioController, AuthController as PradaAuthController};
use App\Http\Controllers\ProductHistoryController;
use App\Prada\Controllers\StockController as PradaStockController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// APIs v1 com Sanctum
Route::prefix('')->namespace('App\Http\Controllers\Api\v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/get/users', 'GetUserController@getAllUsers');
        Route::get('/get/user/{id}', 'GetUserController@getUserWithId');
        Route::get('/isLogged', 'AuthController@isLogged');
        Route::get('/get/atividade', 'GetAtividadeController@getAllAtividade');
        Route::post('/logout', 'AuthController@logout');
    });

    Route::post('/login', 'AuthController@entrar');
});

// APIs principais do sistema
    // APIs de produtos e estoque
    Route::get('/produtos/{id}', [EstoqueController::class, 'apiEstoque']);
    Route::get('/product-history/{id}', [ProductHistoryController::class, 'index']);
    Route::delete('/produtos_/{id}', [EstoqueController::class, 'destroy']);

    // Status de produtos
    Route::get('/status_produto/{id}', [PradaStockController::class, 'status_produto']);
    Route::post('/status_produto/update/{id}', [PradaStockController::class, 'update_status_produto']);

    // APIs de áreas hospitalares
    Route::get('/get/area_hospitalar', [AreaHospitalarController::class, 'getAll']);
    Route::get('/get/areas_hospitalares/def/{id}', [AreaHospitalarController::class, 'getAllMy']);
    Route::get('/get/area_hospitalar/{id}', [AreaHospitalarController::class, 'getInfo']);

    // APIs de farmácias
    Route::get('/get/farmacia', [FarmaciaController::class, 'getAll']);
    Route::get('/get/farmacia/{id}', [FarmaciaController::class, 'getInfo']);

    // APIs de usuários
    Route::get('/get/usuario/{id}', [UsuarioController::class, 'getUser'])->name('user.get');

    // APIs de pedidos
    Route::get('/get/pedidos', function () {
        $confirmacoes = \App\Models\PedidoItem::where('area_para', session('id_area_'))
            ->where('confirmado', 0)
            ->get();

        return $confirmacoes->count() > 0 ? $confirmacoes->count() : 0;
    });

    // APIs de áreas hospitalares (JSON)
    Route::get("/get/areas", function () {
        $AllAreas = \App\Models\FarmaciaAreaHospitalar::all();
        return response()->json(['data' => $AllAreas], 200);
    });

    // APIs de sessão e autenticação
    Route::get('/check-session', [PradaAuthController::class, 'checkSession']);
    Route::get('/check-session-expiration', [PradaAuthController::class, 'checkSessionExpiration']);
    Route::get('/check-user-status', [PradaAuthController::class, 'checkUserStatus']);
// fim APIs principais do sistema

// API de alertas (requer autenticação)
Route::prefix('alertas')->middleware('auth')->group(function () {
    Route::get('/obter', function () {
        $farmacia_id = @auth()->user()->isFarmacia->farmacia_id;
        $isArea = @auth()->user()->area_hospitalar->area_hospitalar_id;

        if ($farmacia_id) {
            $allAreaIds = \App\Models\FarmaciaAreaHospitalar::where('farmacia_id', @$farmacia_id)->pluck('area_hospitalar_id');
            $pedidos = \App\Models\PedidoItem::whereIn('area_para', $allAreaIds)
                ->where('confirmado', 0)->with('user_de', 'item')->get();
            return $pedidos;
        } elseif ($isArea) {
            $pedidos = \App\Models\PedidoItem::where('area_para', $isArea)
                ->where('confirmado', 0)->with('user_de', 'item')->get();
            return $pedidos;
        }
    });
});

// Compatibilidade com APIs antigas
Route::get('/produtos/{area_id}', [ProdutoApiController::class, 'listarPorArea']);

// APIs de fornecedores
Route::prefix('fornecedores')->group(function () {
    Route::get('/', [\App\Prada\Controllers\FornecedorController::class, 'listar']);
    Route::post('/', [\App\Prada\Controllers\FornecedorController::class, 'store']);
    Route::get('/{id}', [\App\Prada\Controllers\FornecedorController::class, 'show']);
    Route::put('/{id}', [\App\Prada\Controllers\FornecedorController::class, 'update']);
    Route::delete('/{id}', [\App\Prada\Controllers\FornecedorController::class, 'destroy']);
});
