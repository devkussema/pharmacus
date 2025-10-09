<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Seeder que cria as roles e permissões base do sistema.
 *
 * Roles: Admin, Gerente, Funcionario
 * Permissões: produtos.*, atividade.show, areas_hospitalares.*, grupo_farmacologico.*, prateleira.*, relatorio.*, funcionario.*
 *
 * Autor: Augusto Kussema
 * Data: 2025-10-09
 */
class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpa cache de permissões
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Produtos (crud)
            'produtos.create',
            'produtos.read',
            'produtos.update',
            'produtos.delete',

            // Atividades
            'atividade.show',

            // Areas hospitalares (crud)
            'areas_hospitalares.create',
            'areas_hospitalares.read',
            'areas_hospitalares.update',
            'areas_hospitalares.delete',

            // Grupo farmacologico (crud)
            'grupo_farmacologico.create',
            'grupo_farmacologico.read',
            'grupo_farmacologico.update',
            'grupo_farmacologico.delete',

            // Prateleira (crud)
            'prateleira.create',
            'prateleira.read',
            'prateleira.update',
            'prateleira.delete',

            // Relatorio (crud)
            'relatorio.create',
            'relatorio.read',
            'relatorio.update',
            'relatorio.delete',

            // Funcionario (crud)
            'funcionario.create',
            'funcionario.read',
            'funcionario.update',
            'funcionario.delete',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // Roles
        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $gerente = Role::firstOrCreate(['name' => 'Gerente', 'guard_name' => 'web']);
        $func = Role::firstOrCreate(['name' => 'Funcionario', 'guard_name' => 'web']);

        // Atribuições:
        // Admin -> todas as permissões
        $admin->syncPermissions(Permission::all());

        // Gerente -> maioria das permissões exceto ações administrativas sensíveis (aqui damos todas exceto delete de relatorios)
        $gerentePerms = Permission::where('name', 'not like', 'relatorio.delete')->get();
        $gerente->syncPermissions($gerentePerms);

        // Funcionario -> permissões de leitura e ações sobre produtos e suas próprias operações
        $funcPerms = Permission::whereIn('name', [
            'produtos.read',
            'produtos.create',
            'produtos.update',
            'atividade.show',
        ])->get();
        $func->syncPermissions($funcPerms);
    }
}
