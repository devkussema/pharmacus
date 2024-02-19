<?php

namespace App\Traits;

use App\Models\Atividade;

trait AtividadeTrait
{
    public static function startAtv($texto)
    {
        Atividade::create([
            'texto' => $texto,
            'user_id' => auth()->user()->id
        ]);

        return true;
    }
}
