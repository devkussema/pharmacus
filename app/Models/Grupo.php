<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function permissoes()
    {
        return $this->belongsToMany(Permissao::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
