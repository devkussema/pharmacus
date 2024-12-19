<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prateleira extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'status'];
}
