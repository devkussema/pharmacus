<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function index()
    {
        return view('preview::home');
    }


    public function login()
    {
        return view('preview::login');
    }

    public function registar()
    {
        return view('preview::registar');
    }

    public function recuperarSenha()
    {
        return view('preview::recuperar_senha');
    }

    public function resetSenhaForm(Request $request)
    {
        // Na aplicação real, você validaria o token aqui
        // $token = $request->token;
        // $email = $request->email; // Se o email também vier na URL
        return view('preview::reset_senha'); //, compact('token', 'email'));
    }

    public function resetSenhaSuccess()
    {
        return view('preview::reset_senha_success');
    }

    /**
     * Exibe uma página do dashboard de preview.
     *
     * @param  string  $page O nome da página a ser exibida (padrão: 'index').
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function dashboardPage($page = 'index')
    {
        $viewPath = 'preview::dashboard.' . $page; // Constrói o caminho da view. Ex: preview::dashboard.settings

        if (view()->exists($viewPath)) {
            return view($viewPath);
        }
        abort(404); // Se a view não existir, retorna um erro 404
    }
}
