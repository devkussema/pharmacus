<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    User
};

class FuncionarioController extends Controller
{
    public function index()
    {
        $usrs = User::with('area_hospitalar.area_hospitalar')
            ->whereHas('area_hospitalar.area_hospitalar', function ($query) {
                $query->where('farmacia_id', Auth::user()->isFarmacia->farmacia->id);
            })
            ->get();
        return view('funcionario.add', compact('usrs'));
        //return view('perfil.view');
    }
}
