<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendar';
    public $timestamps = false;  // у нас нет полей created_at и updated_at

    protected $fillable = [
        'date', 'grand_prix', 'circuit', 'winner', 'team'
    ];
}
