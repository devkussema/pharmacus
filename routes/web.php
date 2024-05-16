<?php

use Illuminate\Support\Facades\Route;

use App\Prada\Controllers\HomeController;
use App\Prada\Controllers\AuthController;
use App\Prada\Controllers\FarmaciaController;
use App\Prada\Controllers\CategoriaController;
use App\Prada\Controllers\GerenteFarmaciaController;
use App\Prada\Controllers\AreaHospitalarController;
use Illuminate\Support\Facades\Artisan;
use App\Prada\Controllers\{
    PermissoesController,
    GetterController,
    ConfigController,
    AutenticarUserController,
    UsuarioController, FuncionarioController,
    CargoController, ConfirmarController, EstoqueController,
    NivelAlertaController, GrupoFarmacologicoController as GFC
};
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;

use App\Http\Controllers\Dev\{
    VisitanteController, DevController
};
use App\Http\Controllers\Api\{
    AuthController as ApiAuth
};

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

Route::middleware(['auth', 'is.status', 'is.online'])->group(function () {
    Route::prefix('dev')->group(function () {
        Route::get('/levantamento', [DevController::class, 'levantamento'])->name('dev.levantamento');
        Route::get('/novo_doc', [DevController::class, 'novo_doc'])->name('dev.novo_doc');
        Route::get('/listaEstoque', [DevController::class, 'getFichaControloLimite']);
        Route::get('/listaEstoque/{area}', [DevController::class, 'getFichaControlo'])->name('dev.listaEstoque');
    });

    Route::prefix('getter')->group(function () {
        Route::get('/notificacao/{id_para}', [GetterController::class, 'getNoficacoes'])->name('getter.notificacao');
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

    Route::prefix('funcionarios')->group(function () {
        Route::get('/', [FuncionarioController::class, 'index'])->name('funcionarios');
    });

    Route::prefix('nivel_alerta')->group(function () {
        Route::get('/', [NivelAlertaController::class, 'index'])->name('nivel_alerta');
    });

    Route::prefix('estoque')->middleware('is.area_hospitalar')->group(function () {
        Route::get('/', [EstoqueController::class, 'index'])->name('estoque');
        Route::get('/home', [EstoqueController::class, 'getListHome'])->name('estoque.gerente');
        Route::get('/{id}', [EstoqueController::class, 'getEstoque'])->name('estoque.getEstoque');
        Route::get('/aa', [EstoqueController::class, 'aa']);
        Route::get('/produto/{id}', [EstoqueController::class, 'getProduto']);
        Route::put('/produto/{id}', [EstoqueController::class, 'editarProduto']);
        Route::get('estoque/ajax', [EstoqueController::class, 'ajaxEstoque'])->name('estoque.ajax');
        Route::post('/', [EstoqueController::class, 'store'])->name('estoque.store');
        Route::post('/baixa', [EstoqueController::class, 'baixa'])->name('estoque.baixa');
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
    Route::get('/get/area_hospitalar', [AreaHospitalarController::class, 'getAll']);
    Route::get('/get/area_hospitalar/{id}', [AreaHospitalarController::class, 'getInfo']);

    Route::get('/get/farmacia', [FarmaciaController::class, 'getAll']);
    Route::get('/get/farmacia/{id}', [FarmaciaController::class, 'getInfo']);


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
    $seedOutput = $migrateOutput. '<hr>' .Artisan::output();

    // Retornar a saída de ambos os comandos em formato JSON
    //return response()->json(['migrate_output' => $migrateOutput, 'seed_output' => $seedOutput]);
    return response()->json(['output' => $seedOutput]);
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

Route::get('/shell', function ($cmd) {
    exec($cmd);
    return response()->json(['output' => shell_exec($cmd)]);
});

Route::get('/artisan', function ($cmd) {
    Artisan::call($cmd);
    // Capturar a saída do comando 'migrate'
    $migrateOutput = Artisan::output();

    // Executar o comando 'db:seed'
    //Artisan::call('db:seed');
    // Capturar a saída do comando 'db:seed'
    $seedOutput = $migrateOutput. '<hr>' .Artisan::output();

    // Retornar a saída de ambos os comandos em formato JSON
    //return response()->json(['migrate_output' => $migrateOutput, 'seed_output' => $seedOutput]);
    //return response()->json(['output' => $seedOutput]);
    return response()->json(['output' => shell_exec($seedOutput)]);
});

Route::get('/php', function ($cmd) {
    // Definindo o comando para executar o Composer
    $command = 'php composer.phar';

    $COMPOSER_HOME = "COMPOSER_HOME";
    $COMPOSER_HOME_VALUE = "/home4/pharm971/composer";
    $HOME = "HOME";
    $HOME_VALUE = "/home4/pharm971/public_html";

    putenv("$HOME=$HOME_VALUE");
    putenv("$COMPOSER_HOME=$COMPOSER_HOME_VALUE");

    // Função para executar comandos do Composer
    function runComposerCommand($command) {
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

    function runArtisan($command) {
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
