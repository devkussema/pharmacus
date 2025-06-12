<?php

use Illuminate\Support\Facades\Route;

use App\Prada\Controllers\HomeController;
use App\Prada\Controllers\AuthController;
use App\Prada\Controllers\FarmaciaController;
use App\Prada\Controllers\CategoriaController;
use App\Prada\Controllers\GerenteFarmaciaController;
use App\Prada\Controllers\AreaHospitalarController;
use Illuminate\Support\Facades\Artisan;
use App\Prada\Controllers\{AlertController,
    PermissoesController,
    GetterController,
    StockController,
    ConfigController,
    AutenticarUserController,
    UsuarioController,
    FuncionarioController,
    CargoController,
    ConfirmarController,
    EstoqueController,
    NivelAlertaController,
    GrupoFarmacologicoController as GFC,
    AtividadeController,
    PrintController,
    PrateleiraControllerController as PratControllers};
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use App\Http\Controllers\{
    PedidoController,
    TerminalController,
};
use App\Http\Controllers\Dev\{
    VisitanteController,
    DevController
};
use App\Http\Controllers\Api\{
    AuthController as ApiAuth
};
use App\Http\Controllers\Stock\{
    Dashboard as DashStock
};
use App\Http\Controllers\LandingPage\{
    HomeController as LPHomeController
};
use App\Http\Controllers\Artisan\CommandController;
use App\Http\Controllers\PreviewController;

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

Route::prefix('landingpager')->group(function () {
    Route::get('/', [LPHomeController::class, 'index'])->name('lp.home');
    Route::get('/blog-single', [LPHomeController::class, 'blog_single'])->name('lp.blog_single');
});

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

Route::post('estoque/adder', [EstoqueController::class, 'store'])->name('estoque.storer');

