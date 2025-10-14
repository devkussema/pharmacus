<?php

namespace App\Traits;

use App\Models\Atividade;

/**
 * Trait para registar atividades de utilizadores no sistema.
 *
 * Autor: Augusto Kussema
 * Data: 2025-10-14 (Revisão)
 */
trait AtividadeTrait
{
    /**
     * Regista uma atividade associada ao utilizador autenticado.
     * Esta versão aceita um texto, um array opcional de alterações e um array
     * de metadados (ip, rota, model_type, model_id, nivel etc.). A escrita é
     * tolerante: se as colunas ainda não existirem na tabela, a operação falha
     * silenciosamente e o fluxo principal não é interrompido.
     *
     * @param string $texto Texto descritivo da atividade
     * @param array|null $changes Estrutura [campo => ['old' => ..., 'new' => ...], ...]
     * @param array $meta Metadados opcionais (ip_address, route, model_type, model_id, level, correlation_id, actor_role, user_name, http_method)
     * @return bool True quando registou com sucesso, false caso contrário
     */
    public static function startAtv(string $texto, ?array $changes = null, array $meta = []): bool
    {
        try {
            if (!function_exists('auth') || !auth()->check()) {
                return false;
            }

            $user = auth()->user();

            $payload = array_merge([
                'texto' => $texto,
                'user_id' => $user->id,
                'user_name' => $user->nome ?? null,
                'actor_role' => method_exists($user, 'cargoPrimario') ? optional($user->cargoPrimario())->nome : null,
                'changes' => $changes,
            ], $meta);

            // Tenta criar o registo. Se algumas colunas não existirem, capturamos a exceção
            // e retornamos false sem interromper a acção do utilizador.
            try {
                Atividade::create($payload);
                return true;
            } catch (\Illuminate\Database\QueryException $qe) {
                logger()->warning('AtividadeTrait::startAtv - columns missing or DB issue: ' . $qe->getMessage());
                // Tentativa reduzida: criar apenas com os campos básicos para garantir rastreio mínimo
                try {
                    Atividade::create([
                        'texto' => $texto,
                        'user_id' => $user->id
                    ]);
                    return true;
                } catch (\Throwable $e) {
                    logger()->error('AtividadeTrait::startAtv fallback create failed: ' . $e->getMessage());
                    return false;
                }
            }
        } catch (\Throwable $e) {
            // Não queremos que um erro de logging quebre a ação principal.
            logger()->error('AtividadeTrait::startAtv falhou: ' . $e->getMessage());
            return false;
        }
    }
}
