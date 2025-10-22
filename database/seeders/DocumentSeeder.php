<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * Seeder para documentos de exemplo
 *
 * Cria documentos de demonstração para testar o sistema
 * de gestão documental.
 *
 * @author Augusto Kussema
 * @since 21/10/2025
 */
class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter o primeiro utilizador como uploader
        $user = User::first();

        if (!$user) {
            $this->command->warn('Nenhum utilizador encontrado. Criar um utilizador primeiro.');
            return;
        }

        $documents = [
            [
                'name' => 'Manual de Procedimentos',
                'description' => 'Manual completo de procedimentos farmacêuticos para gestão de medicamentos e atendimento ao cliente.',
                'original_filename' => 'Manual_de_Procedimentos.pdf',
                'stored_filename' => 'manual_procedimentos_' . Str::random(8) . '.pdf',
                'file_path' => 'documents/manual_procedimentos_' . Str::random(8) . '.pdf',
                'mime_type' => 'application/pdf',
                'file_extension' => 'pdf',
                'file_size' => 1258291, // ~1.2MB
                'hash' => hash('sha256', 'manual_procedimentos_content'),
                'document_type' => 'manual',
                'category' => 'Procedimentos',
                'tags' => ['manual', 'procedimentos', 'farmácia', 'medicamentos'],
                'document_date' => Carbon::create(2025, 10, 10),
                'author' => 'Departamento de Qualidade',
                'department' => 'qualidade',
                'version' => '2.1',
                'notes' => 'Versão atualizada com novos procedimentos de segurança.',
                'access_level' => 'publico',
                'uploaded_by' => $user->id,
            ],
            [
                'name' => 'Lista de Preços',
                'description' => 'Lista oficial de preços de medicamentos atualizada para o trimestre.',
                'original_filename' => 'Lista_de_Precos.xlsx',
                'stored_filename' => 'lista_precos_' . Str::random(8) . '.xlsx',
                'file_path' => 'documents/lista_precos_' . Str::random(8) . '.xlsx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'file_extension' => 'xlsx',
                'file_size' => 245760, // ~240KB
                'hash' => hash('sha256', 'lista_precos_content'),
                'document_type' => 'lista',
                'category' => 'Comercial',
                'tags' => ['preços', 'medicamentos', 'comercial', '2025'],
                'document_date' => Carbon::create(2025, 9, 1),
                'author' => 'Departamento Comercial',
                'department' => 'vendas',
                'version' => '1.0',
                'notes' => 'Lista de preços para o 4º trimestre de 2025.',
                'access_level' => 'restrito',
                'uploaded_by' => $user->id,
            ],
            [
                'name' => 'Relatório Mensal',
                'description' => 'Relatório mensal de vendas e movimentação de estoque.',
                'original_filename' => 'Relatorio_Mensal.docx',
                'stored_filename' => 'relatorio_mensal_' . Str::random(8) . '.docx',
                'file_path' => 'documents/relatorio_mensal_' . Str::random(8) . '.docx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'file_extension' => 'docx',
                'file_size' => 573440, // ~560KB
                'hash' => hash('sha256', 'relatorio_mensal_content'),
                'document_type' => 'relatorio',
                'category' => 'Relatórios',
                'tags' => ['relatório', 'vendas', 'estoque', 'outubro', '2025'],
                'document_date' => Carbon::create(2025, 10, 15),
                'author' => 'Gestor de Farmácia',
                'department' => 'administracao',
                'version' => '1.0',
                'notes' => 'Relatório referente ao mês de outubro de 2025.',
                'access_level' => 'confidencial',
                'uploaded_by' => $user->id,
            ],
            [
                'name' => 'Política de Segurança',
                'description' => 'Documento oficial de políticas de segurança e proteção de dados.',
                'original_filename' => 'Politica_de_Seguranca.pdf',
                'stored_filename' => 'politica_seguranca_' . Str::random(8) . '.pdf',
                'file_path' => 'documents/politica_seguranca_' . Str::random(8) . '.pdf',
                'mime_type' => 'application/pdf',
                'file_extension' => 'pdf',
                'file_size' => 911360, // ~890KB
                'hash' => hash('sha256', 'politica_seguranca_content'),
                'document_type' => 'politica',
                'category' => 'Políticas',
                'tags' => ['segurança', 'política', 'proteção', 'dados'],
                'document_date' => Carbon::create(2025, 10, 5),
                'author' => 'Departamento de TI',
                'department' => 'ti',
                'version' => '3.0',
                'notes' => 'Política atualizada conforme LGPD.',
                'access_level' => 'publico',
                'uploaded_by' => $user->id,
            ],
            [
                'name' => 'Inventário 2025',
                'description' => 'Inventário completo de medicamentos e produtos farmacêuticos.',
                'original_filename' => 'Inventario_2025.xlsx',
                'stored_filename' => 'inventario_2025_' . Str::random(8) . '.xlsx',
                'file_path' => 'documents/inventario_2025_' . Str::random(8) . '.xlsx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'file_extension' => 'xlsx',
                'file_size' => 1887436, // ~1.8MB
                'hash' => hash('sha256', 'inventario_2025_content'),
                'document_type' => 'inventario',
                'category' => 'Estoque',
                'tags' => ['inventário', 'estoque', 'medicamentos', '2025'],
                'document_date' => Carbon::create(2025, 9, 20),
                'author' => 'Equipa de Estoque',
                'department' => 'farmacia',
                'version' => '1.0',
                'notes' => 'Inventário realizado em setembro de 2025.',
                'access_level' => 'restrito',
                'uploaded_by' => $user->id,
            ],
            [
                'name' => 'Apresentação Farmácia',
                'description' => 'Apresentação institucional da farmácia para novos funcionários.',
                'original_filename' => 'Apresentacao_Farmacia.pptx',
                'stored_filename' => 'apresentacao_farmacia_' . Str::random(8) . '.pptx',
                'file_path' => 'documents/apresentacao_farmacia_' . Str::random(8) . '.pptx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'file_extension' => 'pptx',
                'file_size' => 3355443, // ~3.2MB
                'hash' => hash('sha256', 'apresentacao_farmacia_content'),
                'document_type' => 'apresentacao',
                'category' => 'Institucional',
                'tags' => ['apresentação', 'institucional', 'novos funcionários', 'farmácia'],
                'document_date' => Carbon::create(2025, 10, 12),
                'author' => 'Recursos Humanos',
                'department' => 'recursos_humanos',
                'version' => '1.5',
                'notes' => 'Apresentação para integração de novos colaboradores.',
                'access_level' => 'publico',
                'uploaded_by' => $user->id,
            ]
        ];

        foreach ($documents as $docData) {
            Document::create($docData);
        }

        $this->command->info('Documentos de exemplo criados com sucesso!');
    }
}