Route::middleware(['auth', 'is.status', 'is.online'])->group(function () {
    Route::prefix('stock')->group(function () {
        Route::get('/dashboard', [DashStock::class, 'index'])->name('stock.dashboard');
    });

    Route::prefix('dev')->group(function () {
        Route::get('/levantamento', [DevController::class, 'levantamento'])->name('dev.levantamento');
        Route::get('/novo_doc', [DevController::class, 'novo_doc'])->name('dev.novo_doc');
        Route::get('/listaEstoque', [DevController::class, 'getFichaControloLimite']);
        Route::get('/listaEstoque/{area}', [DevController::class, 'getFichaControlo'])->name('dev.listaEstoque');
    });

    Route::prefix('prateleira')->group(function () {
        Route::get('/', [PratControllers::class, 'index'])->name('prateleira.show');
        Route::get('/add', [PratControllers::class, 'add'])->name('prateleira.add');

        Route::post('/add', [PratControllers::class, 'store'])->name('prateleira.store');
        Route::delete('/delete/{id}', [PratControllers::class, 'destroy'])->name('prateleira.destroy');
        Route::post('/toggle-status/{id}', [PratControllers::class, 'toggleStatus']);

        Route::get('/get/all', [PratControllers::class, 'getPrateleiras'])->name('prateleira.all');
    });

    Route::prefix('pedidos')->group(function () {
        Route::get('/', [PedidoController::class, 'index'])->name('pedido');
        Route::get('/atender/{id}', [PedidoController::class, 'atender'])->name('pedido.atender');
        Route::post('/atender/{id}', [PedidoController::class, 'storeAtender'])->name('pedido.storeAtender');
        Route::get('/info/{id}', [PedidoController::class, 'getPE'])->name('pedido.info');
    });

    Route::prefix('getter')->group(function () {
        Route::get('/notificacao/{id_para}', [GetterController::class, 'getNoficacoes'])->name('getter.notificacao');
    });

    Route::prefix('print')->group(function () {
        Route::get('/estoque', [PrintController::class, 'index'])->name('print.estoque');
        Route::get('/estoque/{estoque_id}', [PrintController::class, 'view'])->name('print.view');
        Route::get('/nivel_alerta', [PrintController::class, 'nivel_alerta'])->name('print.nivel_alerta');
    });

    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/main', [HomeController::class, 'home'])->name('main');
    Route::get('/produtos', [HomeController::class, 'produto'])->name('produto');
    Route::get('/categorias', [HomeController::class, 'categoria'])->name('categoria');

    Route::prefix('cargos')->group(function () {
        Route::post('/', [CargoController::class, 'store'])->name('cargo.store');
    });

    Route::prefix('grupos_farmacologicos')->group(function () {
        Route::get('/', [GFC::class, 'index'])->name('grupos_farmacologicos.index');
    });

    Route::prefix('atividades')->group(function () {
        Route::get('/', [AtividadeController::class, 'index'])->name('atividade.show');
    });

    Route::prefix('funcionarios')->group(function () {
        Route::get('/', [FuncionarioController::class, 'index'])->name('funcionarios');
    });

    Route::prefix('relatorio')->group(function () {
        Route::get('/', [NivelAlertaController::class, 'index'])->name('nivel_alerta');
        Route::get('/gerar_relatorio', [NivelAlertaController::class, 'gerarRelatorio'])->name('gerar_relatorio');
        Route::post('/gerar_relatorio', [NivelAlertaController::class, 'gerarRelatorioPost'])->name('gerar_relatorio.post');
    });

    Route::prefix('alertas')->group(function () {
        Route::get('/', [AlertController::class, 'index'])->name('alert.show');
    });

    Route::prefix('estoque')->middleware('is.area_hospitalar')->group(function () {
        Route::get('/', [EstoqueController::class, 'index'])->name('estoque');
        Route::get('/editar/{id}/{returnID}', [EstoqueController::class, 'edit'])->name('estoque.editar');
        Route::post('/editar/{id}/{returnID}', [EstoqueController::class, 'update'])->name('estoque.update');
        Route::get('/home', [EstoqueController::class, 'getListHome'])->name('estoque.gerente');
        Route::get('/solicitar/{id}', [EstoqueController::class, 'solicitar'])->name('estoque.solicitar');
        ///
        Route::get('/add-estoque-minimo/{id}', [StockController::class, 'add_estoque_minimo'])->name('estoque._minimo');
        Route::post('/add-estoque-minimo/{id}', [StockController::class, 'store_stock'])->name('estoque._store_stock');
        Route::get('/estoque/filtro', [StockController::class, 'filtrarEstoque'])->name('estoque.filtrar');
        ///
        Route::get('/ver/{id}', [EstoqueController::class, 'getEstoque'])->name('estoque.getEstoque');
        Route::get('obter/{id}', [EstoqueController::class, 'myEstoque'])->name('estoque.myEstoque');
        Route::get('/aa', [EstoqueController::class, 'aa']);
        Route::get('/produto/{id}', [EstoqueController::class, 'getProduto']);
        Route::put('/produto/{id}', [EstoqueController::class, 'editarProduto']);
        Route::get('estoque/ajax', [EstoqueController::class, 'ajaxEstoque'])->name('estoque.ajax');
        Route::get('/adicionar/{area_id}', [EstoqueController::class, 'cadastrar'])->name('estoque.cadastrar');
        Route::post('/', [EstoqueController::class, 'store'])->name('estoque.store');
        Route::post('/baixa', [EstoqueController::class, 'baixa'])->name('estoque.baixa');
        Route::post('/dar_baixa/{area_de}', [EstoqueController::class, 'dar_baixa'])->name('estoque.dar_baixa');
        Route::get('/relatorio', [EstoqueController::class, 'calcularNivelAlerta'])->name('estoque.relatorio');

        Route::prefix('confirmar')->group(function () {
            // nao altere aqui
            Route::get('/{id_produto}/{id_area}', [EstoqueController::class, 'confirmarProduto'])->name('estoque.confirmar');
        });
    });

    Route::prefix('permissoes')->group(function () {
        Route::post('/', [PermissoesController::class, 'store'])->name('permissoes.store');
    });

    Route::prefix('categoria')->group(function () {
        Route::post('/', [CategoriaController::class, 'store'])->name('categoria.store');
    });

    Route::prefix('u')->group(function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('usuario');
        Route::put('/', [UsuarioController::class, 'addCargo'])->name('usuario.addCargo');
        // não alterar a rota aqui updatePassword
        Route::put('bloquear/{id}', [UsuarioController::class, 'blockUser'])->name('u.bloquear');
        Route::get('desbloquear/{id}', [UsuarioController::class, 'unblockUser'])->name('u.desbloquear');
        Route::get('{username}', [UsuarioController::class, 'perfil'])->name('u.perfil');
        Route::post('alterar-senha', [UsuarioController::class, 'updatePassword'])->name('u.altSenha');
    });

    Route::prefix('areas_hospitalares')->group(function () {
        Route::get('', [AreaHospitalarController::class, 'index'])->name('a_h.index');
        Route::post('add/cargo', [AreaHospitalarController::class, 'addCargo'])->name('a_h.addCargo');
        Route::put('/a_h/{id}', [AreaHospitalarController::class, 'update']);
        Route::delete('/apagar/{id}', [AreaHospitalarController::class, 'destroy'])->name('a_h.destroy');
        Route::post('', [AreaHospitalarController::class, 'store'])->name('a_h.index.store');
        Route::get('/statUs', [AreaHospitalarController::class, 'getStatDia'])->name('a_h.get_stat_dia');

        Route::get("/get/areas", function () {
            $AllAreas = \App\Models\FarmaciaAreaHospitalar::all();

            return response()->json(['data' => $AllAreas], 200);
        });
    });
    // ConfigController
    Route::prefix('definicoes')->group(function () {
        Route::get('/site', [ConfigController::class, 'index'])->name('config.site');
        Route::post('/site/set_config', [ConfigController::class, 'set_config'])->name('config.set_config');
    });

    Route::prefix('gestor')->group(function () {
        Route::post('/', [GerenteFarmaciaController::class, 'store'])->name('gestor.store');
    });

    Route::prefix('farmacia')->group(function () {
        Route::get('/', [FarmaciaController::class, 'index'])->name('farmacia');
        Route::get('/stat', [FarmaciaController::class, 'getStatDia'])->name('farmacia.get_stat_dia');

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
        Route::put('/farmacia', [FarmaciaController::class, 'update'])->name('farmacia.update');

        // Rota para excluir a farmácia
        Route::delete('/apagar/{farmacia}', [FarmaciaController::class, 'destroy'])->name('farmacia.destroy');
    });

    Route::post('/logout', function () {
        if (auth()->check()) {
            Auth::logout();
        }
        return redirect()->route('login'); // Redireciona para a página inicial após o logout
    })->name('logout');

    // Dev
    Route::prefix('desenvolvedor')->group(function () {
        Route::get('visitantes', [VisitanteController::class, 'index'])->name('dev.visitante');
    });
});

