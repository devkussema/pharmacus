<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DevController extends Controller
{
    public function levantamento()
    {
        return view('doc_generate.levantamentoEGato');
    }

    public function novo_doc()
    {
        return view('doc_generate.novoDoc');
    }
}
