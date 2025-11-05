<?php

use Illuminate\Support\Facades\Route;
use Modules\Diretor\Http\Controllers\HomeController;

Route::prefix('')->group(function () {
    Route::resource('diretor', HomeController::class)->names('diretor');
});
