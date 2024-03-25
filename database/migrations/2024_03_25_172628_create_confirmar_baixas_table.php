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
        Schema::create('confirmar_baixas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_hospitalar_de');
            $table->boolean('confirmado')->default(0);
            $table->unsignedBigInteger('area_hospitalar_para');

            $table->foreign('area_hospitalar_de')->references('area_hospitalar_id')->on('farmacia_areas_hospitalares')->onDelete('cascade');
            $table->foreign('area_hospitalar_para')->references('area_hospitalar_id')->on('farmacia_areas_hospitalares')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmar_baixas');
    }
};
