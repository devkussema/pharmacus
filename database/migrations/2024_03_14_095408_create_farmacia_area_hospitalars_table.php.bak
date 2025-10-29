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
        Schema::create('farmacia_areas_hospitalares', function (Blueprint $table) {
            $table->id();
            $table->char('farmacia_id');
            $table->unsignedBigInteger('area_hospitalar_id');

            $table->foreign('area_hospitalar_id')->references('id')->on('areas_hospitalares')->onDelete('cascade');
            $table->foreign('farmacia_id')->references('id')->on('farmacias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmacia_areas_hospitalares');
    }
};
