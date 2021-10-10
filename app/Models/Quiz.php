<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public static $key = 'id';

    public function creator_id() {
        $this->belongsTo(User::class);
    }

    public function quizQuestions() {
        return $this->hasMany(QuizQuestion::class);
    }


}