Route::prefix('auth')->middleware('guest')->group(function () {
    Route::prefix('')->group(function () {
        Route::get('/confirmar/{token}', [ConfirmarController::class, 'funcionario'])->name('confirmar.funcionario');
        Route::post('/confirmar', [ConfirmarController::class, 'concluir'])->name('confirmar.funcionario.concluir');
    });

    Route::prefix('recuperar_senha')->group(function () {
        Route::get('', [AuthController::class, 'recuperarSenha'])->name('recuperar_senha');
        Route::post('', [AuthController::class, 'alterar_senha'])->name('alterar_senha');
        Route::get('password_reset', [AuthController::class, 'password_reset'])->name('password.reset');
        Route::get('password_reset?token={token}&email={email}', [AuthController::class, 'password_reset'])->name('password.reset.link');
        Route::post('password_reset', [AuthController::class, 'post_password_reset'])->name('post.password.reset');
    });

    Route::prefix('autenticar')->group(function () {
        Route::get('/confirmar/{token}', [ConfirmarController::class, 'funcionario'])->name('confirmar.funcionario');
        Route::post('/usuario', [AutenticarUserController::class, 'gerenteFarmacia'])->name('autenticar.gerenteFarmacia');
    });

    Route::prefix('gestor')->group(function () {
        Route::get('/confirmar/conta/{token}', [GerenteFarmaciaController::class, 'confirmar'])->name('gestor.token');
    });

    Route::get('/devver', [AuthController::class, 'devver'])->name('devver');

    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('entrar');
    Route::get('/registar', [AuthController::class, 'registar'])->name('registar');
    Route::post('/registar', [AuthController::class, 'store'])->name('registar.store');

    Route::get('/conta_criada', [AuthController::class, 'conta_criada'])->name('conta_criada');

    Route::prefix('confirmar')->group(function () {
        Route::get('/email/{token}', [AuthController::class, 'confirmar_email'])->name('auth.confirmar_email');
        Route::post('/email', [AuthController::class, 'confirmar_email_store'])->name('auth.confirmar_email_store');
    });
});

