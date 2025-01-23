<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class AlertController extends Controller
{
    public function index()
    {
        return view('alert.show');
    }
}
