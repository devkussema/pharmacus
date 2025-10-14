<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class UserAuthLog extends Model
{
    use HasFactory;

    protected $table = 'user_auth_logs';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'action',
        'status',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (UserAuthLog $model) {
            if (empty($model->id)) {
                // gerar UUID curto (usamos substr do uuid v4 para manter mais curto conforme solicitado)
                $model->id = substr(Uuid::uuid4()->toString(), 0, 16);
            }
        });
    }
}
