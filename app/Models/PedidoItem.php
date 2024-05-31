<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;

    protected $table = 'pedido_itens';

    protected $fillable = [
        'user_de',
        'user_para',
        'area_de',
        'area_para',
        'confirmado',
        'item_id',
        'gastos',
        'existencia',
        'qtd_pedida',
        'qtd_disponibilizada'
    ];

    public function user_a()
    {
        return $this->belongsTo(User::class, 'user_de');
    }

    public function user_b()
    {
        return $this->belongsTo(User::class, 'user_para');
    }

    public function area_a()
    {
        return $this->belongsTo(AreaHospitalar::class, 'area_de');
    }

    public function area_b()
    {
        return $this->belongsTo(FarmaciaAreaHospitalar::class, 'area_para');
    }

    public function item()
    {
        return $this->belongsTo(ProdutoEstoque::class, 'item_id');
    }
}
