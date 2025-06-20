<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['name', 'team_id'];

    /**
     * �����: ���� ����� ����������� �������
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
