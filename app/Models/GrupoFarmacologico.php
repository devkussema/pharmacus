<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoFarmacologico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao'
    ];

    public function produtos()
    {
        return $this->hasMany(ProdutoEstoque::class, 'grupo_farmaco_id');
    }


}
