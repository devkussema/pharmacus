<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatorioEstoqueAlerta extends Model
{
    use HasFactory;

    protected $table = "relatorio_estoque_alerta";

    protected $primaryKey = 'id';


    protected $fillable = [
        'nivel_alerta_id',
        'produto_estoque_id'
    ];

    public function produto()
    {
        return $this->belongsTo(ProdutoEstoque::class, 'produto_estoque_id');
    }

    public function nivel_alerta()
    {
        return $this->belongsTo(NivelAlerta::class, 'nivel_alerta_id');
    }
}
