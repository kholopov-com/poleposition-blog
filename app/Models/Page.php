<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    // ��������� �������������� ���� created_at/updated_at
    public $timestamps = false;

    // ����� ���� ����� ������� ���������
    protected $fillable = [
        'slug',
        'title',
        'content',
        'show_in_menu',
    ];
}
