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
        Schema::table('produto_estoques', function (Blueprint $table) {
            $table->foreignId('grupo_farmaco_id')->constrained('grupo_farmacologicos')->onDelete('cascade')->after('forma');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produto_estoques', function (Blueprint $table) {
            $table->dropForeignId('grupo_farmaco_id');
        });
    }
};
