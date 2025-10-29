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
        Schema::create('status_estoque', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produto_estoques')->onDelete('cascade');
            $table->integer('critico');
            $table->integer('minimo');
            $table->integer('medio');
            $table->integer('maximo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_estoque');
    }
};
