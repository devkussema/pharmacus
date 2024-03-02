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
        Schema::table('areas_hospitalares', function (Blueprint $table) {
            $table->uuid('farmacia_id')->nullable()->after('descricao');
            $table->foreign('farmacia_id')->references('id')->on('farmacias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas_hospitalares', function (Blueprint $table) {
            $table->dropForeign(['farmacia_id']);
            $table->dropColumn('farmacia_id');
        });
    }
};
