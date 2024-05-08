<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Atividade};

class GetAtividadeController extends Controller
{
    public function getAllAtividade()
    {
        return Atividade::with('user')->get();
    }
}
