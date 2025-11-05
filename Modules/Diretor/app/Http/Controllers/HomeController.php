<?php

namespace Modules\Diretor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Exibe o dashboard do módulo Diretor (lista/principal).
     *
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function index()
    {
        return view('diretor::pages.dashboard');
    }

    /**
     * Mostra o formulário para criar um novo recurso.
     *
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function create()
    {
        return view('diretor::pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Exibe um recurso específico.
     *
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function show($id)
    {
        return view('diretor::pages.show', compact('id'));
    }

    /**
     * Mostra o formulário para editar o recurso.
     *
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function edit($id)
    {
        return view('diretor::pages.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
