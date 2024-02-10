<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class AreaHospitalarController extends Controller
{
    public function index()
    {
        return view('area_hospitalar.show');
    }
}
