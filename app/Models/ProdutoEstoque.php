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
        'quantidade_por_embalagem',
    ];
}
