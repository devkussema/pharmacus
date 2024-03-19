<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    use HasFactory;

    protected $table = 'notificacoes';

    protected $fillable = [
        'titulo',
        'user_de',
        'user_para',
        'visto',
        'descricao'
    ];

    public function user_de()
    {
        return $this->belongsTo(User::class, 'user_de');
    }

    public function user_para()
    {
        return $this->belongsTo(User::class, 'user_para');
    }
}
