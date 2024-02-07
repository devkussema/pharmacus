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
        Schema::table('farmacias', function (Blueprint $table) {
            $table->string('codigo')->nullable()->after('nome');
            $table->unsignedBigInteger('categoria_id')->nullable()->after('codigo');
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('farmacias', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('codigo');
            $table->dropColumn('categoria_id');
        });
    }
};
