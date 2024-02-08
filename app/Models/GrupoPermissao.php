<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoPermissao extends Model
{
    use HasFactory;

    protected $table = "grupo_permissoes";

    protected $fillable = ['grupo_id', 'permissao_id'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    // Relacionamento com a model Permissao
    public function permissao()
    {
        return $this->belongsTo(Permissao::class);
    }
}
