<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;        // <- вот этот импорт обязателен
// (и при необходимости) use App\Models\Circuit, Driver, Team;

class CalendarController extends Controller
{
    public function index()
    {
        // теперь Laravel найдёт модель Race
        $races = Race::with(['circuit','winner','team'])
                     ->orderBy('race_date')->get();
        return view('calendar', compact('races'));
    }
}
