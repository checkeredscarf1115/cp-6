<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/reserve');

Auth::routes([
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::get('/reserve', [App\Http\Controllers\Reservation\ReserveController::class, 'index'])->name('reserve.index');
Route::get('/reserve/bus', [App\Http\Controllers\Reservation\ReserveController::class, 'getReservations'])->name('reserve_bus');
Route::post('/reserve', [App\Http\Controllers\Reservation\ReserveController::class, 'create'])->name('reserve.create');

Route::get('/reservations', [App\Http\Controllers\Reservation\ReservationsController::class, 'index'])->name('reservations');

