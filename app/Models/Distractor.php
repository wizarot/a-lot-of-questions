<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distractor extends Model
{
    protected $table = 'distractors';
    protected $fillable = ['content'];
    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo(Questions::class, 'question_id');
    }
}
