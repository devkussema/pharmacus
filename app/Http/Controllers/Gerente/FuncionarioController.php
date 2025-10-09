<?php

namespace App\Http\Controllers\Gerente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class FuncionarioController extends Controller
{
    /**
     * Exibe a listagem de usuários associados à farmácia do utilizador autenticado e partilha-os com a view
     * 'prepharma::funcionario.show'.
     *
     * Fluxo resumido:
     * - Recupera o id da farmácia relacionada ao utilizador autenticado (auth()->user()->isFarmacia?->farmacia?->id).
     * - Busca todos os user_id's na tabela de ligação App\Models\UserAreaHospitalar para essa farmácia.
     * - Carrega os modelos App\Models\User correspondentes e partilha a coleção como 'usuarios' na view.
     *
     * Observações sobre os dados disponibilizados em cada item da coleção $usuarios (App\Models\User):
     * - nome (nome do utilizador)
     *     - Acesso direto esperado:  $usuario->name
     *     - Alternativa (algumas bases usam pt-BR): $usuario->nome
     *     - Uso seguro: $displayName = $usuario->name ?? $usuario->nome ?? '';
     *
     * - cargo (função / posição)
     *     - Possíveis implementações em User:
     *         - relacionamento singular:   $usuario->cargo->nome
     *         - relacionamento roles (many-to-many): $usuario->roles->pluck('name')->join(', ')
     *         - atributo direto: $usuario->cargo (string)
     *     - Recomenda-se verificar a existência da relação/atributo antes de acessar:
     *         - if (isset($usuario->cargo)) { $cargo = $usuario->cargo->nome ?? $usuario->cargo; }
     *
     * - área (área/hospitalar associada via pivot UserAreaHospitalar)
     *     - Se existir relação definida no User: $usuario->areas (Collection) ou $usuario->userAreaHospitalar
     *     - Padrão consultado na controller: UserAreaHospitalar::where('user_id', $usuario->id)->with('area')->get()
     *     - Exemplo de acesso seguro:
     *         - $areas = $usuario->areas ?? $usuario->userAreaHospitalar ?? collect();
     *         - foreach ($areas as $area) { $areaNome = $area->nome ?? $area->area->nome ?? ''; }
     *
     * - telefone (contacto telefónico)
     *     - Acesso direto esperado: $usuario->telefone ou $usuario->phone
     *     - Verificar ambas e fallback vazio:
     *         - $telefone = $usuario->telefone ?? $usuario->phone ?? '';
     *
     * - estado (estado/ativo ou status do utilizador)
     *     - Possíveis campos: $usuario->estado, $usuario->status ou $usuario->active (boolean)
     *     - Normalizar para leitura na view:
     *         - if (isset($usuario->active)) { $estado = $usuario->active ? 'ativo' : 'inativo'; }
     *         - else { $estado = $usuario->estado ?? $usuario->status ?? ''; }
     *
     * Boas práticas e recomendações:
     * - Eager load para evitar N+1: ao buscar os utilizadores, usar ->with([...]) conforme relações reais (ex.: 'roles', 'cargo', 'areas.area').
     * - Confirmar os nomes exatos de atributos/relacionamentos inspecionando App\Models\User e App\Models\UserAreaHospitalar no projecto.
     * - Tratar casuísticas onde atributos ou relações possam ser nulos para evitar erros em tempo de execução.
     *
     * @author Augusto Kussema
     * @created 01/10/2025
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View  Retorna a view 'prepharma::funcionario.show' com a variável compartilhada 'usuarios'
     */
    public function index(Request $request)
    {
        /**
         * Recupera o id único da farmácia do utilizador autenticado e obtém todos os utilizadores
         * associados a essa farmácia através da tabela user_area_hospitalar.
         *
         * @author Augusto Kussema
         * @created 01/10/2025
         *
         * @var int|null $farmaciaId
         * @var \Illuminate\Support\Collection $userIds
         * @var \Illuminate\Support\Collection $usuarios
         */
        $farmaciaId = auth()->user()->isFarmacia?->farmacia?->id ?? null;

        if ($farmaciaId === null) {
            // Sem farmácia associada -> coleção vazia e retorno imediato
            $usuarios = collect();
            \Illuminate\Support\Facades\View::share('usuarios', $usuarios);
            return view('prepharma::funcionario.show');
        }

        // Obtém todos os user_id's ligados a esta farmácia na tabela de ligação
        $userIds = \App\Models\UserAreaHospitalar::query()
            ->where('farmacia_id', $farmaciaId)
            ->pluck('user_id')
            ->unique()
            ->values();

        if ($userIds->isEmpty()) {
            $usuarios = collect();
            \Illuminate\Support\Facades\View::share('usuarios', $usuarios);
            return view('prepharma::funcionario.show');
        }

        // Busca os utilizadores correspondentes aos user_id's encontrados
        $usuarios = \App\Models\User::whereIn('id', $userIds)
            ->with('cargo')
            ->get();

        // Partilha e devolve a view imediatamente (curta-circuito para evitar lógica posterior)
        \Illuminate\Support\Facades\View::share('usuarios', $usuarios);
        return view('prepharma::funcionario.show');

    }

