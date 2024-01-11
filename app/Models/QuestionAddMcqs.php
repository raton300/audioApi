<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAddMcqs extends Model
{
    protected $table = 'questionAddMcqs';
    public function content_que()
    {
        return $this->belongsTo(Questions::class, 'id_que', 'id');
    }
}

