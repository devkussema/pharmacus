<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atividade;
use App\Models\UserAuthLog;

class AtividadeApiController extends Controller
{
    public function indexJson(Request $request)
    {
        $type = $request->query('type', 'activity');
        $limit = (int) $request->query('limit', 25);

        if ($type === 'auth') {
            $items = UserAuthLog::with('user')->orderByDesc('created_at')->limit($limit)->get();
            // map to simple structure
            $items = $items->map(fn($i) => [
                'id' => $i->id,
                'user_id' => $i->user_id,
                'user_name' => $i->user?->nome ?? null,
                'action' => $i->action,
                'status' => $i->status,
                'created_at' => $i->created_at,
            ]);
            return response()->json(['items' => $items], 200);
        }

        // fallback: activities
        $items = Atividade::with('user')->orderByDesc('created_at')->limit($limit)->get();
        $items = $items->map(fn($i) => [
            'id' => $i->id,
            'user_id' => $i->user_id,
            'user_name' => $i->user?->nome ?? null,
            'texto' => $i->texto,
            'created_at' => $i->created_at,
        ]);

        return response()->json(['items' => $items], 200);
    }

    /**
     * Retorna um único log (auth) por id
     */
    public function showJson(Request $request, string $id)
    {
        $log = UserAuthLog::with('user')->find($id);
        if (!$log) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'id' => $log->id,
            'user_id' => $log->user_id,
            'user_name' => $log->user?->nome,
            'user_role' => $log->user?->cargoPrimario()?->nome ?? $log->user?->roles?->first()?->name ?? null,
            'user_foto' => $log->user?->foto_perfil_url ?? null,
            'action' => $log->action,
            'status' => $log->status,
            'ip_address' => $log->ip_address,
            'user_agent' => $log->user_agent,
            'created_at' => $log->created_at,
        ], 200);
    }
}
