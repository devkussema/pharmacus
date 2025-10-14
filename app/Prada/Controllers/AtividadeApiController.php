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
}
