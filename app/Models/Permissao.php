<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Classe Permissao
 *
 * Representa permissões atribuídas a um utilizador (campo JSON em `conteudo`).
 *
 * Autor: Augusto Kussema
 * Data: 01/10/2025
 */
class Permissao extends Model
{
    use HasFactory;

    protected $table = "permissoes";

    protected $fillable = [
        'conteudo',
        'user_id'
    ];

    /**
     * Casts de atributos
     *
     * @var array<string, string>
     */
    protected $casts = [
        'conteudo' => 'array',
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
