<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration para criar a tabela de documentos
 * 
 * Estrutura completa para gestão de documentos do sistema farmacêutico,
 * incluindo metadados, categorização, controlo de acesso e auditoria.
 * 
 * @author Augusto Kussema
 * @since 21/10/2025
 */
return new class extends Migration
{
    /**
     * Executa as migrations
     */
    public function up(): void
    {
        if (!Schema::hasTable('documents')) {
        Schema::create('documents', function ($table) {
            $table->uuid('id')->primary();
            
            // Informações básicas do documento
            $table->string('name', 255)->comment('Nome do documento');
            $table->text('description')->nullable()->comment('Descrição detalhada');
            $table->string('original_filename', 255)->comment('Nome original do ficheiro');
            $table->string('stored_filename', 255)->comment('Nome do ficheiro no armazenamento');
            $table->string('file_path', 500)->comment('Caminho completo do ficheiro');
            $table->string('mime_type', 100)->comment('Tipo MIME do ficheiro');
            $table->string('file_extension', 10)->comment('Extensão do ficheiro');
            $table->bigInteger('file_size')->comment('Tamanho do ficheiro em bytes');
            $table->string('hash', 64)->unique()->comment('Hash SHA256 do ficheiro para integridade');
            
            // Categorização e tipo
            $table->enum('document_type', [
                'manual', 'politica', 'relatorio', 'lista', 'inventario', 
                'apresentacao', 'contrato', 'procedimento', 'norma', 
                'certificado', 'factura', 'outro'
            ])->comment('Tipo de documento');
            $table->string('category', 100)->nullable()->comment('Categoria personalizada');
            $table->json('tags')->nullable()->comment('Etiquetas do documento (JSON array)');
            
            // Metadados e informações complementares
            $table->date('document_date')->comment('Data do documento');
            $table->string('author', 255)->nullable()->comment('Autor ou fornecedor');
            $table->enum('department', [
                'farmacia', 'administracao', 'financeiro', 'recursos_humanos', 
                'ti', 'qualidade', 'compras', 'vendas', 'outro'
            ])->nullable()->comment('Departamento responsável');
            $table->string('version', 20)->default('1.0')->comment('Versão do documento');
            $table->text('notes')->nullable()->comment('Notas e observações');
            
            // Controlo de acesso e segurança
            $table->enum('access_level', ['publico', 'restrito', 'confidencial'])
                  ->default('publico')->comment('Nível de acesso ao documento');
            $table->boolean('is_active')->default(true)->comment('Documento ativo');
            $table->boolean('is_archived')->default(false)->comment('Documento arquivado');
            $table->timestamp('expires_at')->nullable()->comment('Data de expiração');
            
            // Controlo de downloads e visualizações
            $table->integer('download_count')->default(0)->comment('Número de downloads');
            $table->integer('view_count')->default(0)->comment('Número de visualizações');
            $table->timestamp('last_accessed_at')->nullable()->comment('Último acesso');
            
            // Relacionamentos e auditoria
            $table->uuid('uploaded_by')->comment('ID do utilizador que fez upload');
            $table->uuid('farmacia_id')->nullable()->comment('ID da farmácia (se aplicável)');
            $table->uuid('updated_by')->nullable()->comment('Último utilizador a atualizar');
            
            // Campos de auditoria
            $table->timestamps();
            $table->softDeletes()->comment('Soft delete para auditoria');
            
            // Índices para performance
            $table->index(['document_type', 'is_active']);
            $table->index(['farmacia_id', 'is_active']);
            $table->index(['uploaded_by', 'created_at']);
            $table->index(['document_date', 'is_active']);
            $table->index(['access_level', 'is_active']);
            $table->index(['file_extension', 'is_active']);
            // Nota: Índice JSON será criado separadamente se necessário
            
            // Chaves estrangeiras
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            
            // Comentário da tabela
            $table->comment('Tabela de documentos do sistema farmacêutico com controlo completo de metadados e acesso');
        });
        }
    }

    /**
     * Reverte as migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
