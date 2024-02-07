<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function home()
    {
        return view('home.show');
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
