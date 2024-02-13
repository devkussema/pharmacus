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
        Schema::table('estoques', function (Blueprint $table) {
            $table->foreignId('area_hospitalar_id')->constrained('areas_hospitalares')->onDelete('cascade')->after('tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estoques', function (Blueprint $table) {
            $table->dropForeignId('area_hospitalar_id');
        });
    }
};
