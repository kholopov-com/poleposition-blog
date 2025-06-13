<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Application extends Model
{
public $timestamps = false;
    protected $fillable = [
        'user_id', 'author', 'title', 'type', 'publisher',
        'year', 'cover', 'condition', 'status', 'rejection_reason',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
