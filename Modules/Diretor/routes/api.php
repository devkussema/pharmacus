<?php

use Illuminate\Support\Facades\Route;
use Modules\Diretor\Http\Controllers\DiretorController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('diretors', DiretorController::class)->names('diretor');
});
