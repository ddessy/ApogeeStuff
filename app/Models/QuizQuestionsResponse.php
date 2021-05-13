<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestionsResponse extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quiz_questions_responses';

    public static $key = 'id';

    public $timestamps = false;

    public function respondent_id() {
        $this->belongsTo(User::class);
    }

    public function quiz_question_id() {
        $this->belongsTo(QuizQuestion::class);
    }

    public function answer_type_id() {
        $this->belongsTo(QuizQuestionsAnswersTypeEntry::class);
    }

    public function answer_grid_entry_id() {
        $this->belongsTo(QuizQuestionsAnswersGridEntry::class);
    }
}