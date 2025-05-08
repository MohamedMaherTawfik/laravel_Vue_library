<?php

use App\Http\Controllers\api\admin\bookController;
use App\Http\Controllers\api\admin\categoreyController;
use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\books\borrowController;
use App\Http\Middleware\BorrowOwned;
use App\Http\Middleware\checkAdmin;
use App\Http\Middleware\checkAuth;
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

Route::group([
    'prefix' => 'categorey'
], function () {
    Route::controller(categoreyController::class)->group(function () {
        Route::get('', 'index');
        Route::get('/{id}', 'show');
        Route::post('', 'store')->middleware(checkAdmin::class);
        Route::post('/{id}', 'update')->middleware(checkAdmin::class);
        Route::delete('/{id}', 'destroy')->middleware(checkAdmin::class);
    });
});

Route::group([
    'prefix' => 'book'
], function () {
    Route::controller(bookController::class)->group(function () {
        Route::get('', 'index');
        Route::get('/{id}', 'show');
        Route::post('', 'store')->middleware(checkAdmin::class);
        Route::post('/{id}', 'update')->middleware(checkAdmin::class);
        Route::delete('/{id}', 'destroy')->middleware(checkAdmin::class);
    });
});


Route::group([
    'prefix' => 'book'
], function () {
   Route::controller(borrowController::class)->group(function () {
       Route::get('/borrows', 'index')->middleware(checkAdmin::class);
       Route::get('/{id}/borrow', 'show');
       Route::post('/{id}/borrow', 'store')->middleware(checkAuth::class);
       Route::delete('/{id}/deleteBorrow', 'destroy')->middleware(BorrowOwned::class);
   });
});
