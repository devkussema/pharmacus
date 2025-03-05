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
        return view('estoque.add_stock.add', compact('area'));
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
                StatusEstoque::create([
                    'produto_id' => $produto_id,
                    'critico' => $request->critico,
                    'minimo' => $request->minimo,
                    'medio' => $request->medio,
                    'maximo' => $request->maximo,
                ]);
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
}
