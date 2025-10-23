<?php

namespace App\Observers;

use App\Models\ProdutoEstoque;
use App\Models\ProductHistory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

/**
 * Observer para ProdutoEstoque — regista alterações em product_histories
 * Autor: Augusto Kussema
 * Data: 2025-10-22
 */
class ProdutoEstoqueObserver
{
    /**
     * Mapa temporário para sinalizar origem de alterações (em memória) por produto_id.
     * Evita persistir flags no modelo/DB.
     *
     * @var array<int,string>
     */
    protected static array $origins = [];

    /**
     * Marca um produto com a origem da alteração (ex: 'baixa').
     *
     * @param int|string $productId
     * @param string $origin
     * @return void
     */
    public static function markOrigin($productId, string $origin): void
    {
        self::$origins[(string)$productId] = $origin;
    }
    protected function makeHistory(ProdutoEstoque $model, string $action, array $extra = []) : ProductHistory
    {
    /** @var \App\Models\User|null $user */
    $user = Auth::user();
        $changes = [];

        // Para created, registra o payload completo; para updated, diffs
        if ($action === 'created') {
            $payload = $model->getAttributes();
        } else {
            $payload = $model->getChanges();
            $original = method_exists($model, 'getOriginal') ? $model->getOriginal() : [];
            foreach ($payload as $k => $v) {
                $changes[$k] = [
                    'old' => $original[$k] ?? null,
                    'new' => $v,
                ];
            }
        }

        $history = ProductHistory::create([
            'product_id' => $model->id,
            'farmacia_id' => $extra['farmacia_id'] ?? ($model->estoque->farmacia_id ?? null),
            'user_id' => $user->id ?? null,
            'action' => $action,
            'changes' => $changes ?: null,
            'payload' => $payload ?: null,
            'ip_address' => request()->ip() ?? null,
            'user_agent' => request()->header('User-Agent') ?? null,
            'meta' => $extra['meta'] ?? null,
            'quantity_delta' => $extra['quantity_delta'] ?? null,
        ]);

        return $history;
    }

    public function created(ProdutoEstoque $model)
    {
        $this->makeHistory($model, 'created');
    }

    public function updated(ProdutoEstoque $model)
    {
        // ignore if no meaningful changes
        if (empty($model->getChanges())) return;

        // se a alteração foi originada por uma operação de baixa, suprimimos o 'updated'
        // para evitar duplicação com o 'stock_out' criado explicitamente em baixa().
        $productId = $model->id ?? null;
        if ($productId && isset(self::$origins[(string)$productId]) && self::$origins[(string)$productId] === 'baixa') {
            // limpar a flag do mapa
            unset(self::$origins[(string)$productId]);
            return;
        }

        $this->makeHistory($model, 'updated');
    }

    public function deleted(ProdutoEstoque $model)
    {
        $this->makeHistory($model, 'deleted');
    }
}
