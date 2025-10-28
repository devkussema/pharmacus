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
        $page = (int) $request->query('page', 1);

        if ($type === 'auth') {
            $query = UserAuthLog::with('user')->orderByDesc('created_at');
            $p = $query->paginate($limit, ['*'], 'page', $page);
            $items = $p->getCollection()->map(fn($i) => [
                'id' => $i->id,
                'user_id' => $i->user_id,
                'user_name' => $i->user?->nome ?? null,
                'action' => $i->action,
                'status' => $i->status,
                'ip_address' => $i->ip_address ?? null,
                'user_agent' => $i->user_agent ?? null,
                'created_at' => $i->created_at,
            ]);

            return response()->json([
                'items' => $items,
                'meta' => [
                    'total' => $p->total(),
                    'per_page' => $p->perPage(),
                    'current_page' => $p->currentPage(),
                    'last_page' => $p->lastPage(),
                ],
            ], 200);
        }

        // activities (Atividade) paginated
        $query = Atividade::with('user')->orderByDesc('created_at');
        $p = $query->paginate($limit, ['*'], 'page', $page);
        $items = $p->getCollection()->map(fn($i) => [
            'id' => $i->id,
            'user_id' => $i->user_id,
            'user_name' => $i->user?->nome ?? $i->user_name ?? null,
            'texto' => $i->texto,
            'action' => $i->action ?? null,
            'model_type' => $i->model_type ?? null,
            'model_id' => $i->model_id ?? null,
            'changes' => $i->changes ?? null,
            'snapshot_before' => $i->snapshot_before ?? null,
            'snapshot_after' => $i->snapshot_after ?? null,
            'ip_address' => $i->ip_address ?? null,
            'route' => $i->route ?? null,
            'http_method' => $i->http_method ?? null,
            'correlation_id' => $i->correlation_id ?? null,
            'level' => $i->level ?? null,
            'sensitive' => $i->sensitive ?? false,
            'actor_role' => $i->actor_role ?? null,
            'created_at' => $i->created_at,
        ]);

        return response()->json([
            'items' => $items,
            'meta' => [
                'total' => $p->total(),
                'per_page' => $p->perPage(),
                'current_page' => $p->currentPage(),
                'last_page' => $p->lastPage(),
            ],
        ], 200);
    }

    /**
     * Retorna um único log (auth) por id
     */
    public function showJson(Request $request, string $id)
    {
        $log = UserAuthLog::with('user')->find($id);
            $log = UserAuthLog::with('user')->find($id);
            if ($log) {
                return response()->json([
                    'id' => $log->id,
                    'type' => 'auth',
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

            // fallback to Atividade
            $at = Atividade::with('user')->find($id);
            if ($at) {
                return response()->json([
                    'id' => $at->id,
                    'type' => 'activity',
                    'user_id' => $at->user_id,
                    'user_name' => $at->user?->nome ?? $at->user_name ?? null,
                    'texto' => $at->texto,
                    'action' => $at->action ?? null,
                    'model_type' => $at->model_type ?? null,
                    'model_id' => $at->model_id ?? null,
                    'changes' => $at->changes ?? null,
                    'snapshot_before' => $at->snapshot_before ?? null,
                    'snapshot_after' => $at->snapshot_after ?? null,
                    'ip_address' => $at->ip_address ?? null,
                    'route' => $at->route ?? null,
                    'http_method' => $at->http_method ?? null,
                    'correlation_id' => $at->correlation_id ?? null,
                    'level' => $at->level ?? null,
                    'sensitive' => $at->sensitive ?? false,
                    'actor_role' => $at->actor_role ?? null,
                    'created_at' => $at->created_at,
                ], 200);
            }

            return response()->json(['message' => 'Not found'], 404);
    }
}
