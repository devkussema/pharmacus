<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductHistory;
use App\Models\ProdutoEstoque;

class ProductHistoryController extends Controller
{
    /**
     * Retorna histórico de um produto em JSON.
     * GET /api/product-history/{id}
     */
    public function index(Request $request, $id)
    {
        $q = $request->query('q');
        $from = $request->query('from');
        $to = $request->query('to');
        $perPage = (int) $request->query('per_page', 20);

        $query = ProductHistory::with('user')
            ->where('product_id', $id)
            ->orderBy('created_at', 'desc');

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('action', 'like', "%{$q}%")
                    ->orWhere('payload', 'like', "%{$q}%")
                    ->orWhere('changes', 'like', "%{$q}%");
                // user name search via relation
                $sub->orWhereHas('user', function ($u) use ($q) {
                    $u->where('nome', 'like', "%{$q}%")->orWhere('name', 'like', "%{$q}%");
                });
            });
        }

        if ($from || $to) {
            try {
                $fromDate = $from ? \Carbon\Carbon::parse($from)->startOfDay() : null;
                $toDate = $to ? \Carbon\Carbon::parse($to)->endOfDay() : null;
                if ($fromDate && $toDate) {
                    $query->whereBetween('created_at', [$fromDate, $toDate]);
                } elseif ($fromDate) {
                    $query->where('created_at', '>=', $fromDate);
                } elseif ($toDate) {
                    $query->where('created_at', '<=', $toDate);
                }
            } catch (\Throwable $e) {
                // ignora erros de parse e continua sem filtro de datas
            }
        }

    $p = $query->paginate($perPage)->appends($request->query());

        // Obter dados do produto para cabeçalho
        $product = ProdutoEstoque::find($id);

        // Transformar os items para adicionar formatações amigáveis
        $data = $p->getCollection()->map(function ($item) {
            return [
                'id' => $item->id,
                'action' => $item->action,
                'changes' => $item->changes,
                'payload' => $item->payload,
                'quantity_delta' => $item->quantity_delta,
                'user' => $item->user ? ['id' => $item->user->id, 'name' => $item->user->nome ?? $item->user->name] : null,
                'created_at' => $item->created_at ? $item->created_at->toIso8601String() : null,
                'created_at_human' => $item->created_at ? $item->created_at->diffForHumans() : null,
                'created_at_fmt' => $item->created_at ? $item->created_at->format('d-m-Y H:i') : null,
                // resumo em português legível
                'summary_pt' => $this->makeSummaryPt($item),
            ];
        });

        $meta = [
            'total' => $p->total(),
            'per_page' => $p->perPage(),
            'current_page' => $p->currentPage(),
            'last_page' => $p->lastPage(),
        ];

        return response()->json([
            'product' => $product ? ['id' => $product->id, 'designacao' => $product->designacao, 'descritivo' => $product->descritivo] : null,
            'data' => $data,
            'meta' => $meta
        ], 200);
    }

    /**
     * Gera uma frase resumida em Português para exibição rápida
     */
    protected function makeSummaryPt(ProductHistory $item): string
    {
        $user = $item->user ? ($item->user->nome ?? $item->user->name) : 'Sistema';
        $qty = $item->quantity_delta ?? 0;
        switch ($item->action) {
            case 'stock_in':
                return "{$user} adicionou {$qty} unidades";
            case 'stock_out':
                return "{$user} removeu " . abs($qty) . " unidades";
            case 'created':
                return "{$user} criou o produto";
            case 'updated':
                return "{$user} atualizou o produto";
            case 'deleted':
                return "{$user} eliminou o produto";
            case 'transfer':
                return "{$user} realizou uma transferência ({$qty} unidades)";
            default:
                return ucfirst($item->action) . ' por ' . $user;
        }
    }
}
