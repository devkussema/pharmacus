<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration para criar tabela de fornecedores
 *
 * @author Augusto Kussema
 * @date 26 Nov 2025 14:36 (Luanda)
 * @description Tabela para armazenar informações dos fornecedores de produtos farmacêuticos
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome', 255);
            $table->string('nif', 50)->unique()->nullable()->comment('Número de Identificação Fiscal');
            $table->string('email', 255)->nullable();
            $table->string('telefone', 50)->nullable();
            $table->string('telemovel', 50)->nullable();
            $table->string('whatsapp', 50)->nullable();
            $table->text('endereco')->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('provincia', 100)->nullable();
            $table->string('pais', 100)->default('Angola');
            $table->string('codigo_postal', 20)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('pessoa_contacto', 255)->nullable()->comment('Nome da pessoa de contacto');
            $table->string('cargo_contacto', 100)->nullable()->comment('Cargo da pessoa de contacto');
            $table->enum('tipo', ['nacional', 'internacional'])->default('nacional');
            $table->enum('status', ['ativo', 'inativo', 'bloqueado'])->default('ativo');
            $table->text('observacoes')->nullable();
            $table->decimal('avaliacao', 3, 2)->nullable()->comment('Avaliação de 0 a 5');
            $table->string('conta_bancaria', 100)->nullable();
            $table->string('banco', 100)->nullable();
            $table->string('iban', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Índices para melhor performance
            $table->index('nome');
            $table->index('nif');
            $table->index('status');
            $table->index('tipo');
            $table->index(['created_at', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};
