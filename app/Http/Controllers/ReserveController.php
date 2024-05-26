<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $seats_reserved = [1, 5, 10];
        return view('reserve')->with('seats_reserved', $seats_reserved)
        ;
    }
}
