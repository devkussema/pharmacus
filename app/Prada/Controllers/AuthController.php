<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registar()
    {
        return view('auth.registar');
    }
}
