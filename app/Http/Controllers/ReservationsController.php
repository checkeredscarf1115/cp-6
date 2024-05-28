<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $routes = ['1', '1'];
        $busStops = ['Остановка 1', 'Остановка 1'];
        $dates = ['30.05.2024', '31.05.2024'];
        $timestamps = ['06:00', '08:00'];
        $seats = ['5,6', '12,13'];

        return view('reservations')
        ->with('routes', $routes)
        ->with('busStops', $busStops)
        ->with('dates', $dates)
        ->with('timestamps', $timestamps)
        ->with('seats', $seats)
        ;
    }
}
