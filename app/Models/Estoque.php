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
        'farmacia_id',
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
        // Para manter o model reutilizável, este método aceita parâmetros
        // opcionais. Se nenhum parâmetro for passado, retorna o total por
        // grupo farmacológico para todos os estoques.
        $args = func_get_args();
        $areaHospitalarId = $args[0] ?? null;
        $farmaciaId = $args[1] ?? null;

        $query = DB::table('estoques')
            ->join('produto_estoques', 'estoques.produto_estoque_id', '=', 'produto_estoques.id')
            ->leftJoin('saldo_estoques as saldo', 'produto_estoques.id', '=', 'saldo.produto_estoque_id')
            ->select('produto_estoques.grupo_farmaco_id', DB::raw('SUM(COALESCE(saldo.qtd,0)) as total_produtos'))
            ->groupBy('produto_estoques.grupo_farmaco_id');

        if ($areaHospitalarId) {
            $query->where('estoques.area_hospitalar_id', $areaHospitalarId);
        }

        if ($farmaciaId) {
            $query->where('estoques.farmacia_id', $farmaciaId);
        }

        return $query->get();
    }
}
