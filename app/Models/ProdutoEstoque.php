<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoEstoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'designacao',
        'dosagem',
        'forma',
        'origem_destino',
        'num_lote',
        'data_expiracao',
        'data_producao',
        'num_documento',
        'obs',
        'qtd_embalagem',
        'grupo_farmaco_id'
    ];

    public function grupo_farmaco()
    {
        return $this->belongsTo(GrupoFarmacologico::class, 'grupo_farmaco_id');
    }

    public function estoque()
    {
        return $this->hasMany(Estoque::class, 'produto_estoque_id');
    }

    public function saldo()
    {
        return $this->hasOne(SaldoEstoque::class, 'produto_estoque_id');
    }
}