// Por favor, não alterar a estrutura da url
Route::prefix('api')->group(function () {
    Route::get('/produtos/{id}', [EstoqueController::class, 'apiEstoque']);
    Route::delete('/produtos_/{id}', [EstoqueController::class, 'destroy']);
    ///#
    Route::get('/status_produto/{id}', [StockController::class, 'status_produto']);
    ///#

    Route::get('/get/area_hospitalar', [AreaHospitalarController::class, 'getAll']);
    Route::get('/get/areas_hospitalares/def/{id}', [AreaHospitalarController::class, 'getAllMy']);
    Route::get('/get/area_hospitalar/{id}', [AreaHospitalarController::class, 'getInfo']);

    Route::get('/get/farmacia', [FarmaciaController::class, 'getAll']);
    Route::get('/get/farmacia/{id}', [FarmaciaController::class, 'getInfo']);

    Route::get('/get/pedidos', function () {
        $confirmacoes = \App\Models\PedidoItem::where('area_para', session('id_area_'))
            ->where('confirmado', 0)
            ->get();

        if ($confirmacoes->count() > 0) {
            return $confirmacoes->count();
        }

        return 0;
    });

    Route::get('/get/usuario/{id}', [UsuarioController::class, 'getUser'])->name('user.get');

    Route::get('/check-session', [AuthController::class, 'checkSession']);
    Route::get('/check-session-expiration', [AuthController::class, 'checkSessionExpiration']);
    Route::get('/check-user-status', [AuthController::class, 'checkUserStatus']);

    //Route::get('/login', [ApiAuth::class, 'then']);
});

Route::get('/execute-migrate', function () {
    // Executar o comando 'migrate'
    Artisan::call('migrate');
    // Capturar a saída do comando 'migrate'
    $migrateOutput = Artisan::output();

    // Executar o comando 'db:seed'
    //Artisan::call('db:seed');
    // Capturar a saída do comando 'db:seed'
    $seedOutput = $migrateOutput . '<hr>' . Artisan::output();

    // Retornar a saída de ambos os comandos em formato JSON
    //return response()->json(['migrate_output' => $migrateOutput, 'seed_output' => $seedOutput]);
    return response()->json(['output' => $seedOutput]);
});

Route::get('/sudo', function () {
    $r = shell_exec('which composer');
    echo "<pre>$r</pre>";
});

Route::get('/execute-migrater', function () {
    #Artisan::call('migrate');
    // Criar um novo processo para o comando `git pull`
    // Criar um novo processo para executar o comando 'composer require symfony/process'
    $process = new Process(['composer']);

    // Executar o processo e capturar a saída $process->getOutput()
    $process->run();

    // Verificar se houve algum erro ao executar o processo
    if (!$process->isSuccessful()) {
        return response()->json(['output' => $process->getErrorOutput()]);
    }
    //return response()->json(['output' => Artisan::output()]);
});


Route::prefix('alertas')->group(function () {
    Route::get('/obter', function () {
        $farmacia_id = @auth()->user()->isFarmacia->farmacia_id;
        $isArea = @auth()->user()->area_hospitalar->area_hospitalar_id;
        if ($farmacia_id) {
            $allAreaIds = \App\Models\FarmaciaAreaHospitalar::where('farmacia_id', @$farmacia_id)->pluck('area_hospitalar_id');
            $pedidos = \App\Models\PedidoItem::whereIn('area_para', $allAreaIds)
                ->where('confirmado', 0)->with('user_de', 'item')->get();

            return $pedidos;
        }else if ($isArea) {
            $pedidos = \App\Models\PedidoItem::where('area_para', $isArea)
                ->where('confirmado', 0)->with('user_de', 'item')->get();

                return $pedidos;
        }
    });
});

Route::prefix('artisan')->group(function() {
    Route::get('/', [CommandController::class, 'index'])->name('artisan');
    Route::post('/run', [CommandController::class, 'run'])->name('artisan.run');
});

Route::get('/artisa', function() {
    return view('artisan.terminal');
})->name('artisan.terminal');

