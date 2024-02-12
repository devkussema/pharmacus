<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAreaHospitalar extends Model
{
    use HasFactory;

    protected $table = "";

    protected $fillable = [
        'user_id',
        'area_hospitalar_id',
        'cargo_id',
        'contato'
    ];

    // No modelo User.php
    public function areasHospitalares()
    {
        return $this->belongsToMany(AreaHospitalar::class, 'user_area_hospitalar')
            ->withPivot('cargo_id', 'contato')
            ->withTimestamps();
    }

    // No modelo AreaHospitalar.php
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'user_area_hospitalar')
            ->withPivot('cargo_id', 'contato')
            ->withTimestamps();
    }

}
