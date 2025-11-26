<?php

namespace App\Services;

use App\Models\Atividade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Serviço para registar atividades do sistema.
 *
 * @author Augusto Kussema
 * @created 2025-11-26
 */
class AtividadeService
{
    /**
     * Registar uma atividade no sistema.
     *
     * @param string $texto Texto descritivo da atividade
     * @param array $options Opções adicionais (action, model_type, model_id, changes, etc.)
     * @return Atividade
     */
    public static function registar(string $texto, array $options = []): Atividade
    {
        $user = Auth::user();

        $data = [
            'user_id' => $user?->id,
            'user_name' => $user?->nome ?? 'Sistema',
            'texto' => $texto,
            'action' => $options['action'] ?? null,
            'model_type' => $options['model_type'] ?? null,
            'model_id' => $options['model_id'] ?? null,
            'changes' => $options['changes'] ?? null,
            'snapshot_before' => $options['snapshot_before'] ?? null,
            'snapshot_after' => $options['snapshot_after'] ?? null,
            'ip_address' => request()->ip(),
            'route' => request()->path(),
            'http_method' => request()->method(),
            'correlation_id' => $options['correlation_id'] ?? Str::uuid()->toString(),
            'level' => $options['level'] ?? 'info',
            'sensitive' => $options['sensitive'] ?? false,
            'actor_role' => $user?->roles?->first()?->name ?? 'guest',
        ];

        return Atividade::create($data);
    }

    /**
     * Registar criação de um modelo.
     *
     * @param string $modelType Tipo do modelo (ex: 'Fornecedor')
     * @param mixed $model Instância do modelo criado
     * @param string|null $customMessage Mensagem personalizada
     * @return Atividade
     */
    public static function registarCriacao(string $modelType, $model, ?string $customMessage = null): Atividade
    {
        $texto = $customMessage ?? self::gerarMensagemCriacao($modelType, $model);

        return self::registar($texto, [
            'action' => 'create',
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'snapshot_after' => $model->toArray(),
            'level' => 'info',
        ]);
    }

    /**
     * Registar atualização de um modelo.
     *
     * @param string $modelType Tipo do modelo (ex: 'Fornecedor')
     * @param mixed $model Instância do modelo atualizado
     * @param array $changes Mudanças realizadas
     * @param string|null $customMessage Mensagem personalizada
     * @return Atividade
     */
    public static function registarAtualizacao(string $modelType, $model, array $changes, ?string $customMessage = null): Atividade
    {
        $texto = $customMessage ?? self::gerarMensagemAtualizacao($modelType, $model, $changes);

        return self::registar($texto, [
            'action' => 'update',
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'changes' => $changes,
            'snapshot_after' => $model->fresh()->toArray(),
            'level' => 'info',
        ]);
    }

    /**
     * Registar exclusão de um modelo.
     *
     * @param string $modelType Tipo do modelo (ex: 'Fornecedor')
     * @param mixed $model Instância do modelo excluído
     * @param string|null $customMessage Mensagem personalizada
     * @return Atividade
     */
    public static function registarExclusao(string $modelType, $model, ?string $customMessage = null): Atividade
    {
        $texto = $customMessage ?? self::gerarMensagemExclusao($modelType, $model);

        return self::registar($texto, [
            'action' => 'delete',
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'snapshot_before' => $model->toArray(),
            'level' => 'warning',
        ]);
    }

    /**
     * Registar visualização de detalhes.
     *
     * @param string $modelType Tipo do modelo (ex: 'Fornecedor')
     * @param mixed $model Instância do modelo visualizado
     * @param string|null $customMessage Mensagem personalizada
     * @return Atividade
     */
    public static function registarVisualizacao(string $modelType, $model, ?string $customMessage = null): Atividade
    {
        $texto = $customMessage ?? self::gerarMensagemVisualizacao($modelType, $model);

        return self::registar($texto, [
            'action' => 'view',
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'level' => 'info',
        ]);
    }

    /**
     * Registar listagem/filtros aplicados.
     *
     * @param string $modelType Tipo do modelo (ex: 'Fornecedor')
     * @param array $filtros Filtros aplicados
     * @param int $totalResultados Total de resultados encontrados
     * @return Atividade
     */
    public static function registarListagem(string $modelType, array $filtros = [], int $totalResultados = 0): Atividade
    {
        $texto = self::gerarMensagemListagem($modelType, $filtros, $totalResultados);

        return self::registar($texto, [
            'action' => 'list',
            'model_type' => $modelType,
            'changes' => ['filtros' => $filtros, 'total_resultados' => $totalResultados],
            'level' => 'info',
        ]);
    }

    /**
     * Gera mensagem para criação de modelo.
     *
     * @param string $modelType
     * @param mixed $model
     * @return string
     */
    private static function gerarMensagemCriacao(string $modelType, $model): string
    {
        $identificador = self::obterIdentificadorModelo($model);
        return "Criou um novo {$modelType}: {$identificador}";
    }

    /**
     * Gera mensagem para atualização de modelo.
     *
     * @param string $modelType
     * @param mixed $model
     * @param array $changes
     * @return string
     */
    private static function gerarMensagemAtualizacao(string $modelType, $model, array $changes): string
    {
        $identificador = self::obterIdentificadorModelo($model);
        $camposAlterados = implode(', ', array_keys($changes));

        return "Atualizou o {$modelType} '{$identificador}'. Campos alterados: {$camposAlterados}";
    }

    /**
     * Gera mensagem para exclusão de modelo.
     *
     * @param string $modelType
     * @param mixed $model
     * @return string
     */
    private static function gerarMensagemExclusao(string $modelType, $model): string
    {
        $identificador = self::obterIdentificadorModelo($model);
        return "Excluiu o {$modelType}: {$identificador}";
    }

    /**
     * Gera mensagem para visualização de detalhes.
     *
     * @param string $modelType
     * @param mixed $model
     * @return string
     */
    private static function gerarMensagemVisualizacao(string $modelType, $model): string
    {
        $identificador = self::obterIdentificadorModelo($model);
        return "Visualizou os detalhes do {$modelType}: {$identificador}";
    }

    /**
     * Gera mensagem para listagem/filtros.
     *
     * @param string $modelType
     * @param array $filtros
     * @param int $totalResultados
     * @return string
     */
    private static function gerarMensagemListagem(string $modelType, array $filtros, int $totalResultados): string
    {
        $plural = Str::plural($modelType);

        if (empty($filtros)) {
            return "Listou {$totalResultados} {$plural}";
        }

        $descricaoFiltros = [];
        foreach ($filtros as $campo => $valor) {
            if ($valor) {
                $descricaoFiltros[] = "{$campo}: '{$valor}'";
            }
        }

        $filtrosTexto = implode(', ', $descricaoFiltros);
        return "Listou {$totalResultados} {$plural} com filtros aplicados ({$filtrosTexto})";
    }

    /**
     * Obtém identificador único do modelo para as mensagens.
     *
     * @param mixed $model
     * @return string
     */
    private static function obterIdentificadorModelo($model): string
    {
        // Tenta obter nome, título, descrição ou ID
        return $model->nome
            ?? $model->title
            ?? $model->name
            ?? $model->descricao
            ?? $model->description
            ?? "ID: {$model->id}";
    }
}
