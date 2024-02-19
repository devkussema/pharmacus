<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelAlerta extends Model
{
    use HasFactory;

    protected $table = "niveis_alerta";

    protected $fillable = [
        'nome'
    ];
}
