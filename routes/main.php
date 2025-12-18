<?php

/**
 * Rotas do Sistema Principal (Dashboard, Estoque, Relatórios)
 *
 * @author Augusto Kussema
 * @date 2024-01-15
 */

use Illuminate\Support\Facades\Route;
use App\Prada\Controllers\{
    HomeController,
    EstoqueController,
    AlertController,
    GetterController,
    FuncionarioController,
    AtividadeController,
    FornecedorController,
    NivelAlertaController,
    StockController
};
use App\Http\Controllers\{
    PedidoController,
    Stock\Dashboard as DashStock,
    Dev\VisitanteController,
    Dev\DevController
};

Route::middleware(['auth', 'is.status', 'is.online'])->group(function () {

    // Dashboard e páginas principais
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/main', [HomeController::class, 'home'])->name('main');
    Route::get('/produtos', [HomeController::class, 'produto'])->name('produto');
    Route::get('/categorias', [HomeController::class, 'categoria'])->name('categoria');

    // Dashboard de estoque
    Route::prefix('stock')->group(function () {
        Route::get('/dashboard', [DashStock::class, 'index'])->name('stock.dashboard');
    });

    // Rotas de fornecedores
    Route::prefix('fornecedores')->group(function () {
        Route::get('/', [FornecedorController::class, 'index'])->name('fornecedores');
    });

    // APIs de fornecedores (dentro do grupo autenticado)
    Route::prefix('api/fornecedores')->group(function () {
        Route::get('/', [FornecedorController::class, 'listar']);
        Route::post('/', [FornecedorController::class, 'store']);
        Route::get('/{id}/historico', [FornecedorController::class, 'historico']);
        Route::get('/{id}', [FornecedorController::class, 'show']);
        Route::put('/{id}', [FornecedorController::class, 'update']);
        Route::delete('/{id}', [FornecedorController::class, 'destroy']);
    });

    // APIs de áreas hospitalares (dentro do grupo autenticado)
    Route::prefix('api')->group(function () {
        Route::get('/get/areas_hospitalares/def/{id}', [\App\Prada\Controllers\AreaHospitalarController::class, 'getAllMy']);
        Route::get('/produtos/{area_id}', [\App\Http\Controllers\Api\ProdutoApiController::class, 'listarPorArea']);
    });

    // Gestão de estoque
    Route::post('estoque/adder', [EstoqueController::class, 'store'])->name('estoque.storer');

    Route::prefix('estoque')->middleware('is.area_hospitalar')->group(function () {
        Route::get('/', [EstoqueController::class, 'index'])->name('estoque');
        Route::get('/editar/{id}/{returnID}', [EstoqueController::class, 'edit'])->name('estoque.editar');
        Route::post('/editar/{id}/{returnID}', [EstoqueController::class, 'update'])->name('estoque.update');
        Route::get('/home', [EstoqueController::class, 'getListHome'])->name('estoque.gerente');
        Route::get('/solicitar/{id}', [EstoqueController::class, 'solicitar'])->name('estoque.solicitar');

        // Estoque mínimo
        Route::get('/add-estoque-minimo/{id}', [StockController::class, 'add_estoque_minimo'])->name('estoque._minimo');
        Route::post('/add-estoque-minimo/{id}', [StockController::class, 'store_stock'])->name('estoque._store_stock');
        Route::get('/estoque/filtro', [StockController::class, 'filtrarEstoque'])->name('estoque.filtrar');

        // Operações de estoque
        Route::get('/ver/{id}', [EstoqueController::class, 'getEstoque'])->name('estoque.getEstoque');
        Route::get('obter/{id}', [EstoqueController::class, 'myEstoque'])->name('estoque.myEstoque');
        Route::get('/produto/{id}', [EstoqueController::class, 'getProduto']);
        Route::put('/produto/{id}', [EstoqueController::class, 'editarProduto']);
        Route::get('/produto/{id}/detalhes', [EstoqueController::class, 'getDetalhes'])->name('estoque.detalhes');
        Route::get('estoque/ajax', [EstoqueController::class, 'ajaxEstoque'])->name('estoque.ajax');
        Route::get('/adicionar/{area_id}', [EstoqueController::class, 'cadastrar'])->name('estoque.cadastrar');
        Route::post('/', [EstoqueController::class, 'store'])->name('estoque.store');

        // AJAX para adicionar unidades/caixas a produto existente via descritivo
        Route::post('/adicionar', [EstoqueController::class, 'adicionar'])->name('estoque.adicionar');
        Route::post('/sincronizar', [EstoqueController::class, 'sincronizar'])->name('estoque.sincronizar');
        Route::post('/sincronizar-todos', [EstoqueController::class, 'sincronizarTodos'])->name('estoque.sincronizarTodos');
        Route::post('/baixa', [EstoqueController::class, 'baixa'])->name('estoque.baixa');
        Route::post('/dar_baixa/{area_de}', [EstoqueController::class, 'dar_baixa'])->name('estoque.dar_baixa');
        Route::post('/baixa', [EstoqueController::class, 'baixa'])->name('estoque.baixa');
        Route::get('/relatorio', [EstoqueController::class, 'calcularNivelAlerta'])->name('estoque.relatorio');

        // Confirmação de produtos
        Route::prefix('confirmar')->group(function () {
            Route::get('/{id_produto}/{id_area}', [EstoqueController::class, 'confirmarProduto'])->name('estoque.confirmar');
        });
    });

    // Pedidos
    Route::prefix('pedidos')->group(function () {
        Route::get('/', [PedidoController::class, 'index'])->name('pedido');
        Route::get('/atender/{id}', [PedidoController::class, 'atender'])->name('pedido.atender');
        Route::post('/atender/{id}', [PedidoController::class, 'storeAtender'])->name('pedido.storeAtender');
        Route::get('/info/{id}', [PedidoController::class, 'getPE'])->name('pedido.info');
    });

    // Alertas
    Route::prefix('alertas')->group(function () {
        Route::get('/', [AlertController::class, 'index'])->name('alert.show');
    });

    // Notificações
    Route::prefix('getter')->group(function () {
        Route::get('/notificacao/{id_para}', [GetterController::class, 'getNoficacoes'])->name('getter.notificacao');
    });

    // Funcionários
    Route::prefix('funcionarios')->group(function () {
        Route::get('/', [FuncionarioController::class, 'index'])->name('funcionarios');
    });

    // Atividades
    Route::prefix('atividades')->group(function () {
        Route::get('/', [AtividadeController::class, 'index'])->name('atividade.show');
        Route::get('/json', [\App\Prada\Controllers\AtividadeApiController::class, 'indexJson']);
        Route::get('/json/{id}', [\App\Prada\Controllers\AtividadeApiController::class, 'showJson']);
    });

    // Relatórios
    Route::prefix('relatorio')->group(function () {
        Route::get('/', [NivelAlertaController::class, 'index'])->name('nivel_alerta');
        Route::get('/gerar_relatorio', [NivelAlertaController::class, 'gerarRelatorio'])->name('gerar_relatorio');
        Route::post('/gerar_relatorio', [NivelAlertaController::class, 'gerarRelatorioPost'])->name('gerar_relatorio.post');
    });

    // Desenvolvimento
    Route::prefix('dev')->group(function () {
        Route::get('/levantamento', [DevController::class, 'levantamento'])->name('dev.levantamento');
        Route::get('/novo_doc', [DevController::class, 'novo_doc'])->name('dev.novo_doc');
        Route::get('/listaEstoque', [DevController::class, 'getFichaControloLimite']);
        Route::get('/listaEstoque/{area}', [DevController::class, 'getFichaControlo'])->name('dev.listaEstoque');
    });

    // Visitantes (Dev)
    Route::prefix('desenvolvedor')->group(function () {
        Route::get('visitantes', [VisitanteController::class, 'index'])->name('dev.visitante');
    });
});
