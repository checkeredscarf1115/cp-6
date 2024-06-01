<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $primaryKey = 'users_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $rememberTokenName = false;

    protected $fillable = [
        'users_id',
        'schedule_id',
        'bus_stops_bus_stop',
        'seat_number',
        'date_of_reservation',
    ];
}
