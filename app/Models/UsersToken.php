<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
        'nome',
        'last_used_at',
        'expires_at',
    ];

    protected $dates = [
        'last_used_at',
        'expires_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeValid($query)
    {
        return $query->where('expires_at', '>', now());
    }

    public function isValid()
    {
        return $this->expires_at > now();
    }
}
