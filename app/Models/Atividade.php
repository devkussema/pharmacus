<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'texto'
    ];

    public function user()
    {
        return $this>belongsTo(User::class, 'user_id');
    }
}
