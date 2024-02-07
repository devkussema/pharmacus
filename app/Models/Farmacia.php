<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class Farmacia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'nome',
        'descricao',
        'logo',
        'endereco',
        'obs',
    ];

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
