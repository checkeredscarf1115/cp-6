<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/schedule');

Auth::routes();

Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');

Route::get('/schedule', function () {
    return view('schedule');
});

