<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    // Если имя таблицы нестандартное, раскомментируйте и укажите его:
    // protected $table = 'teams';

    // Разрешённые для массового заполнения поля
    protected $fillable = [
        'name',
    ];

    /**
     * Пилоты этой команды
     */
    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class);
    }

    /**
     * Гонки, в которых участвовала команда
     */
    public function races(): HasMany
    {
        return $this->hasMany(Race::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(TeamProfile::class);
    }
}
