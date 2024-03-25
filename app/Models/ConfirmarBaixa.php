<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConfirmarBaixa extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_hospitalar_de',
        'area_hospitalar_para',
        'confirmado'
    ];

    public function area_hospitalar_de()
    {
        return $this->belongsTo(AreaHospitalar::class, 'area_hospitalar_de');
    }

    /**
     * Get the area_hospitalar_para that owns the ConfirmarBaixa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area_hospitalar_para(): BelongsTo
    {
        return $this->belongsTo(AreaHospitalar::class, 'area_hospitalar_para');
    }
}
