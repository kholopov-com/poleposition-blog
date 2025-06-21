<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Показывает список всех команд
     */
public function index()
{
    $teams = Team::with([
        'profile',          // если у вас есть профиль команды
        'drivers.stats'    // статистику пилотов
    ])->get();

    return view('teams', compact('teams'));
}
    /**
     * (Опционально) Страница одной команды
     */
    public function show($id)
    {
        $team = Team::with('drivers')->findOrFail($id);
        return view('team', compact('team'));
    }
}
