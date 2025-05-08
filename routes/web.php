<?php

use Illuminate\Support\Facades\Route;

// 👇 This should be your ONLY route for a Vue SPA
Route::get('/{any}', function () {
    return view('home.index'); // where your Vue app is mounted
})->where('any', '.*');
