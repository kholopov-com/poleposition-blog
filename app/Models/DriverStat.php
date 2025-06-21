<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverStat extends Model
{
    protected $table = 'driver_stats';
    public $timestamps = false;
    protected $fillable = [
      'driver_id','position','seasons','grand_prix_count','debut',
      'wins','poles','podiums','points','fastest_laps','photo'
    ];
}
