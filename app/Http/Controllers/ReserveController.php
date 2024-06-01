<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use DateTime;

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
            ->where('routes_route', '=', $request->input('route'))
            ->where('day_of_the_week', '=', $this->dateToNumber($request->input('date')))
            ->where('arrival_time', '=', $request->input('time'))
            ->first();

        $reservations = Reservation::select('seat_number')
            ->where('schedule_id', '=', $schedule->id)
            ->where('date_of_reservation', '=', $request->input('date'))
            ->get();

        return response()->json([$reservations, $schedule]);
    }

    public function create(Request $request) {
        $msg = "";
        $code = 0;

        $schedule = DB::table('schedule')
            ->where('routes_route', '=', $request->input('route'))
            ->where('day_of_the_week', '=', $this->dateToNumber($request->input('date')))
            ->where('arrival_time', '=', $request->input('time'))
            ->first();

        $seats = explode(',', $request->input('selected_seats'));

        foreach ($seats as $seat) {
            try {
                Reservation::create([
                    'users_id' => $request->user()->id,
                    'schedule_id'  => $schedule->id,
                    'bus_stops_bus_stop'  => str_replace('_', ' ', $request->input('bus_stop')),
                    'seat_number'  => $seat,
                    'date_of_reservation'  => $request->input('date'),
                ]);

                $code = 0;
            } catch (\Illuminate\Database\QueryException $exception) {
                $code = 1;

                if ($exception->errorInfo[0] == "23000" && $exception->errorInfo[1] == 1062) {
                    $reservations = Reservation::where('schedule_id', $schedule->id)
                    ->where('date_of_reservation', $request->input('date'))
                    ->get();
                    
                    $seats_already_reserved = [];
                    
                    foreach ($reservations as $r) {
                        foreach ($seats as $seat) {
                            if ($seat == $r->seat_number) {
                                array_push($seats_already_reserved, $seat);
                                break;
                            }
                        }
                    }

                    $msg = sprintf("места %s уже заняты", implode(',', $seats_already_reserved));

                } else {
                    $msg = $exception->errorInfo;
                }
            }
        }

        return response()->json([
            'code' => $code,
            'msg' => $msg,
        ]);
    }

    private function dateToNumber($date) {
        $d = new DateTime($date);
        $d = $d->format('l');
        
        switch ($d) {
            case 'Sunday':
                return 0;
            case 'Monday':
                return 1;
            case 'Tuesday':
                return 2;
            case 'Wednesday':
                return 3;
            case 'Thursday':
                return 4;
            case 'Friday':
                return 5;
            case 'Saturday':
                return 6;
            default:
                return -1;
        }
    }
}
