<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class TerminalController extends Controller
{
    public function runCommand(Request $request)
    {
        // Recebe o comando da requisição
        $command = $request->input('command');

        // Executa o comando Artisan e captura a saída
        Artisan::call($command);
        $output = Artisan::output();

        // Retorna a saída para o frontend
        return response()->json(['output' => nl2br($output)]);  // Usando nl2br para manter a formatação de nova linha
    }
}
