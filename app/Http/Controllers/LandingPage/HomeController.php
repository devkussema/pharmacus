<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view("korona.home");
    }

    public function blog_single()
    {
        return view("korona.blog-single");
    }
}
