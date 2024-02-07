<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Farmacia extends Model
{
    use HasFactory;

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

        static::creating(function ($user) {
            $user->id = Uuid::uuid4()->toString();
        });
    }
}
