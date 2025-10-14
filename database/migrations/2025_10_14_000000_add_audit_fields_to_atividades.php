<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Idempotente: verifica se cada coluna existe antes de adicionar.
     *
     * @return void
     */
    public function up(): void
    {
        // Executar backup automático antes de alterar a tabela (usar credenciais do .env)
        /* try {
            \Illuminate\Support\Facades\Artisan::call('backup:db', ['--path' => 'storage/backups']);
        } catch (\Throwable $e) {
            // Se o backup falhar, logamos mas continuamos — o developer pode optar por abortar manualmente
            logger()->error('Falha ao executar backup automático antes da migration de atividades: ' . $e->getMessage());
        } */

        Schema::table('atividades', function (Blueprint $table) {
            if (!Schema::hasColumn('atividades', 'action')) {
                $table->string('action', 80)->nullable()->after('texto');
            }

            if (!Schema::hasColumn('atividades', 'model_type')) {
                $table->string('model_type', 150)->nullable()->after('action');
            }

            if (!Schema::hasColumn('atividades', 'model_id')) {
                $table->string('model_id', 36)->nullable()->after('model_type');
            }

            if (!Schema::hasColumn('atividades', 'changes')) {
                $table->json('changes')->nullable()->after('model_id');
            }

            if (!Schema::hasColumn('atividades', 'snapshot_before')) {
                $table->json('snapshot_before')->nullable()->after('changes');
            }

            if (!Schema::hasColumn('atividades', 'snapshot_after')) {
                $table->json('snapshot_after')->nullable()->after('snapshot_before');
            }

            if (!Schema::hasColumn('atividades', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('snapshot_after');
            }

            if (!Schema::hasColumn('atividades', 'route')) {
                $table->string('route', 255)->nullable()->after('ip_address');
            }

            if (!Schema::hasColumn('atividades', 'http_method')) {
                $table->string('http_method', 10)->nullable()->after('route');
            }

            if (!Schema::hasColumn('atividades', 'correlation_id')) {
                $table->string('correlation_id', 100)->nullable()->after('http_method');
            }

            if (!Schema::hasColumn('atividades', 'level')) {
                $table->string('level', 20)->default('info')->after('correlation_id');
            }

            if (!Schema::hasColumn('atividades', 'sensitive')) {
                $table->boolean('sensitive')->default(false)->after('level');
            }

            if (!Schema::hasColumn('atividades', 'actor_role')) {
                $table->string('actor_role', 100)->nullable()->after('sensitive');
            }

            if (!Schema::hasColumn('atividades', 'user_name')) {
                $table->string('user_name', 150)->nullable()->after('actor_role');
            }
        });

        // Índices idempotentes — tentativa segura: tentamos criar e ignoramos falhas
        Schema::table('atividades', function (Blueprint $table) {
            try {
                if (Schema::hasColumn('atividades', 'model_type')) {
                    $table->index('model_type');
                }
            } catch (\Throwable $e) {
                logger()->warning('Não foi possível criar índice model_type em atividades: ' . $e->getMessage());
            }

            try {
                if (Schema::hasColumn('atividades', 'model_id')) {
                    $table->index('model_id');
                }
            } catch (\Throwable $e) {
                logger()->warning('Não foi possível criar índice model_id em atividades: ' . $e->getMessage());
            }

            try {
                if (Schema::hasColumn('atividades', 'correlation_id')) {
                    $table->index('correlation_id');
                }
            } catch (\Throwable $e) {
                logger()->warning('Não foi possível criar índice correlation_id em atividades: ' . $e->getMessage());
            }
        });
    }

    /**
     * Reverse the migrations.
     * Apenas remove colunas que existam — esta operação é reversível mas
     * deve ser executada com cuidado em produção.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('atividades', function (Blueprint $table) {
            if (Schema::hasColumn('atividades', 'user_name')) $table->dropColumn('user_name');
            if (Schema::hasColumn('atividades', 'actor_role')) $table->dropColumn('actor_role');
            if (Schema::hasColumn('atividades', 'sensitive')) $table->dropColumn('sensitive');
            if (Schema::hasColumn('atividades', 'level')) $table->dropColumn('level');
            if (Schema::hasColumn('atividades', 'correlation_id')) $table->dropColumn('correlation_id');
            if (Schema::hasColumn('atividades', 'http_method')) $table->dropColumn('http_method');
            if (Schema::hasColumn('atividades', 'route')) $table->dropColumn('route');
            if (Schema::hasColumn('atividades', 'ip_address')) $table->dropColumn('ip_address');
            if (Schema::hasColumn('atividades', 'snapshot_after')) $table->dropColumn('snapshot_after');
            if (Schema::hasColumn('atividades', 'snapshot_before')) $table->dropColumn('snapshot_before');
            if (Schema::hasColumn('atividades', 'changes')) $table->dropColumn('changes');
            if (Schema::hasColumn('atividades', 'model_id')) $table->dropColumn('model_id');
            if (Schema::hasColumn('atividades', 'model_type')) $table->dropColumn('model_type');
            if (Schema::hasColumn('atividades', 'action')) $table->dropColumn('action');
        });
    }
};
