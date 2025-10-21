<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

/**
 * Controlador de Documentos
 * 
 * Responsável pela gestão de documentos do sistema, incluindo
 * listagem, criação, upload e manipulação de ficheiros.
 * 
 * @author Augusto Kussema
 * @since 21/10/2025
 */
class DocumentsController extends Controller
{
    /**
     * Exibe a listagem de documentos
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('prepharma.documents.index');
    }

    /**
     * Exibe o formulário de criação de documentos
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('prepharma.documents.create');
    }
}
