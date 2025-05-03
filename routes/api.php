<?php

use App\Http\Controllers\api\admin\bookController;
use App\Http\Controllers\api\admin\categoreyController;
use App\Http\Controllers\api\auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('jwt.auth');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('jwt.auth');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('jwt.auth');
});


Route::controller(categoreyController::class)->group(function () {
    Route::get('/categorey', 'index');
    Route::get('/categorey/{id}', 'show');
    Route::post('/categorey', 'store');
    Route::post('/categorey/{id}', 'update');
    Route::delete('/categorey/{id}', 'destroy');
});


Route::controller(bookController::class)->group(function () {
    Route::get('/book', 'index');
    Route::get('/book/{id}', 'show');
    Route::post('/book', 'store');
    Route::post('/book/{id}', 'update');
    Route::delete('/book/{id}', 'destroy');
});
