<?php

use Illuminate\Support\Facades\Route;
use Modules\Diretor\Http\Controllers\DiretorController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('diretors', DiretorController::class)->names('diretor');
});
