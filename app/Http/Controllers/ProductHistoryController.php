<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductHistory;
use App\Models\ProdutoEstoque;
use App\Models\AreaHospitalar;

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
                'created_at_fmt' => $item->created_at ? $item->created_at->format('d/m/Y H:i') : null,
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

        // mapeamento de campos técnicos para rótulos amigáveis
        $fieldNames = [
            'designacao' => 'Designação',
            'descritivo' => 'Descritivo',
            'num_lote' => 'Lote',
            'num_documento' => 'Documento Nº',
            'data_expiracao' => 'Data de Expiração',
            'data_producao' => 'Data de Produção',
            'obs' => 'Observação',
            'prateleira_id' => 'Prateleira',
            'qtd' => 'Quantidade',
            'qtd_embalagem' => 'Qtd. por Embalagem',
        ];

        switch ($item->action) {
            case 'stock_in':
                $from = $item->payload['from_product_id'] ?? null;
                $lote = $item->payload['num_lote'] ?? null;
                $areaId = $item->meta['area_hospitalar_id'] ?? null;
                $areaName = null;
                if ($areaId) {
                    $ah = AreaHospitalar::find($areaId);
                    $areaName = $ah ? $ah->nome : null;
                }
                $phrase = "{$user} recebeu " . abs($qty) . " unidades";
                if ($lote) $phrase .= " (lote {$lote})";
                if ($from) $phrase .= " de outro produto";
                if ($areaName) $phrase .= " na {$areaName}";
                return $phrase;

            case 'stock_out':
                $toAreaId = $item->payload['to_area'] ?? $item->meta['area_hospitalar_id'] ?? null;
                $lote = $item->payload['num_lote'] ?? null;
                $areaName = null;
                if ($toAreaId) {
                    $ah = AreaHospitalar::find($toAreaId);
                    $areaName = $ah ? $ah->nome : null;
                }
                $phrase = "{$user} deu baixa de " . abs($qty) . " unidades";
                if ($lote) $phrase .= " (lote {$lote})";
                if ($areaName) $phrase .= " para {$areaName}";
                return $phrase;

            case 'created':
                $designacao = $item->payload['designacao'] ?? null;
                $descritivo = $item->payload['descritivo'] ?? null;
                if ($designacao) {
                    return "{$user} adicionou o produto '{$designacao}'" . ($descritivo ? " ({$descritivo})" : '');
                }
                return "{$user} criou o produto";

            case 'updated':
                $changes = $item->changes ?? [];
                if (is_array($changes) && count($changes) > 0) {
                    $fields = array_keys($changes);
                    $labels = array_map(function ($f) use ($fieldNames) {
                        return $fieldNames[$f] ?? ucfirst(str_replace('_', ' ', $f));
                    }, $fields);
                    $count = count($labels);
                    if ($count === 1) {
                        return "{$user} atualizou o campo: {$labels[0]}";
                    }
                    // até 3 campos listados, o resto agrupa
                    $listed = array_slice($labels, 0, 3);
                    $rest = $count - count($listed);
                    $joined = implode(', ', $listed);
                    if ($rest > 0) $joined .= " e mais {$rest}";
                    return "{$user} atualizou {$count} campos: {$joined}";
                }
                return "{$user} atualizou o produto";

            case 'deleted':
                $designacao = $item->payload['designacao'] ?? null;
                return $designacao ? "{$user} eliminou o produto {$designacao}" : "{$user} eliminou o produto";

            case 'transfer':
                return "{$user} realizou uma transferência ({abs($qty)} unidades)";

            default:
                return ucfirst($item->action) . ' por ' . $user;
        }
    }
}
