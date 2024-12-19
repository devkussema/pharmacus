<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class TerminalController extends Controller
{
    public function runCommand(Request $request)
    {
        try {
            // Recebe o comando do frontend
            $command = $request->input('command');

            // Chama o comando Artisan
            $output = Artisan::call($command);

            // Retorna a saída do comando
            return response()->json(['output' => Artisan::output()]);
        } catch (\Exception $e) {
            // Se houver um erro, captura e exibe
            return response()->json(['error' => 'Erro ao executar o comando: ' . $e->getMessage()], 500);
        }
    }
}
