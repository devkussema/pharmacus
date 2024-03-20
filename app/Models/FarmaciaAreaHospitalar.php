<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FarmaciaAreaHospitalar extends Model
{
    use HasFactory;

    protected $table = 'farmacia_areas_hospitalares';

    protected $fillable = [
        'farmacia_id',
        'area_hospitalar_id',
        'fah_id',
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