// Route::post('/run-command', [TerminalController::class,'runArtisanCommand'])->name('runCommand');
// Route::post('/run-composer', [TerminalController::class,'runComposer'])->name('runComposer');
// Route::post('/run-terminal', [TerminalController::class, 'runTerminal']);

Route::get('/get-artisan-commands', function () {
    // Obtém todos os comandos Artisan registrados
    $commands = Artisan::all();
    return response()->json(['commands' => array_keys($commands)]);
});

Route::get('/artisa/backend/{cmd}', function($cmd) {
    try {
        // Executa o comando Artisan
        Artisan::call($cmd);

        // Captura a saída do comando
        $output = Artisan::output();

        // Retorna a saída como uma resposta JSON
        return response()->json(['output' => $output]);
    } catch (\Exception $e) {
        // Em caso de erro, retorna a mensagem de erro
        return response()->json(['output' => 'Erro ao executar o comando: ' . $e->getMessage()]);
    }
})->name('artisan.terminal');

Route::get('/artisa/{command}', function ($command) {
    // Limitar comandos permitidos
    $allowedCommands = [
        'cache:clear', 'config:clear', 'route:clear', 'view:clear', 'event:clear',
        'config:cache', 'route:cache', 'db:seed', 'optimize:clear', 'queue:restart',
        'migrate', 'migrate:rollback', 'migrate:fresh', 'migrate:refresh',
        'make:model', 'make:controller', 'make:migration', 'make:seeder', 'make:command',
        'composer:dump-autoload', 'optimize', 'session:clear', 'package:discover',
        'backup:run', 'db:backup', 'db:restore'
    ];

    if (in_array($command, $allowedCommands)) {
        Artisan::call($command);
        $output = nl2br(Artisan::output()); // Formatar a saída com quebras de linha
        return view('artisan.output', compact('output', 'command'));
    }

    return response()->view('artisan.error', ['error' => 'Comando não permitido ou inválido'], 400);
});

Route::get('/php', function () {
    // Definindo o comando para executar o Composer
    $command = 'php composer.phar';

    $COMPOSER_HOME = "COMPOSER_HOME";
    $COMPOSER_HOME_VALUE = "/home4/pharm971/composer";
    $HOME = "HOME";
    $HOME_VALUE = "/home4/pharm971/public_html";

    putenv("$HOME=$HOME_VALUE");
    putenv("$COMPOSER_HOME=$COMPOSER_HOME_VALUE");

    // Função para executar comandos do Composer
    function runComposerCommand($command)
    {
        // Definindo o comando completo para executar o Composer
        $fullCommand = 'php composer.phar ' . $command;

        // Abrindo um processo para executar o comando
        $process = proc_open($fullCommand, [
            0 => ['pipe', 'r'], // Entrada padrão (stdin)
            1 => ['pipe', 'w'], // Saída padrão (stdout)
            2 => ['pipe', 'w'], // Saída de erro (stderr)
        ], $pipes);

        if (is_resource($process)) {
            // Lendo a saída padrão
            $stdout = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            // Lendo a saída de erro
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[2]);

            // Fechando o processo
            $returnCode = proc_close($process);

            // Exibindo a saída padrão
            echo "\n$stdout\n";

            // Exibindo a saída de erro, se houver
            if (!empty($stderr)) {
                echo "Saída de erro:\n$stderr\n";
            }
        } else {
            echo "Não foi possível abrir o processo para executar o comando.\n";
        }
    }

    function runArtisan($command)
    {
        $fullCmd = "php artisan " . $command;
        $cmd = exec($fullCmd);
        /*$proccess = proc_open($fullCmd, [
            0 => ['pipe', 'r'], // Entrada padrão (stdin)
            1 => ['pipe', 'w'], // Saída padrão (stdout)
            2 => ['pipe', 'w'], // Saída de erro (stderr)
        ], $pipes);

        if (is_resource($process)) {
            // Lendo a saída padrão
            $stdout = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            // Lendo a saída de erro
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[2]);

            // Fechando o processo
            $returnCode = proc_close($process);

            // Exibindo a saída padrão
            echo "\n$stdout\n";

            // Exibindo a saída de erro, se houver
            if (!empty($stderr)) {
                echo "Saída de erro:\n$stderr\n";
            }
        } else {
            echo "Não foi possível abrir o processo para executar o comando.\n";
        }*/

        return response()->json(['output' => shell_exec($cmd)]);
    }
});
