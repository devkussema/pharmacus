<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permissao extends Model
{
    use HasFactory;

    protected $table = "permissoes";

    protected $fillable = [
        'conteudo',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function grupos()
    {
        return $this->belongsToMany(Grupo::class);
    }
}
