<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Farmacia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'nome',
        'descricao',
        'status',
        'logo',
        'endereco',
        'obs',
    ];

    /**
     * Get all of the areas_hospitalares for the Farmacia
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function areas_hospitalares(): HasMany
    {
        return $this->hasMany(FarmaciaAreaHospitalar::class, 'farmacia_id');
    }

    public function gerente()
    {
        return $this->hasOne(GerenteFarmacia::class,'farmacia_id');
    }

    public function statDia()
    {
        $estatisticas = [];

        // Loop pelos dias da semana (segunda a domingo)
        for ($dia = Carbon::MONDAY; $dia <= Carbon::SUNDAY; $dia++) {
            // Obter o nome do dia da semana
            $nomeDia = Carbon::createFromFormat('N', $dia)->format('l');

            // Calcular a contagem de farmácias para o dia da semana atual
            $contagem = $this->calcularContagemParaDia($nomeDia);

            // Armazenar a contagem no array de estatísticas
            $estatisticas[$nomeDia] = $contagem;
        }

        return $estatisticas;
    }

    public static function calcularContagemParaDia($nomeDia)
    {
        // Converte o nome do dia da semana para o formato que está armazenado no banco de dados
        $diaFormatado = Carbon::createFromFormat('l', $nomeDia)->format('l');

        // Consulta ao banco de dados para contar o número de farmácias para o dia da semana especificado
        return Farmacia::whereRaw("DAYNAME(created_at) = '{$diaFormatado}'")->count();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model instanceof Farmacia) {
                if (!$model->codigo) {
                    $model->codigo = strtoupper(substr(preg_replace('/\s+/', '', $model->nome), 0, 4));
                }
                $model->id = Str::uuid();
            }
        });
    }
    protected static function generateCodigo($nome)
    {
        $codigo = strtoupper(substr(preg_replace('/\s+/', '', $nome), 0, 4));
        // Aqui você pode adicionar lógica para garantir que o código seja único, se necessário
        return $codigo;
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
