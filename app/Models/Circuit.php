<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}
