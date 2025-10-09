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
 *     php artisan vendor:publish --provider="Spatie\\Permission\\PermissionServiceProvider" --tag="migrations"
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
        // Verifica existência das tabelas do spatie
        if (!Schema::hasTable('roles') || !Schema::hasTable('permissions') || !Schema::hasTable('model_has_roles')) {
            // Lança uma exceção amigável para o desenvolvedor
            throw new \RuntimeException('Tabelas do spatie não encontradas. Instale e migre spatie/laravel-permission antes de executar esta migration.');
        }

        $report = [
            'created_roles' => [],
            'created_permissions' => [],
            'assigned_role_permissions' => [],
            'assigned_user_permissions' => [],
            'assigned_user_roles' => [],
            'ambiguous_entries' => [],
        ];

        DB::beginTransaction();
        try {
            // 1) Migrar grupos -> roles
            $grupos = DB::table('grupos')->get();
            foreach ($grupos as $g) {
                // evita duplicados
                $existing = DB::table('roles')->where('name', $g->nome)->where('guard_name', 'web')->first();
                if (!$existing) {
                    $roleId = DB::table('roles')->insertGetId([
                        'name' => $g->nome,
                        'guard_name' => 'web',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $roleId = $existing->id;
                }
                $report['created_roles'][] = ['grupo_id' => $g->id, 'role_id' => $roleId, 'nome' => $g->nome];
            }

            // Helper: cria permission única (name) se não existir
            $createPermission = function (string $name) use (&$report) {
                $perm = DB::table('permissions')->where('name', $name)->where('guard_name', 'web')->first();
                if (!$perm) {
                    $id = DB::table('permissions')->insertGetId([
                        'name' => $name,
                        'guard_name' => 'web',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $report['created_permissions'][] = ['name' => $name, 'id' => $id];
                    return $id;
                }
                return $perm->id;
            };

            // Converte um objeto/array de permissões em lista de nomes (module.action)
            $parsePermissionsConteudo = function ($conteudo) use (&$report) {
                $perms = [];
                if (empty($conteudo)) return $perms;

                // Se já for um JSON string, tenta decodificar
                if (is_string($conteudo)) {
                    $decoded = json_decode($conteudo, true);
                } else {
                    $decoded = $conteudo;
                }

                if (!is_array($decoded)) {
                    // formato desconhecido
                    $report['ambiguous_entries'][] = ['conteudo_raw' => $conteudo];
                    return $perms;
                }

                // Espera-se formato: [module => [action => 'on'|'off']]
                foreach ($decoded as $module => $actions) {
                    if (!is_array($actions)) continue;
                    foreach ($actions as $action => $value) {
                        // considera 'on' como ativo
                        if ($value === 'on' || $value === 1 || $value === true) {
                            $perms[] = strtolower(trim($module)) . '.' . strtolower(trim($action));
                        }
                    }
                }

                return array_values(array_unique($perms));
            };

            // 2) Migrar permissões associadas a grupos (via grupo_permissoes)
            if (Schema::hasTable('grupo_permissoes')) {
                $gp = DB::table('grupo_permissoes')
                    ->join('permissoes', 'grupo_permissoes.permissao_id', '=', 'permissoes.id')
                    ->select('grupo_permissoes.grupo_id', 'permissoes.conteudo')->get();

                foreach ($gp as $row) {
                    $role = DB::table('roles')->where('name', DB::table('grupos')->where('id', $row->grupo_id)->value('nome'))->where('guard_name', 'web')->first();
                    if (!$role) {
                        $report['ambiguous_entries'][] = ['type' => 'grupo_permissoes_missing_role', 'grupo_id' => $row->grupo_id];
                        continue;
                    }

                    $names = $parsePermissionsConteudo($row->conteudo);
                    foreach ($names as $permName) {
                        $permId = $createPermission($permName);
                        // associa role->permission (role_has_permissions) se não existir
                        $exists = DB::table('role_has_permissions')->where('permission_id', $permId)->where('role_id', $role->id)->first();
                        if (!$exists) {
                            DB::table('role_has_permissions')->insert([
                                'permission_id' => $permId,
                                'role_id' => $role->id,
                            ]);
                            $report['assigned_role_permissions'][] = ['role_id' => $role->id, 'permission_id' => $permId, 'permission' => $permName];
                        }
                    }
                }
            }

            // 3) Migrar permissões por usuário (permissoes.user_id)
            if (Schema::hasTable('permissoes')) {
                $perUser = DB::table('permissoes')->whereNotNull('user_id')->get();
                foreach ($perUser as $p) {
                    $userId = $p->user_id;
                    $names = $parsePermissionsConteudo($p->conteudo);
                    foreach ($names as $permName) {
                        $permId = $createPermission($permName);
                        // atribui permissão diretamente ao model (model_has_permissions)
                        $exists = DB::table('model_has_permissions')
                            ->where('permission_id', $permId)
                            ->where('model_type', 'App\\Models\\User')
                            ->where('model_id', $userId)
                            ->first();
                        if (!$exists) {
                            DB::table('model_has_permissions')->insert([
                                'permission_id' => $permId,
                                'model_type' => 'App\\Models\\User',
                                'model_id' => $userId,
                            ]);
                            $report['assigned_user_permissions'][] = ['user_id' => $userId, 'permission_id' => $permId, 'permission' => $permName];
                        }
                    }
                }
            }

            // 4) Migrar user_grupos -> model_has_roles
            if (Schema::hasTable('user_grupos')) {
                $ugs = DB::table('user_grupos')->get();
                foreach ($ugs as $ug) {
                    $roleName = DB::table('grupos')->where('id', $ug->grupo_id)->value('nome');
                    $role = DB::table('roles')->where('name', $roleName)->where('guard_name', 'web')->first();
                    if (!$role) {
                        $report['ambiguous_entries'][] = ['type' => 'user_grupos_missing_role', 'user_grupo' => (array) $ug];
                        continue;
                    }

                    $exists = DB::table('model_has_roles')
                        ->where('role_id', $role->id)
                        ->where('model_type', 'App\\Models\\User')
                        ->where('model_id', $ug->user_id)
                        ->first();
                    if (!$exists) {
                        DB::table('model_has_roles')->insert([
                            'role_id' => $role->id,
                            'model_type' => 'App\\Models\\User',
                            'model_id' => $ug->user_id,
                        ]);
                        $report['assigned_user_roles'][] = ['user_id' => $ug->user_id, 'role_id' => $role->id];
                    }
                }
            }

            DB::commit();

            // Grava relatório em storage
            $reportPath = storage_path('permission_migration_report.json');
            try {
                file_put_contents($reportPath, json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            } catch (\Throwable $e) {
                Log::error('Falha ao gravar report de migração de permissões: ' . $e->getMessage());
            }

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Erro ao migrar permissões para spatie: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Este script é irreversível automaticamente; recomenda-se restaurar o backup do DB se necessário.
    }
};
