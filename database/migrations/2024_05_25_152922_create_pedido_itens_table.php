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
        if (!Schema::hasTable('pedido_itens')) {
        Schema::create('pedido_itens', function ($table) {
            $table->id();
            $table->foreignUuid('user_de')->constrained('users')->onDelete('cascade');
            $table->foreignId('area_de')->constrained('areas_hospitalares')->onDelete('cascade');
            $table->foreignUuid('user_para')->constrained('users')->onDelete('cascade');
            $table->foreignId('area_para')->constrained('areas_hospitalares')->onDelete('cascade');
            $table->boolean('confirmado')->default(false);
            $table->text('itens');
            $table->timestamps();
        });
        }

        Schema::table('pedido_itens', function (Blueprint $table) {
            $table->foreignUuid('user_para')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_itens');
    }
};
