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
    ];

    public function user_de()
    {
        return $this->belongsTo(User::class, 'user_de');
    }

    public function user_para()
    {
        return $this->belongsTo(User::class, 'user_para');
    }

    public function area_de()
    {
        return $this->belongsTo(FarmaciaAreaHospitalar::class, 'area_de');
    }

    public function area_para()
    {
        return $this->belongsTo(FarmaciaAreaHospitalar::class, 'area_para');
    }

    public function item()
    {
        return $this->belongsTo(ProdutoEstoque::class, 'item_id');
    }
}
