<?php

namespace App\Http\Controllers;

use App\Models\Race;

class CalendarController extends Controller
{
    public function index()
    {
        $races = Race::with(['circuit', 'winner', 'team'])->orderBy('race_date')->get();
        return view('calendar', compact('races'));
    }
}
