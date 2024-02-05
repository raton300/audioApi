<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    protected $fillable = [
        'text_tdl','date_tdl','category_tdl'
    ];
}
