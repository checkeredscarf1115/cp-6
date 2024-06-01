<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReserveController extends Controller
{
    private $data;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data['routes'] = DB::table('routes')->get();
        $data['bus_stops'] = DB::table('bus_stops')->get();
        $data['schedule'] = DB::table('schedule')->get();

        return view('reserve')->with('data', $data);
    }

    public function getReservations(Request $request) {
        $schedule = DB::table('schedule')
            ->where('day_of_the_week', '=', $request->input('route'))
            ->where('arrival_time', '=', $request->input('time'))
            ->first();

        $data['reservations'] = DB::table('reservations')
            ->where('date_of_reservation', '=', $request->input('date'))
            ->where('schedule_id', '=', $schedule->id)
            ->where('users_id', '=', $request->user()->id)
            ->where('bus_stops_bus_stop', '=', str_replace('_', ' ', $request->input('bus_stop')))
            ->get();

        return response()->json([$data['reservations'], $schedule]);
    }

    public function create(Request $request) {       
        $input = $request->all();
        return response()->json($input);
    }
}
