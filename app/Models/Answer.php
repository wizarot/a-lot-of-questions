<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['content'];
    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo(Questions::class, 'question_id');
    }

}
