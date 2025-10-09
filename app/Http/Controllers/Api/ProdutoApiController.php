<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Estoque, ProdutoEstoque};
use Illuminate\Support\Facades\Log;

class ProdutoApiController extends Controller
{
    /**
     * Listar produtos por área hospitalar
     * 
     * @param int $areaId
     * @return \Illuminate\Http\JsonResponse
     */
    public function listarPorArea($areaId)
    {
        try {
            Log::info("🔍 Iniciando listagem de produtos", [
                'area_id' => $areaId,
                'user_id' => auth()->id(),
                'timestamp' => now()
            ]);

            // Verificar se área existe
            $area = \App\Models\AreaHospitalar::find($areaId);
            if (!$area) {
                Log::warning("❌ Área hospitalar não encontrada", ['area_id' => $areaId]);
                return response()->json([
                    'success' => false,
                    'message' => 'Área hospitalar não encontrada',
                    'data' => []
                ], 404);
            }

            Log::info("✅ Área hospitalar encontrada", [
                'area_id' => $areaId,
                'area_nome' => $area->nome
            ]);

            // Buscar produtos com relacionamentos
            $estoques = Estoque::with([
                'produto' => function($query) {
                    $query->with(['prateleira', 'saldo', 'status_stock']);
                }
            ])
            ->where('area_hospitalar_id', $areaId)
            ->get();

            Log::info("📊 Produtos encontrados", [
                'area_id' => $areaId,
                'total_produtos' => $estoques->count(),
                'produtos_ids' => $estoques->pluck('id')->toArray()
            ]);

            // Transformar dados para a DataTable
            $data = $estoques->map(function($estoque) {
                try {
                    $produto = $estoque->produto;
                    
                    if (!$produto) {
                        Log::warning("⚠️ Produto não encontrado para estoque", [
                            'estoque_id' => $estoque->id
                        ]);
                        return null;
                    }

                    return [
                        'id' => $estoque->id,
                        'produto' => [
                            'id' => $produto->id,
                            'designacao' => $produto->designacao ?? 'N/A',
                            'dosagem' => $produto->dosagem ?? 'N/A',
                            'forma' => $produto->forma ?? 'N/A',
                            'num_lote' => $produto->num_lote ?? 'N/A',
                            'data_expiracao' => $produto->data_expiracao,
                            'descritivo' => $produto->descritivo ?? '0x0x0',
                            'prateleira' => $produto->prateleira ? [
                                'nome' => $produto->prateleira->nome
                            ] : null,
                            'saldo' => $produto->saldo ? [
                                'qtd' => $produto->saldo->qtd ?? 0
                            ] : ['qtd' => 0],
                            'status_stock' => $produto->status_stock ? [
                                'critico' => $produto->status_stock->critico ?? 0,
                                'minimo' => $produto->status_stock->minimo ?? 0,
                                'medio' => $produto->status_stock->medio ?? 0,
                                'maximo' => $produto->status_stock->maximo ?? 0
                            ] : null
                        ],
                        'created_at' => $estoque->created_at,
                        'updated_at' => $estoque->updated_at
                    ];
                } catch (\Exception $e) {
                    Log::error("❌ Erro ao processar produto", [
                        'estoque_id' => $estoque->id,
                        'error' => $e->getMessage()
                    ]);
                    return null;
                }
            })->filter(); // Remove nulls

            Log::info("✅ Listagem concluída com sucesso", [
                'area_id' => $areaId,
                'produtos_processados' => $data->count()
            ]);

            return response()->json([
                'success' => true,
                'data' => $data->values(), // Reindexar array
                'total' => $data->count(),
                'area' => [
                    'id' => $area->id,
                    'nome' => $area->nome
                ]
            ]);

        } catch (\Exception $e) {
            Log::error("💥 Erro crítico na listagem de produtos", [
                'area_id' => $areaId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor',
                'error' => app()->environment('local') ? $e->getMessage() : 'Erro interno',
                'data' => []
            ], 500);
        }
    }

    /**
     * Excluir produto
     */
    public function destroy($id)
    {
        try {
            Log::info("🗑️ Tentativa de exclusão de produto", [
                'produto_id' => $id,
                'user_id' => auth()->id()
            ]);

            $produto = ProdutoEstoque::find($id);
            
            if (!$produto) {
                Log::warning("❌ Produto não encontrado para exclusão", ['produto_id' => $id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Produto não encontrado'
                ], 404);
            }

            // Verificar se há estoques associados
            $estoquesCount = Estoque::where('produto_estoque_id', $id)->count();
            
            Log::info("📊 Verificação de estoques", [
                'produto_id' => $id,
                'estoques_count' => $estoquesCount
            ]);

            if ($estoquesCount > 0) {
                // Excluir estoques primeiro
                Estoque::where('produto_estoque_id', $id)->delete();
                Log::info("🧹 Estoques removidos", ['produto_id' => $id]);
            }

            $produto->delete();

            Log::info("✅ Produto excluído com sucesso", [
                'produto_id' => $id,
                'produto_nome' => $produto->designacao
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Produto excluído com sucesso'
            ]);

        } catch (\Exception $e) {
            Log::error("💥 Erro ao excluir produto", [
                'produto_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir produto'
            ], 500);
        }
    }
}