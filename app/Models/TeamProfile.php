<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamProfile extends Model
{
    protected $table = 'team_profiles';
    public $timestamps = false;
    protected $fillable = ['team_id','description','image'];
}
