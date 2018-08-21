<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';

    public function answer()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

    public function distractor()
    {
        return $this->hasMany(Distractor::class, 'question_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
