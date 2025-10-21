<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::resource('dashboard', DashboardController::class)->only(['index']);
