<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grupo;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grupo::create([
            'nome' => 'Administrador',
            'descricao' => 'Um usuário com permissões avançadas de gerenciamento do sistema, geralmente com acesso total a todas as funcionalidades e recursos.'
        ]);

        Grupo::create([
            'nome' => 'Moderador',
            'descricao' => 'Um usuário com poderes intermediários, responsável por revisar e moderar conteúdo gerado pelos usuários, como postagens em fóruns, comentários, etc.'
        ]);

        Grupo::create([
            'nome' => 'Membro Premium',
            'descricao' => 'Um usuário que optou por pagar uma taxa ou assinatura para acessar recursos adicionais ou conteúdo exclusivo do sistema.'
        ]);

        Grupo::create([
            'nome' => 'Usuário Verificado',
            'descricao' => 'Um usuário que passou por um processo de verificação de identidade, garantindo uma maior confiabilidade em seu perfil e atividades no sistema.'
        ]);

        Grupo::create([
            'nome' => 'Convidado',
            'descricao' => 'Um usuário que não se registrou no sistema, mas pode ter acesso limitado a determinadas funcionalidades, como visualização de conteúdo público.'
        ]);

        Grupo::create([
            'nome' => 'Assinante',
            'descricao' => 'Um usuário que se inscreveu para receber atualizações ou notificações regulares do sistema, como newsletters ou boletins informativos.'
        ]);

        Grupo::create([
            'nome' => 'Funcionário',
            'descricao' => 'Um usuário associado a uma organização ou empresa, com permissões específicas relacionadas ao seu papel ou departamento dentro da empresa.'
        ]);

        Grupo::create([
            'nome' => 'Usuário Anônimo',
            'descricao' => 'Um usuário que acessa o sistema sem se identificar, geralmente com acesso limitado a recursos básicos.'
        ]);
    }
}
