<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Page extends Model
{
	public $timestamps = false;
protected $fillable = ['slug', 'title', 'content', 'show_in_menu'];
}