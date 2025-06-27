<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\StatusEstoque;
use App\Models\ProdutoEstoque;

class StockController extends Controller
{
    public function add_estoque_minimo(Request $request, $area)
    {
        // Filtros opcionais
        $statusFiltro = $request->input('status');

        // Buscar produtos com saldo e status_stock
        $produtos = ProdutoEstoque::with(['saldo', 'status_stock'])
            ->whereHas('saldo') // Garante que apenas produtos com saldo sejam incluídos
            ->get()
            ->map(function ($produto) {
                return [
                    'produto' => [
                        'designacao' => $produto->designacao,
                        'dosagem' => $produto->dosagem,
                        'data_expiracao' => $produto->data_expiracao,
                        'saldo' => $produto->saldo ? ['qtd' => $produto->saldo->qtd] : null,
                    ],
                    'critico' => $produto->status_stock?->critico ?? null,
                    'minimo' => $produto->status_stock?->minimo ?? null,
                    'medio' => $produto->status_stock?->medio ?? null,
                ];
            });

        //return response()->json(['data' => $produtos]);

        return view('estoque.add_stock.add', compact('area', 'produtos'));
    }

    public function store_stock(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'area_para' => 'required|integer',
            'itens' => 'required|array',
            'itens.*' => 'exists:produto_estoques,id',
            'critico' => 'required|numeric|min:0',
            'minimo' => 'required|numeric|min:0',
            'medio' => 'required|numeric|min:0',
            'maximo' => 'required|numeric|min:0',
        ]);

        try {
            foreach ($request->itens as $produto_id) {
                $get_ = StatusEstoque::where('produto_id', $produto_id)->first();

                if (!$get_) { // Se não existir, cria um novo registro
                    StatusEstoque::create([
                        'produto_id' => $produto_id,
                        'critico' => $request->critico,
                        'minimo' => $request->minimo,
                        'medio' => $request->medio,
                        'maximo' => $request->maximo,
                    ]);
                } else { // Se já existir, faz update
                    $get_->update([
                        'critico' => $request->critico,
                        'minimo' => $request->minimo,
                        'medio' => $request->medio,
                        'maximo' => $request->maximo,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Estoque atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao salvar: ' . $e->getMessage());
        }
    }

    public function filtrarEstoque(Request $request)
    {
        $status = $request->status; // Pegando o filtro
        \Log::info("Status recebido:", ['status' => $status]); // Confirmação no log

        // Pegando os produtos e status
        $query = StatusEstoque::with('produto');

        // Aplicando o filtro de status
        if (!empty($status)) {
            $query->whereHas('produto', function ($q) use ($status) {
                switch ($status) {
                    case 'critico':
                        $q->whereColumn('saldo.qtd', '<=', 'status_estoques.critico');
                        break;
                    case 'minimo':
                        $q->whereColumn('saldo.qtd', '>', 'status_estoques.critico')
                        ->whereColumn('saldo.qtd', '<=', 'status_estoques.minimo');
                        break;
                    case 'medio':
                        $q->whereColumn('saldo.qtd', '>', 'status_estoques.minimo')
                        ->whereColumn('saldo.qtd', '<=', 'status_estoques.medio');
                        break;
                    case 'estavel':
                        $q->whereColumn('saldo.qtd', '>', 'status_estoques.medio');
                        break;
                }
            });
        }

        $data = $query->get();
        \Log::info("Produtos filtrados:", $data->toArray()); // Verifica se está filtrando certo

        return response()->json(['data' => $data]);
    }

    public function status_produto(Request $request, $id) {
        $farmacia_id = auth()->user()->isFarmacia->farmacia->id ?? auth()->user()->farmacia->farmacia->id;
        $produtos = StatusEstoque::with('produto.prateleira')
            ->with('produto.saldo')
            ->with(['produto' => function ($query) {
                $query->orderBy('designacao', 'ASC');
            }])
            ->get();

        return response()->json(["data" => $produtos]);
    }

    /**
     * Atualiza os estados de estoque (crítico, mínimo, médio, máximo) via AJAX.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_status_produto(Request $request, $id)
    {
        $validated = $request->validate([
            'critico' => 'required|numeric|min:0',
            'minimo' => 'required|numeric|min:0',
            'medio' => 'required|numeric|min:0',
            'maximo' => 'required|numeric|min:0',
        ]);

        try {
            $status = StatusEstoque::findOrFail($id);
            $status->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'Status de estoque atualizado com sucesso.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar status: ' . $e->getMessage()
            ], 500);
        }
    }
}
