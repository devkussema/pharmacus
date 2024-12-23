<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class TerminalController extends Controller
{
    function runArtisanCommand($command) {
        $fullCommand = "php artisan " . $command;

        $output = shell_exec($fullCommand);

        if ($output === null) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao executar o comando.',
            ]);
        }

        // Encode para evitar problemas no front-end
        return response()->json([
            'success' => true,
            'output' => htmlspecialchars($output),
        ]);
    }


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

    public function runComposer(Request $request)
    {
        try {
            // Recebe o comando do frontend
            $command = $request->input('command');

            // Caminho absoluto para o Composer
            $composerPath = 'C:\\laragon\\bin\composer\\composer'; // Atualize conforme o local do seu composer
            $command = str_replace('composer', $composerPath, $command);

            // Executa o comando usando shell_exec
            $output = shell_exec($command . ' 2>&1'); // Redireciona erros para a saída padrão

            // Garante que a saída seja codificada em UTF-8
            $output = mb_convert_encoding($output, 'UTF-8', 'auto');

            // Escapa o texto para preservar formatação HTML
            $escapedOutput = htmlspecialchars($output, ENT_QUOTES, 'UTF-8');

            // Retorna a saída formatada
            return response()->json(['output' => $escapedOutput]);
        } catch (\Exception $e) {
            // Captura erros e retorna resposta apropriada
            return response()->json(['error' => 'Erro ao executar o comando: ' . $e->getMessage()], 500);
        }
    }

    public function runTerminal(Request $request)
    {
        try {
            $command = $request->input('command');

            // Executa o comando no terminal usando exec
            $output = [];
            $returnVar = null;
            exec($command, $output, $returnVar);

            // Verifica se o comando foi executado corretamente
            if ($returnVar !== 0) {
                return response()->json(['error' => 'Erro ao executar o comando: ' . implode("\n", $output)], 500);
            }

            return response()->json(['output' => implode("\n", $output)]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao executar o comando: ' . $e->getMessage()], 500);
        }
    }

}
