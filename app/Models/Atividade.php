<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    use HasFactory;

    /**
     * Campos mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'user_id',
        'texto',
        // Metadados de auditoria (opcionais — migration poderá adicioná-los posteriormente)
        'action',
        'model_type',
        'model_id',
        'changes',
        'snapshot_before',
        'snapshot_after',
        'ip_address',
        'route',
        'http_method',
        'correlation_id',
        'level',
        'sensitive',
        'actor_role',
        'user_name'
    ];

    /**
     * Casts para colunas JSON e datas.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'changes' => 'array',
        'snapshot_before' => 'array',
        'snapshot_after' => 'array',
        'sensitive' => 'boolean',
        'created_at' => 'datetime',
    ];

    /**
     * Relação com o utilizador que fez a atividade.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
