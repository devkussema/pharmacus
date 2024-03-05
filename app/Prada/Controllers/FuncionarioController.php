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
        $cfg = 0;
        if (@Auth::user()->isFarmacia->farmacia->id) {
            $usrs = User::with('area_hospitalar.area_hospitalar')
                ->whereHas('area_hospitalar.area_hospitalar', function ($query) {
                    $query->where('farmacia_id', Auth::user()->isFarmacia->farmacia->id);
                })
                ->get();
                $cfg = 1;
        }else{
            $usrs = GF::with('user')->get();
            $cfg = 2;
        }
        return view('funcionario.list', compact('usrs', 'cfg'));
        //return view('perfil.view');
    }
}
