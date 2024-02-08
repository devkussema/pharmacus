<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    use HasFactory;

    protected $table = "permissoes";

    protected $fillable = [
        'conteudo'
    ];

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class);
    }
}
