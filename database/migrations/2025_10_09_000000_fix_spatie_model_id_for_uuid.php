<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Ajusta as colunas model_id das tabelas do spatie para suportar UUIDs (string)
 * Versão com statements SQL para compatibilidade MySQL.
 *
 * Autor: Augusto Kussema
 * Data: 2025-10-09
 */
return new class extends Migration
{
    public function up(): void
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $modelKey = $columnNames['model_morph_key'] ?? 'model_id';

        if (empty($tableNames)) {
            // config not published, nothing to do
            return;
        }

        // Helper para alterar coluna com SQL (idempotente)
        $alterColumnToVarchar = function (string $table, string $column) {
            try {
                // Verifica o tipo atual
                $row = DB::selectOne("SELECT DATA_TYPE, CHARACTER_MAXIMUM_LENGTH FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?", [$table, $column]);
                if (!$row) return;

                // Se é bigint/integer, alteramos
                $dataType = strtolower($row->DATA_TYPE);
                if (in_array($dataType, ['bigint', 'int', 'integer', 'tinyint'])) {
                    // Drop primary keys that may reference the column
                    // Não garantimos o nome das constraints - usamos DROP PRIMARY KEY como operação geral
                    DB::statement("ALTER TABLE `{$table}` DROP PRIMARY KEY");

                    // Altera coluna para varchar(36)
                    DB::statement("ALTER TABLE `{$table}` MODIFY `{$column}` varchar(36) NOT NULL");

                    // Recria índices e primary keys conforme padrão do spatie
                    if ($table === config('permission.table_names.model_has_permissions')) {
                        DB::statement("CREATE INDEX `model_has_permissions_model_id_model_type_index` ON `{$table}` (`{$column}`, `model_type`)");
                        DB::statement("ALTER TABLE `{$table}` ADD PRIMARY KEY (`permission_id`, `{$column}`, `model_type`)");
                    }
                    if ($table === config('permission.table_names.model_has_roles')) {
                        DB::statement("CREATE INDEX `model_has_roles_model_id_model_type_index` ON `{$table}` (`{$column}`, `model_type`)");
                        DB::statement("ALTER TABLE `{$table}` ADD PRIMARY KEY (`role_id`, `{$column}`, `model_type`)");
                    }
                }

            } catch (\Throwable $e) {
                // Log do erro mas não interrompe a migration
                // Em ambientes sem privilégio para alter table, a operação pode falhar.
                // Recomendamos ao desenvolvedor executar manualmente se necessário.
                logger()->error('Falha ao alterar coluna ' . $column . ' na tabela ' . $table . ': ' . $e->getMessage());
            }
        };

        if (Schema::hasTable($tableNames['model_has_permissions'])) {
            $alterColumnToVarchar($tableNames['model_has_permissions'], $modelKey);
        }

        if (Schema::hasTable($tableNames['model_has_roles'])) {
            $alterColumnToVarchar($tableNames['model_has_roles'], $modelKey);
        }
    }

    public function down(): void
    {
        // Não implementado: reverter alterações deste tipo requer cuidado com dados.
    }
};
