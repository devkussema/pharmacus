<?php

namespace App\Http\Controllers\Artisan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    public function index()
    {
        return view('artisan.artisan');
    }

    public function run(Request $request)
    {
        $command = $request->input('command');

        // Iniciar o buffer de saída
        ob_start();

        try {
            Artisan::call($command);
            $output = Artisan::output();
        } catch (\Exception $e) {
            $output = "Error: " . $e->getMessage();
        }

        // Captura a saída gerada até agora
        $output = ob_get_clean();

        return response()->json(['output' => $output]);
    }
}
