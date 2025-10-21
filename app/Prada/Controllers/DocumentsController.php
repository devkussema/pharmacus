<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class DocumentsController extends Controller
{
    public function index()
    {
        return view('documents.index');
    }
}
