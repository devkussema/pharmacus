<?php

namespace Modules\Diretor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductHistory;
use App\Models\ProdutoEstoque;
use Illuminate\Support\Facades\DB;

/**
 * Controller para gestão de registro de atividades e logs da farmácia hospitalar
 *
 * @author Augusto Kussema
 * @date 2025-11-06
 */
class RegistroAtividadesController extends Controller
{
    /**
     * Lista todas as atividades recentes (dispensações, entradas, movimentações)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: Buscar atividades do banco de dados
        return view('diretor::pages.registro-atividades.index');
    }

    /**
     * Exibe detalhes de uma atividade específica
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // TODO: Buscar atividade específica do banco
        return view('diretor::pages.registro-atividades.show', compact('id'));
    }

    /**
     * Retorna lista paginada de atividades via AJAX
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listar(Request $request)
    {
        try {
            $tipo = $request->input('tipo', '');
            $periodo = $request->input('periodo', 'hoje');
            $funcionario = $request->input('funcionario', '');
            $busca = $request->input('busca', '');
            $pagina = (int) $request->input('pagina', 1);
            $porPagina = 10;

            // Buscar histórico real do ProductHistory
            $query = ProductHistory::with(['produto', 'user']);

            // Filtro por período
            switch ($periodo) {
                case 'hoje':
                    $query->whereDate('created_at', today());
                    break;
                case 'semana':
                    $query->whereBetween('created_at', [now()->subWeek(), now()]);
                    break;
                case 'mes':
                    $query->whereBetween('created_at', [now()->subMonth(), now()]);
                    break;
                case 'trimestre':
                    $query->whereBetween('created_at', [now()->subMonths(3), now()]);
                    break;
            }

            // Filtro por tipo de ação
            if ($tipo) {
                $query->where('action', 'LIKE', "%{$tipo}%");
            }

            // Filtro por busca
            if ($busca) {
                $query->where(function($q) use ($busca) {
                    $q->whereHas('produto', function($pq) use ($busca) {
                        $pq->where('designacao', 'LIKE', "%{$busca}%")
                           ->orWhere('num_lote', 'LIKE', "%{$busca}%");
                    });
                });
            }

            // Contar total
            $total = $query->count();

            // Paginação
            $historico = $query->orderBy('created_at', 'desc')
                ->skip(($pagina - 1) * $porPagina)
                ->take($porPagina)
                ->get();

            $atividades = $historico->map(function($h) {
                $tipo = 'dispensacao';
                $titulo = 'Movimentação de Estoque';

                if (stripos($h->action, 'entrada') !== false || stripos($h->action, 'stock_in') !== false) {
                    $tipo = 'entrada';
                    $titulo = 'Entrada de Estoque';
                } elseif (stripos($h->action, 'saida') !== false || stripos($h->action, 'dispensacao') !== false) {
                    $tipo = 'dispensacao';
                    $titulo = 'Dispensação de Medicamento';
                } elseif (stripos($h->action, 'transferencia') !== false) {
                    $tipo = 'transferencia';
                    $titulo = 'Transferência Interna';
                }

                $quantidade = $h->quantidade_nova - $h->quantidade_antiga;
                $descricao = '<strong>' . ($h->produto ? $h->produto->designacao : 'Produto') . '</strong>';

                if ($quantidade != 0) {
                    $descricao .= ' - ' . abs($quantidade) . ' unidades ' . ($quantidade > 0 ? 'recebidas' : 'dispensadas');
                }

                return [
                    'id' => $h->id,
                    'tipo' => $tipo,
                    'titulo' => $titulo,
                    'descricao' => $descricao,
                    'hora' => $h->created_at->format('H:i'),
                    'usuario' => $h->user ? $h->user->name : 'Sistema',
                    'localizacao' => $h->observacao ?? null,
                ];
            });

            return response()->json([
                'success' => true,
                'atividades' => $atividades,
                'temMais' => ($pagina * $porPagina) < $total,
                'paginaAtual' => $pagina,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar atividades: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Retorna resumo de estatísticas via AJAX
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resumo()
    {
        try {
            // Contar atividades do dia
            $hoje = today();

            $dispensacoes = ProductHistory::whereDate('created_at', $hoje)
                ->where('action', 'LIKE', '%dispensacao%')
                ->orWhere('action', 'LIKE', '%saida%')
                ->count();

            $entradas = ProductHistory::whereDate('created_at', $hoje)
                ->where('action', 'LIKE', '%entrada%')
                ->orWhere('action', 'LIKE', '%stock_in%')
                ->count();

            $transferencias = ProductHistory::whereDate('created_at', $hoje)
                ->where('action', 'LIKE', '%transferencia%')
                ->count();

            // Contar produtos em nível crítico
            $alertas = ProdutoEstoque::with('saldo')
                ->whereHas('saldo', function($q) {
                    $q->whereRaw('quantidade_actual <= (nivel_minimo * 0.4)');
                })
                ->count();

            return response()->json([
                'success' => true,
                'resumo' => [
                    'dispensacoes' => $dispensacoes,
                    'entradas' => $entradas,
                    'transferencias' => $transferencias,
                    'alertas' => $alertas,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar resumo: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Retorna lista de funcionários via AJAX
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function funcionarios()
    {
        try {
            // TODO: Buscar funcionários reais do banco
            $funcionarios = [
                ['id' => 1, 'nome' => 'Dr. João Silva'],
                ['id' => 2, 'nome' => 'Téc. Maria Santos'],
                ['id' => 3, 'nome' => 'Aux. Pedro Costa'],
            ];

            return response()->json([
                'success' => true,
                'funcionarios' => $funcionarios,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar funcionários: ' . $e->getMessage(),
            ], 500);
        }
    }
}
