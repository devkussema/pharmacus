<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class GerenteFarmacia extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'cargo',
        'farmacia_id',
        'contato',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->id = Uuid::uuid4()->toString();
        });
    }

    // Relação com o usuário
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relação com a farmácia
    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class, 'farmacia_id');
    }
}
