<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class QuizQuestionsAnswersGrid
 *
 * @property int $id
 * @property int|null $quiz_question_id
 * @property string|null $answer_grid_name
 * @property string|null $answer_grid_descr
 *
 * @property QuizQuestion|null $quiz_question
 * @property Collection|QuizQuestionsAnswer[] $quiz_questions_answers
 * @property Collection|QuizQuestionsAnswersGridEntry[] $quiz_questions_answers_grid_entries
 *
 * @package App\Models
 */

/**
 * @mixin Builder
 */
class QuizQuestionsAnswersGrid extends Model
{
    protected $table = 'quiz_questions_answers_grid';
    public $timestamps = false;

    protected $casts = [
        'quiz_question_id' => 'int'
    ];

    protected $fillable = [
        'quiz_question_id',
        'answer_grid_name',
        'answer_grid_descr'
    ];

    public function quiz_question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }

    public function quiz_questions_answers()
    {
        return $this->hasMany(QuizQuestionsAnswer::class, 'answer_grid_id');
    }

    public function quiz_questions_answers_grid_entries()
    {
        return $this->hasMany(QuizQuestionsAnswersGridEntry::class, 'answer_grid_id');
    }
}