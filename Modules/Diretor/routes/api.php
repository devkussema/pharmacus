<?php

use Illuminate\Support\Facades\Route;
use Modules\Diretor\Http\Controllers\HomeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    // APIs do módulo Diretor
    Route::get('/diretor', [HomeController::class, 'index']);
});
