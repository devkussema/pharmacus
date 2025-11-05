<?php

namespace Modules\Diretor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controlador para gestão de fornecedores do módulo Diretor.
 *
 * @author Augusto Kussema
 * @created 05-11-2025
 */
class FornecedoresController extends Controller
{
    /**
     * Exibe a listagem dos fornecedores.
     *
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function index()
    {
        return view('diretor::pages.fornecedores.index');
    }

    /**
     * Mostra o formulário para criar um novo fornecedor.
     *
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function create()
    {
        return view('diretor::pages.fornecedores.create');
    }

    /**
     * Armazena um novo fornecedor.
     *
     * @param Request $request
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function store(Request $request)
    {
        // TODO: Implementar lógica de armazenamento
        return redirect()->route('diretor.fornecedores.index')
            ->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Exibe um fornecedor específico.
     *
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function show($id)
    {
        return view('diretor::pages.fornecedores.show', compact('id'));
    }

    /**
     * Mostra o formulário para editar um fornecedor.
     *
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function edit($id)
    {
        return view('diretor::pages.fornecedores.edit', compact('id'));
    }

    /**
     * Atualiza um fornecedor específico.
     *
     * @param Request $request
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function update(Request $request, $id)
    {
        // TODO: Implementar lógica de atualização
        return redirect()->route('diretor.fornecedores.index')
            ->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remove um fornecedor específico.
     *
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function destroy($id)
    {
        // TODO: Implementar lógica de remoção
        return redirect()->route('diretor.fornecedores.index')
            ->with('success', 'Fornecedor removido com sucesso!');
    }
}