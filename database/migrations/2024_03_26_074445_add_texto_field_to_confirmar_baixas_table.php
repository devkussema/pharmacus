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
        Schema::table('confirmar_baixas', function (Blueprint $table) {
            $table->string('texto')->after('confirmado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('confirmar_baixas', function (Blueprint $table) {
            $table->dropColumn('texto');
        });
    }
};
