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
        Schema::table('atividades', function (Blueprint $table) {
            // Remover a constraint de foreign key primeiro
            $table->dropForeign(['user_id']);

            // Modificar a coluna para ser nullable
            $table->uuid('user_id')->nullable()->change();

            // Recriar a foreign key sem onDelete cascade
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('atividades', function (Blueprint $table) {
            // Remover a constraint
            $table->dropForeign(['user_id']);

            // Reverter para NOT NULL
            $table->uuid('user_id')->nullable(false)->change();

            // Recriar a foreign key com cascade
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }
};
