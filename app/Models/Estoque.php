<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getTotalProdutosPorGrupoFarmacologico()
    {
        // Obtém todos os grupos farmacológicos com o total de produtos
        $gruposComTotalProdutos = Estoque::withCount([
            'produto' => function ($query) {
                $query->select('grupo_farmaco_id', DB::raw('SUM(saldo.qtd) as total_produtos'))
                    ->leftJoin('saldo_estoques as saldo', 'produto_estoque_id', '=', 'saldo.produto_estoque_id')
                    ->groupBy('grupo_farmaco_id');
            }
        ])->where('estoques.area_hospitalar_id', auth()->user()->area_hospitalar->area_hospitalar_id)->get();

        // Agora você tem uma coleção de grupos farmacológicos com o total de produtos
        return $gruposComTotalProdutos;
    }
}
