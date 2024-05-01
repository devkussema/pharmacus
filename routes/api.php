<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('')->namespace('App\Http\Controllers\Api\v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/get/users', 'GetUserController@getAllUsers');
        Route::get('/get/user/{id}', 'GetUserController@getUserWithId');

        Route::post('/logout', 'AuthController@logout');
    });

    Route::post('/login', 'AuthController@entrar');
});
