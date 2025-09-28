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
        Schema::table('farmacia_areas_hospitalares', function (Blueprint $table) {
            if (!Schema::hasColumn('farmacia_areas_hospitalares', 'status')) {
                $table->tinyInteger('status')->default(1)->after('farmacia_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('farmacia_areas_hospitalares', function (Blueprint $table) {
            if (Schema::hasColumn('farmacia_areas_hospitalares', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
