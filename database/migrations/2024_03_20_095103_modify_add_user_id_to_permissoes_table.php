<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('permissoes', function (Blueprint $table) {
            // Modifica o tipo de dados do campo conteudo para JSON
            $table->json('conteudo')->nullable()->change();

            // Adiciona a coluna user_id com uma chave estrangeira para a tabela users
            $table->uuid('user_id')->after('conteudo');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissoes', function (Blueprint $table) {
            // Reverte as alterações feitas na função up
            $table->string('conteudo')->nullable()->change();
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
