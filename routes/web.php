<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/reserve');

Auth::routes();

Route::get('/reserve', [App\Http\Controllers\ReserveController::class, 'index'])->name('reserve');

Route::get('/reservations', [App\Http\Controllers\ReservationsController::class, 'index'])->name('reservations');