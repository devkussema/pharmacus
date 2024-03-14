<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmaciaAreaHospitalar extends Model
{
    use HasFactory;

    protected $table = 'farmacia_areas_hospitalares';

    protected $fillable = [
        'farmacia_id',
        'area_hospitalar_id'
    ];

    public function area_hospitalar()
    {
        return $this->belongsTo(AreaHospitalar::class, 'area_hospitalar_id');
    }

    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class, 'farmacia_id');
    }
}
