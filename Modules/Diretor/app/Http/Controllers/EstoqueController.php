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
            if ($request->filled('validade')) {
                switch ($request->validade) {
                    case '30':
                        $query->whereBetween('data_expiracao', [now(), now()->addDays(30)]);
                        break;
                    case '60':
                        $query->whereBetween('data_expiracao', [now(), now()->addDays(60)]);
                        break;
                    case 'vencidos':
                        $query->where('data_expiracao', '<', now());
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

            // Obter nível mínimo padrão
            $nivelMinimoPadrao = 50; // Pode ser configurável

            // Processar produtos com status
            $produtosProcessados = $produtos->map(function($produto) use ($niveisAlerta, $nivelMinimoPadrao) {
                // Obter quantidade real do saldo
                $quantidade = $produto->saldo ? $produto->saldo->quantidade_actual : 0;

                // Obter nível mínimo específico ou usar padrão
                $nivelMinimo = $produto->saldo ? $produto->saldo->nivel_minimo : $nivelMinimoPadrao;

                $status = $this->calcularStatus($quantidade, $niveisAlerta, $nivelMinimo);

                return [
                    'id' => $produto->id,
                    'designacao' => $produto->designacao . ($produto->dosagem ? ' ' . $produto->dosagem : ''),
                    'num_lote' => $produto->num_lote ?? 'N/A',
                    'dosagem' => $produto->dosagem,
                    'forma' => $produto->forma,
                    'categoria' => $produto->grupo_farmaco ? $produto->grupo_farmaco->nome : 'Sem Categoria',
                    'grupo_farmaco_id' => $produto->grupo_farmaco_id,
                    'quantidade' => $quantidade,
                    'nivel_minimo' => $nivelMinimo,
                    'validade_formatada' => $produto->data_expiracao ? $produto->data_expiracao->format('d/m/Y') : 'N/A',
                    'data_expiracao_raw' => $produto->data_expiracao,
                    'status_badge' => $status['label'],
                    'status_classe' => $status['classe'],
                    'fornecedor' => $produto->fornecedor ?? 'N/A',
                    'prateleira' => $produto->prateleira ? $produto->prateleira->codigo : null,
                ];
            });

            // Calcular resumo
            $resumo = $this->calcularResumo($niveisAlerta);

            return response()->json([
                'success' => true,
                'produtos' => [
                    'data' => $produtosProcessados,
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
            ->withCount(['produtos' => function($query) {
                $query->whereHas('estoque');
            }])
            ->orderBy('nome')
            ->get(['id', 'nome']);

            $categoriasFormatadas = $categorias->map(function($cat) {
                return [
                    'id' => $cat->id,
                    'nome' => $cat->nome,
                    'total_produtos' => $cat->produtos_count
                ];
            });

            return response()->json([
                'success' => true,
                'categorias' => $categoriasFormatadas
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
                'status' => $niveis
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
     * @param int $nivelMinimo
     * @return array
     * @author Augusto Kussema
     * @updated 06-11-2025
     */
    private function calcularStatus(int $quantidade, array $niveisAlerta, int $nivelMinimo = 50): array
    {
        // Calcular limite crítico como 40% do nível mínimo
        $limiteCritico = (int) ($nivelMinimo * 0.4);

        if ($quantidade <= $limiteCritico) {
            return [
                'classe' => 'critical',
                'label' => 'Crítico',
                'nivel_id' => $niveisAlerta['critico']->id ?? null
            ];
        } elseif ($quantidade <= $nivelMinimo) {
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
        $produtos = ProdutoEstoque::with('saldo')->whereHas('estoque')->get();

        $total = $produtos->count();
        $adequado = 0;
        $minimo = 0;
        $critico = 0;

        foreach ($produtos as $produto) {
            $quantidade = $produto->saldo ? $produto->saldo->quantidade_actual : 0;
            $nivelMinimo = $produto->saldo ? $produto->saldo->nivel_minimo : 50;
            $status = $this->calcularStatus($quantidade, $niveisAlerta, $nivelMinimo);

            switch ($status['classe']) {
                case 'normal':
                    $adequado++;
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
            'adequado' => $adequado,
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

    /**
     * Retorna detalhes completos de um produto (usado na página show).
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    public function detalhes($id)
    {
        try {
            $produto = ProdutoEstoque::with(['grupo_farmaco', 'saldo', 'prateleira'])->findOrFail($id);

            $quantidade = $produto->saldo ? $produto->saldo->quantidade_actual : 0;
            $nivelMinimo = $produto->saldo ? $produto->saldo->nivel_minimo : 50;
            $niveisAlerta = $this->obterNiveisAlerta();
            $status = $this->calcularStatus($quantidade, $niveisAlerta, $nivelMinimo);

            // Descrição do status
            $statusDescricao = 'Níveis adequados';
            if ($status['classe'] === 'critical') {
                $statusDescricao = 'Reposição urgente necessária';
            } elseif ($status['classe'] === 'warning') {
                $statusDescricao = 'Considerar reposição em breve';
            }

            return response()->json([
                'success' => true,
                'produto' => [
                    'id' => $produto->id,
                    'designacao' => $produto->designacao . ($produto->dosagem ? ' ' . $produto->dosagem : ''),
                    'categoria' => $produto->grupo_farmaco ? $produto->grupo_farmaco->nome : 'Sem Categoria',
                    'quantidade' => $quantidade,
                    'nivel_minimo' => $nivelMinimo,
                    'num_lote' => $produto->num_lote ?? 'N/A',
                    'data_expiracao' => $produto->data_expiracao ? $produto->data_expiracao->format('d/m/Y') : 'N/A',
                    'dosagem' => $produto->dosagem,
                    'forma' => $produto->forma,
                    'descritivo' => $produto->descritivo,
                    'fornecedor' => $produto->fornecedor,
                    'data_producao' => $produto->data_producao ? $produto->data_producao->format('d/m/Y') : null,
                    'data_recepcao' => $produto->data_recepcao ? $produto->data_recepcao->format('d/m/Y') : null,
                    'origem_destino' => $produto->origem_destino,
                    'prateleira_codigo' => $produto->prateleira ? $produto->prateleira->codigo : null,
                    'obs' => $produto->obs,
                    'status_classe' => $status['classe'],
                    'status_label' => $status['label'],
                    'status_descricao' => $statusDescricao,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar detalhes: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Retorna o histórico de um produto (AJAX).
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    public function historico($id)
    {
        try {
            $produto = ProdutoEstoque::with(['grupo_farmaco', 'saldo'])->findOrFail($id);

            $historico = \App\Models\ProductHistory::where('product_id', $id)
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->take(50)
                ->get()
                ->map(function($h) {
                    return [
                        'id' => $h->id,
                        'action' => $h->action,
                        'usuario' => $h->user ? $h->user->name : 'Sistema',
                        'data' => $h->created_at->format('d/m/Y H:i'),
                        'data_relativa' => $h->created_at->diffForHumans(),
                        'quantidade_delta' => $h->quantity_delta,
                        'changes' => $h->changes,
                        'summary' => $h->summary(),
                    ];
                });

            return response()->json([
                'success' => true,
                'produto' => [
                    'id' => $produto->id,
                    'designacao' => $produto->designacao . ($produto->dosagem ? ' ' . $produto->dosagem : ''),
                    'num_lote' => $produto->num_lote,
                    'categoria' => $produto->grupo_farmaco ? $produto->grupo_farmaco->nome : 'Sem Categoria',
                    'quantidade' => $produto->quantidade,
                    'data_expiracao' => $produto->data_expiracao ? $produto->data_expiracao->format('d/m/Y') : 'N/A',
                ],
                'historico' => $historico
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar histórico: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Exporta os produtos em CSV ou PDF.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    public function exportar(Request $request)
    {
        try {
            $formato = $request->get('formato', 'csv'); // csv ou pdf

            $query = ProdutoEstoque::with(['grupo_farmaco', 'saldo'])
                ->whereHas('estoque');

            // Aplicar mesmos filtros
            if ($request->filled('categoria')) {
                $query->where('grupo_farmaco_id', $request->categoria);
            }
            if ($request->filled('validade')) {
                switch ($request->validade) {
                    case '30':
                        $query->whereBetween('data_expiracao', [now(), now()->addDays(30)]);
                        break;
                    case '60':
                        $query->whereBetween('data_expiracao', [now(), now()->addDays(60)]);
                        break;
                    case 'vencidos':
                        $query->where('data_expiracao', '<', now());
                        break;
                }
            }

            $produtos = $query->orderBy('designacao')->get();

            if ($formato === 'csv') {
                return $this->exportarCSV($produtos);
            } else {
                return $this->exportarPDF($produtos);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao exportar: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Exporta produtos para CSV.
     *
     * @param Collection $produtos
     * @return \Illuminate\Http\Response
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    private function exportarCSV($produtos)
    {
        $filename = 'estoque_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($produtos) {
            $file = fopen('php://output', 'w');

            // BOM para UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Cabeçalhos
            fputcsv($file, [
                'Medicamento',
                'Categoria',
                'Quantidade',
                'Lote',
                'Validade',
                'Fornecedor',
                'Forma',
                'Status'
            ], ';');

            // Dados
            $niveisAlerta = $this->obterNiveisAlerta();
            foreach ($produtos as $produto) {
                $quantidade = $produto->quantidade ?? 0;
                $status = $this->calcularStatus($quantidade, $niveisAlerta);

                fputcsv($file, [
                    $produto->designacao . ($produto->dosagem ? ' ' . $produto->dosagem : ''),
                    $produto->grupo_farmaco ? $produto->grupo_farmaco->nome : 'Sem Categoria',
                    $quantidade,
                    $produto->num_lote ?? 'N/A',
                    $produto->data_expiracao ? $produto->data_expiracao->format('d/m/Y') : 'N/A',
                    $produto->fornecedor ?? 'N/A',
                    $produto->forma ?? 'N/A',
                    $status['label']
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Exporta produtos para PDF.
     *
     * @param Collection $produtos
     * @return \Illuminate\Http\Response
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    private function exportarPDF($produtos)
    {
        // Implementação básica - pode ser melhorada com DomPDF ou similar
        $filename = 'estoque_' . date('Y-m-d_His') . '.pdf';

        // Por enquanto, retorna HTML que pode ser impresso como PDF
        $html = view('diretor::pages.estoque.export-pdf', compact('produtos'))->render();

        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', "inline; filename=\"{$filename}\"");
    }
}
