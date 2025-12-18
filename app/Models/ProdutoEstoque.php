<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\GrupoFarmacologico;
use App\Models\Estoque;
use App\Models\SaldoEstoque;
use App\Models\Prateleira;
use App\Models\Fornecedor;
// Not importing StatusStock/History directly to avoid hard dependency in case models are named differently.

/**
 * ProdutoEstoque
 *
 * author: Augusto Kussema
 * data: 2025-11-03 14:30 (Luanda time)
 *
 * Breve descrição: Modelo que representa uma entrada de produto no estoque. Mantém o campo
 * `descritivo` conforme solicitado e introduz o campo `quantidade` em substituição ao
 * antigo `qtd_embalagem`.
 */
class ProdutoEstoque extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * Combinei campos antigos e novos para compatibilidade com o restante da aplicação.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'produto_id',
        'designacao',
        'dosagem',
        'forma',
        'origem_destino',
        'descritivo',
        'quantidade',
        'num_lote',
        'data_expiracao',
        'data_producao',
        'data_recepcao',
        'validade',
        'fornecedor',
        'fornecedor_id',
        'num_documento',
        'status',
        'obs',
        'tipo',
        'grupo_farmaco_id',
        'confirmado',
        'prateleira_id',
    ];

    /**
     * Attribute casting.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'validade' => 'date',
        'data_expiracao' => 'date',
        'data_producao' => 'date',
        'data_recepcao' => 'date',
        'quantidade' => 'integer',
    ];

    public function grupo_farmaco()
    {
        return $this->belongsTo(GrupoFarmacologico::class, 'grupo_farmaco_id');
    }

    public function estoque()
    {
        return $this->hasOne(Estoque::class, 'produto_estoque_id');
    }

    public function saldo()
    {
        return $this->hasOne(SaldoEstoque::class, 'produto_estoque_id');
    }

    public function prateleira()
    {
        return $this->belongsTo(Prateleira::class, 'prateleira_id');
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function status_stock()
    {
        return $this->hasOne(StatusEstoque::class, 'produto_id');
    }

    /**
     * Histórico de operações deste produto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories()
    {
        return $this->hasMany(ProductHistory::class, 'product_id');
    }
}
