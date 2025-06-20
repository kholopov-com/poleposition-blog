<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    // Отключаем автоматические поля created_at/updated_at
    public $timestamps = false;

    // Какие поля можно массово заполнять
    protected $fillable = [
        'slug',
        'title',
        'content',
        'show_in_menu',
    ];
}
