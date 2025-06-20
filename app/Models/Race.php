<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    // Какие поля можно массово заполнять
    protected $fillable = [
        'race_date',
        'grand_prix',
        'circuit_id',
        'winner_id',
        'team_id',
    ];

    /**
     * Связь с таблицей circuits
     */
    public function circuit()
    {
        return $this->belongsTo(Circuit::class);
    }

    /**
     * Победитель — это драйвер по полю winner_id
     */
    public function winner()
    {
        return $this->belongsTo(Driver::class, 'winner_id');
    }

    /**
     * Команда-победитель
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
