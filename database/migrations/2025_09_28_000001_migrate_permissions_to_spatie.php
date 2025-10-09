<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Migração de dados de permissões/grupos do esquema atual para o esquema do pacote spatie/laravel-permission.
 *
 * - Cria roles a partir de `grupos`
 * - Converte registros em `permissoes.conteudo` (JSON) para `permissions` e atribui a roles ou users
 * - Converte `user_grupos` para `model_has_roles`
 * - Converte `grupo_permissoes` para `role_has_permissions` quando possível
 *
 * Observações importantes:
 * - Este script NÃO instala o pacote spatie nem publica suas migrations. Execute antes:
 *     composer require spatie/laravel-permission
 *     php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
 *     php artisan migrate
 * - Depois de criado o schema do spatie, execute esta migration.
 *
 * @author Augusto Kussema
 * @created 2025-09-28
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Esta migration antiga foi substituída por uma versão com timestamp posterior
        // para ser executada após as migrations do pacote spatie/laravel-permission.
        // Mantemos o arquivo por histórico, mas não executamos nenhuma ação aqui.
        \Illuminate\Support\Facades\Log::info('Ignorando migration legacy 2025_09_28_000001_migrate_permissions_to_spatie');
        return;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // noop
    }
};
