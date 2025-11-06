<?php

namespace Modules\Diretor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdutoEstoque;
use App\Models\Estoque;
use App\Models\NivelAlerta;
use App\Models\GrupoFarmacologico;
use App\Models\SaldoEstoque;
use Illuminate\Support\Facades\DB;

/**
 * Controlador para gestão de estoque do módulo Diretor.
 *
 * @author Augusto Kussema
 * @created 05-11-2025
 * @updated 06-11-2025
 */
class EstoqueController extends Controller
{
    /**
     * Exibe a listagem do estoque.
     *
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function index()
    {
        return view('diretor::pages.estoque.index');
    }

    /**
     * Lista produtos do estoque com filtros e paginação (AJAX).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    public function listar(Request $request)
    {
        try {
            $query = ProdutoEstoque::with(['grupo_farmaco', 'saldo'])
                ->whereHas('estoque');

            // Filtro por categoria (grupo farmacológico)
            if ($request->filled('categoria') && $request->categoria != 'todas') {
                $query->where('grupo_farmaco_id', $request->categoria);
            }

            // Filtro por validade
            if ($request->filled('validade') && $request->validade != 'todas') {
                switch ($request->validade) {
                    case 'vencidos':
                        $query->where('data_expiracao', '<', now());
                        break;
                    case '30dias':
                        $query->whereBetween('data_expiracao', [now(), now()->addDays(30)]);
                        break;
                    case '90dias':
                        $query->whereBetween('data_expiracao', [now(), now()->addDays(90)]);
                        break;
                    case 'validos':
                        $query->where('data_expiracao', '>', now()->addDays(90));
                        break;
                }
            }

            // Busca por termo
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('designacao', 'LIKE', "%{$search}%")
                      ->orWhere('num_lote', 'LIKE', "%{$search}%")
                      ->orWhere('descritivo', 'LIKE', "%{$search}%");
                });
            }

            // Total de registros antes da paginação
            $total = $query->count();

            // Paginação
            $perPage = 10;
            $page = $request->get('page', 1);
            $produtos = $query->orderBy('created_at', 'desc')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            // Obter níveis de alerta para cálculo de status
            $niveisAlerta = $this->obterNiveisAlerta();

            // Processar produtos com status
            $produtosProcessados = $produtos->map(function($produto) use ($niveisAlerta) {
                $quantidade = $produto->quantidade ?? 0;
                $status = $this->calcularStatus($quantidade, $niveisAlerta);
                
                return [
                    'id' => $produto->id,
                    'designacao' => $produto->designacao,
                    'num_lote' => $produto->num_lote,
                    'dosagem' => $produto->dosagem,
                    'forma' => $produto->forma,
                    'categoria' => $produto->grupo_farmaco ? $produto->grupo_farmaco->nome : 'Sem Categoria',
                    'grupo_farmaco_id' => $produto->grupo_farmaco_id,
                    'quantidade' => $quantidade,
                    'data_expiracao' => $produto->data_expiracao ? $produto->data_expiracao->format('d/m/Y') : null,
                    'data_expiracao_raw' => $produto->data_expiracao,
                    'status' => $status,
                    'fornecedor' => $produto->fornecedor,
                    'prateleira' => $produto->prateleira ? $produto->prateleira->codigo : null,
                ];
            });

            // Calcular resumo
            $resumo = $this->calcularResumo($niveisAlerta);

            return response()->json([
                'success' => true,
                'data' => $produtosProcessados,
                'pagination' => [
                    'current_page' => (int) $page,
                    'per_page' => $perPage,
                    'total' => $total,
                    'last_page' => ceil($total / $perPage),
                    'from' => (($page - 1) * $perPage) + 1,
                    'to' => min($page * $perPage, $total),
                ],
                'resumo' => $resumo,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar produtos: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Retorna as categorias (grupos farmacológicos) que possuem produtos.
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    public function categorias()
    {
        try {
            $categorias = GrupoFarmacologico::whereHas('produtos', function($query) {
                $query->whereHas('estoque');
            })
            ->orderBy('nome')
            ->get(['id', 'nome']);

            return response()->json([
                'success' => true,
                'data' => $categorias
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar categorias: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Retorna as opções de status baseadas nos níveis de alerta.
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    public function statusOpcoes()
    {
        try {
            $niveis = NivelAlerta::orderBy('id')->get(['id', 'nome']);

            return response()->json([
                'success' => true,
                'data' => $niveis
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar níveis de alerta: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtém os níveis de alerta configurados.
     *
     * @return array
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    private function obterNiveisAlerta(): array
    {
        $niveis = NivelAlerta::all();
        
        $config = [
            'normal' => null,
            'minimo' => null,
            'critico' => null,
        ];

        foreach ($niveis as $nivel) {
            $nome = strtolower($nivel->nome);
            if (str_contains($nome, 'normal') || str_contains($nome, 'adequado')) {
                $config['normal'] = $nivel;
            } elseif (str_contains($nome, 'mínimo') || str_contains($nome, 'baixo')) {
                $config['minimo'] = $nivel;
            } elseif (str_contains($nome, 'crítico') || str_contains($nome, 'critico')) {
                $config['critico'] = $nivel;
            }
        }

        return $config;
    }

    /**
     * Calcula o status do produto baseado na quantidade e níveis de alerta.
     *
     * @param int $quantidade
     * @param array $niveisAlerta
     * @return array
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    private function calcularStatus(int $quantidade, array $niveisAlerta): array
    {
        // Valores padrão de referência (podem ser ajustados)
        $limiteMinimo = 50;
        $limiteCritico = 20;

        if ($quantidade <= $limiteCritico) {
            return [
                'classe' => 'critical',
                'label' => 'Crítico',
                'nivel_id' => $niveisAlerta['critico']->id ?? null
            ];
        } elseif ($quantidade <= $limiteMinimo) {
            return [
                'classe' => 'warning',
                'label' => 'Mínimo',
                'nivel_id' => $niveisAlerta['minimo']->id ?? null
            ];
        }

        return [
            'classe' => 'normal',
            'label' => 'Normal',
            'nivel_id' => $niveisAlerta['normal']->id ?? null
        ];
    }

    /**
     * Calcula o resumo geral do estoque.
     *
     * @param array $niveisAlerta
     * @return array
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    private function calcularResumo(array $niveisAlerta): array
    {
        $produtos = ProdutoEstoque::whereHas('estoque')->get();
        
        $total = $produtos->count();
        $normal = 0;
        $minimo = 0;
        $critico = 0;

        foreach ($produtos as $produto) {
            $quantidade = $produto->quantidade ?? 0;
            $status = $this->calcularStatus($quantidade, $niveisAlerta);
            
            switch ($status['classe']) {
                case 'normal':
                    $normal++;
                    break;
                case 'warning':
                    $minimo++;
                    break;
                case 'critical':
                    $critico++;
                    break;
            }
        }

        return [
            'total' => $total,
            'normal' => $normal,
            'minimo' => $minimo,
            'critico' => $critico,
        ];
    }

    /**
     * Exibe um item específico do estoque.
     *
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function show($id)
    {
        return view('diretor::pages.estoque.show', compact('id'));
    }
}