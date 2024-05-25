<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'area_de',
        'area_para',
        'confirmado',
        'itens',
    ];

    protected $casts = [
        'itens' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
