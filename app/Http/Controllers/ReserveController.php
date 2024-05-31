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
        $data['seats_reserved'] = [1, 5, 10];
        $data['routes'] = DB::table('routes')->get();
        $data['bus_stops'] = DB::table('bus_stops')->get();

        if ($request->has('route')) {
            $data['time'] = DB::table('schedule')->where('routes_route', $request->route)
                ->where('day_of_the_week', strftime("%A", strtotime($request->date)))->get();
        }

        return view('reserve')->with('data', $data)
        ;
    }
}
