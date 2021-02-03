<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class QuizQuestionsAnswer
 *
 * @property int $id
 * @property int|null $quiz_question_id
 * @property int|null $quiz_questions_answers_type_id
 * @property int|null $answer_grid_id
 * @property string|null $answer_descr
 *
 * @property QuizQuestion|null $quiz_question
 * @property QuizQuestionsAnswersType|null $quiz_questions_answers_type
 * @property QuizQuestionsAnswersGrid|null $quiz_questions_answers_grid
 * @property Collection|QuizQuestionsResponse[] $quiz_questions_responses
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class QuizQuestionsAnswer extends Model
{
	protected $table = 'quiz_questions_answers';
	public $timestamps = false;

	protected $casts = [
		'quiz_question_id' => 'int',
		'quiz_questions_answers_type_id' => 'int',
		'answer_grid_id' => 'int'
	];

	protected $fillable = [
		'quiz_question_id',
		'quiz_questions_answers_type_id',
		'answer_grid_id',
		'answer_descr'
	];

	public function quiz_question()
	{
		return $this->belongsTo(QuizQuestion::class);
	}

	public function quiz_questions_answers_type()
	{
		return $this->belongsTo(QuizQuestionsAnswersType::class);
	}

	public function quiz_questions_answers_grid()
	{
		return $this->belongsTo(QuizQuestionsAnswersGrid::class, 'answer_grid_id');
	}

	public function quiz_questions_responses()
	{
		return $this->hasMany(QuizQuestionsResponse::class, 'answer_grid_entry_id');
	}
}
