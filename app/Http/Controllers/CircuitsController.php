<?php

namespace App\Http\Controllers;

use App\Models\Circuit; // или нужные вам модели
use Illuminate\Http\Request;

class CircuitsController extends Controller
{
    public function index()
    {
        $circuits = Circuit::all();
        return view('circuits', compact('circuits'));
    }
    // … другие методы …
}
