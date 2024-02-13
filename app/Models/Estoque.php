<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_estoque_id',
        'tipo',
        'area_hospitalar_id'
    ];

    public function area_hospitalar()
    {
        return $this->belongsTo(AreaHospitalar::class, 'area_hospitalar_id');
    }

    public function produto()
    {
        return $this->belongsTo(ProdutoEstoque::class, 'produto_estoque_id');
    }
}
