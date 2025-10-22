<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProdutoEstoque;
use App\Models\User;

/**
 * Class ProductHistory
 *
 * Regista todas as operações feitas sobre produtos (criação, atualização, stock, preço, etc).
 *
 * Autor: Augusto Kussema
 * Data: 2025-10-22
 */
class ProductHistory extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'product_histories';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'product_id',
        'farmacia_id',
        'user_id',
        'action',
        'changes',
        'payload',
        'ip_address',
        'user_agent',
        'meta',
        'quantity_delta',
    ];

    protected $casts = [
        'changes' => 'array',
        'payload' => 'array',
        'meta' => 'array',
        'quantity_delta' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public const ACTIONS = [
        'created', 'updated', 'deleted', 'restored',
        'stock_in', 'stock_out', 'price_change', 'transfer', 'adjustment'
    ];

    /**
     * Relationship para o produto
     */
    public function product()
    {
        return $this->belongsTo(ProdutoEstoque::class, 'product_id');
    }

    /**
     * Relationship para o utilizador que executou a ação
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Resumo legível da mudança
     */
    public function summary(): string
    {
        $user = $this->user ? $this->user->name : 'Sistema';
        $when = $this->created_at ? $this->created_at->diffForHumans() : 'agora';
        $qty = $this->quantity_delta ? " ({$this->quantity_delta})" : '';
        return ucfirst($this->action) . " por {$user} {$when}{$qty}";
    }

    /**
     * Tenta aplicar rollback simples quando possível (apenas mudanças de stock/price)
     * Nota: ação destrutiva — deve ser usada com cautela e geralmente em processos auditados
     */
    public function applyRollback(): bool
    {
        // Implementação mínima: apenas para stock_in/stock_out
        if (!in_array($this->action, ['stock_in', 'stock_out'])) {
            return false;
        }

        $product = $this->product;
        if (!$product) return false;

        $delta = $this->quantity_delta ?? 0;
        if ($this->action === 'stock_in') {
            $product->quantity = max(0, $product->quantity - $delta);
        } else {
            $product->quantity = $product->quantity + abs($delta);
        }

        return $product->save();
    }
}
