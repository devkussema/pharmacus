<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaHospitalar extends Model
{
    use HasFactory;

    protected $table = 'areas_hospitalares';

    protected $fillable = [
        'nome',
        'descricao'
    ];
}
