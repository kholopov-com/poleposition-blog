<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    // ... ваши fillable / hidden / timestamps и т.д.

    /**
     * Один-к-одному: статистика пилота
     */
    public function stats()
    {
        return $this->hasOne(DriverStat::class, 'driver_id');
    }
}