    public function filtrar(Request $request)
    {
        $query = User::with(['cargo', 'userAreaHospitalar.areaHospitalar']);

        // Filtrar apenas usuários que têm área hospitalar (funcionários AH)
        $query->whereHas('userAreaHospitalar');

        // Filtro por nome
        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

        // Filtro por cargo
        if ($request->filled('cargo_id')) {
            $query->whereHas('userAreaHospitalar', function($q) use ($request) {
                $q->where('cargo_id', $request->cargo_id);
            });
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $estado = $request->estado;
            $query->where(function($q) use ($estado) {
                if ($estado === 'ativo') {
                    $q->where('status', '1')
                      ->orWhere('estado', 'ativo')
                      ->orWhere('estado', 'active');
                } elseif ($estado === 'inativo') {
                    $q->where('status', '0')
                      ->orWhere('estado', 'inativo')
                      ->orWhereNull('estado');
                } elseif ($estado === 'pendente') {
                    $q->where('estado', 'pendente')
                      ->orWhere('estado', 'pending');
                }
            });
        }

        $usuarios = $query->get();

        $html = view('prepharma.funcionario.partials.funcionarios-table', compact('usuarios'))->render();

        return response()->json([
            'html' => $html,
            'count' => $usuarios->count()
        ]);
    }

    public function alterarStatus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:ativo,inativo,pendente'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->estado = $request->status;
        $user->save();

        return response()->json(['message' => 'Status atualizado com sucesso']);
    }

    /**
     * Alterna o estado de permissões para um utilizador específico na tabela permissoes.
     *
     * Este método verifica se o utilizador já possui permissões cadastradas:
     * - Se já existirem: remove as permissões (elimina o registo)
     * - Se não existirem: cadastra as permissões com estrutura padrão
     *
     * Estrutura das permissões cadastradas (quando aplicável):
     * - cargo: permissão para cadastrar
     * - produtos: permissões para ver e cadastrar
     * - relatorio: permissão para ver
     * - area_hospitalar: valor nulo (sem permissões específicas)
     *
     * @author Augusto Kussema
     * @created 01/10/2025
     *
     * @param int $userId ID do utilizador que terá as permissões alternadas
     * @return \Illuminate\Http\RedirectResponse Redirecionamento com mensagem de feedback
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Se o utilizador não for encontrado
     */
    public function alternarPermissoes(int $userId): \Illuminate\Http\RedirectResponse
    {
        try {
            // Verifica se o utilizador existe
            $usuario = \App\Models\User::findOrFail($userId);

            // Verifica se já existe permissão para este utilizador
            $permissaoExistente = \App\Models\Permissao::where('user_id', $userId)->first();

            if ($permissaoExistente) {
                // Se já existe, remove as permissões
                $permissaoExistente->delete();

                return redirect()->back()->with('success', 'Permissões removidas com sucesso para o utilizador.');
            } else {
                // Se não existe, cadastra as permissões padrão
                $conteudoPermissoes = [
                    'cargo' => [
                        'cadastrar' => 'on'
                    ],
                    'produtos' => [
                        'ver' => 'on',
                        'cadastrar' => 'on'
                    ],
                    'relatorio' => [
                        'ver' => 'on'
                    ],
                    'area_hospitalar' => null
                ];

                \App\Models\Permissao::create([
                    'user_id' => $userId,
                    'conteudo' => json_encode($conteudoPermissoes)
                ]);

                return redirect()->back()->with('success', 'Permissões cadastradas com sucesso para o utilizador.');
            }

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Utilizador não encontrado no sistema.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro interno do servidor ao processar permissões: ' . $e->getMessage());
        }
    }

    /**
     * Alterar permissão de cadastro de produtos (SIMPLIFICADO)
     */
    public function alterarPermissao(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'permission' => 'required|boolean'
            ]);

            $user = User::findOrFail($request->user_id);
            $novaPermissao = $request->permission;

            // Atualizar a coluna diretamente
            $user->pode_cadastrar_produtos = $novaPermissao;
            $user->save();

            $acaoTexto = $novaPermissao ? 'concedida' : 'removida';

            return response()->json([
                'success' => true,
                'message' => "✅ Permissão de cadastro {$acaoTexto} para {$user->nome}!",
                'nova_permissao' => $novaPermissao,
                'usuario' => $user->nome
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao alterar permissão: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => '❌ Erro ao alterar permissão. Tente novamente.'
            ], 500);
        }
    }
}
