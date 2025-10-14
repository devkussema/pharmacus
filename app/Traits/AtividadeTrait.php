<?php

namespace App\Traits;

use App\Models\Atividade;

/**
 * Trait para registar atividades de utilizadores no sistema.
 *
 * @author Augusto Kussema
 * @date 2025-10-14
 */
trait AtividadeTrait
{
    /**
     * Regista uma atividade associada ao utilizador autenticado.
     * Retorna false silenciosamente se não houver utilizador autenticado
     * ou em caso de erro para não interromper o fluxo principal.
     *
     * @param string $texto Texto descritivo da atividade
     * @return bool True quando registou com sucesso, false caso contrário
     */
    public static function startAtv(string $texto): bool
    {
        try {
            if (!function_exists('auth') || !auth()->check()) {
                return false;
            }

            Atividade::create([
                'texto' => $texto,
                'user_id' => auth()->user()->id
            ]);

            return true;
        } catch (\Throwable $e) {
            // Não queremos que um erro de logging quebre a ação principal.
            logger()->error('AtividadeTrait::startAtv falhou: ' . $e->getMessage());
            return false;
        }
    }
}
