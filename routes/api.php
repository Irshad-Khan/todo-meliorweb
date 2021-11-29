<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('profile', [AuthController::class, 'profile']);
    Route::post('register', [AuthController::class, 'register']);

});

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('todos', TodoController::class);
});


