<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    User, GerenteFarmacia as GF
};

class FuncionarioController extends Controller
{
    public function index()
    {
        $usrs = [];
        if (@Auth::user()->isFarmacia->farmacia->id) {
            $usrs = User::with('area_hospitalar.area_hospitalar')
                ->whereHas('area_hospitalar.area_hospitalar', function ($query) {
                    $query->where('farmacia_id', Auth::user()->isFarmacia->farmacia->id);
                })
                ->get();
        }else{
            $usrs = GF::with('user')->get();
        }
        return view('funcionario.list', compact('usrs'));
        //return view('perfil.view');
    }
}
