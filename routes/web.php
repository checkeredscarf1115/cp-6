<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/schedule');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/schedule', function () {
    return view('schedule');
});