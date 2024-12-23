<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\{HasManyThrough};

class AreaHospitalar extends Model
{
    use HasFactory;

    protected $table = 'areas_hospitalares';

    protected $fillable = [
        'nome',
        'descricao',
        'farmacia_id'
    ];

    /**
     * Get all of the farmacias for the AreaHospitalar
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function farmacias(): HasManyThrough
    {
        return $this->hasManyThrough(Farmacia::class, FarmaciaAreaHospitalar::class, 'farmacia_id', 'area_hospitalar_id');
    }

    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class, 'farmacia_id');
    }

    public function isGerente()
    {
        return $this->hasOne(UserAreaHospitalar::class, 'area_hospitalar_id');
    }

    public static function calcularContagemParaDia($nomeDia)
    {
        // Converte o nome do dia da semana para o formato que está armazenado no banco de dados
        $diaFormatado = Carbon::createFromFormat('l', $nomeDia)->format('l');

        // Consulta ao banco de dados para contar o número de farmácias para o dia da semana especificado
        return AreaHospitalar::whereRaw("DAYNAME(created_at) = '{$diaFormatado}'")->count();
    }
}
