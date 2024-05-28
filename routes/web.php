<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/reserve');

Auth::routes([
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::get('/reserve', [App\Http\Controllers\ReserveController::class, 'index'])->name('reserve');

Route::get('/reservations', [App\Http\Controllers\ReservationsController::class, 'index'])->name('reservations');