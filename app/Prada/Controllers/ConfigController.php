<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function index()
    {
        return view('config.site');
    }
}
