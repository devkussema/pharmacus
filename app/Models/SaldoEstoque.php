<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoEstoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_estoque_id',
        'qtd'
    ];

    public function produtos()
    {
        return $this->belongsTo(ProdutoEstoque::class, 'produto_estoque_id');
    }
}
