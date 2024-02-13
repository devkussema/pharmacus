<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAreaHospitalar extends Model
{
    use HasFactory;

    protected $table = "user_area_hospitalar";

    protected $fillable = [
        'user_id',
        'area_hospitalar_id',
        'cargo_id',
        'contato'
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    public function area_hospitalar()
    {
        return $this->belongsTo(AreaHospitalar::class, 'area_hospitalar_id');
    }

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
