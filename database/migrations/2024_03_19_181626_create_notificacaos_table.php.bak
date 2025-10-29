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
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->boolean('visto');
            $table->foreignUuid('user_de')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('user_para')->constrained('users')->onDelete('cascade');
            $table->text('descricao')->nullable();
            $table->dateTime('visto_em');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacoes');
    }
};
