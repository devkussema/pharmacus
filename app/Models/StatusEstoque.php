<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusEstoque extends Model
{
    use HasFactory;

    protected $table = 'status_estoque';
    protected $fillable = ['produto_id', 'critico', 'minimo', 'medio', 'maximo'];

    public function produto()
    {
        return $this->belongsTo(ProdutoEstoque::class, 'produto_id');
    }
}
