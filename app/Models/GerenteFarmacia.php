<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GerenteFarmacia extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cargo',
        'farmacia_id',
        'contato',
    ];

    // Relação com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação com a farmácia
    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class);
    }
}
