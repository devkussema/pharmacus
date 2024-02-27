<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Farmacia;
use App\Models\AreaHospitalar;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function home()
    {
        if (@auth()->user()->grupo->nome != "Administrador" and @auth()->user()->grupo->nome != "Admin" and @auth()->user()->grupo->nome == "Gerente") {
            if (@auth()->user()->grupo->nome == "Funcionário")
                return redirect()->route('estoque');
        }
        $farmacias = Farmacia::all();
        $areasHospitalares = AreaHospitalar::all();

        $contagemPorDia = [
            'Segunda-feira' => Farmacia::calcularContagemParaDia('Monday'),
            'Terça-feira' => Farmacia::calcularContagemParaDia('Tuesday'),
            'Quarta-feira' => Farmacia::calcularContagemParaDia('Wednesday'),
            'Quinta-feira' => Farmacia::calcularContagemParaDia('Thursday'),
            'Sexta-feira' => Farmacia::calcularContagemParaDia('Friday'),
        ];

        return view('home.show', compact('contagemPorDia'));
    }

    public function produto()
    {
        return view('produto.index');
    }

    public function categoria()
    {
        return view('categoria.index');
    }
}
