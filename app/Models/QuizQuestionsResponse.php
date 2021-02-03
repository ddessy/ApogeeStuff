<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class QuizQuestionsResponse
 *
 * @property int $id
 * @property int|null $respondent_id
 * @property int|null $quiz_question_id
 * @property string|null $response_text
 * @property int|null $answer_type_id
 * @property int|null $answer_grid_entry_id
 * @property Carbon|null $registered_at
 *
 * @property User|null $user
 * @property QuizQuestion|null $quiz_question
 * @property QuizQuestionsAnswersTypeEntry|null $quiz_questions_answers_type_entry
 * @property QuizQuestionsAnswer|null $quiz_questions_answer
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class QuizQuestionsResponse extends Model
{
	protected $table = 'quiz_questions_responses';
	public $timestamps = false;

	protected $casts = [
		'respondent_id' => 'int',
		'quiz_question_id' => 'int',
		'answer_type_id' => 'int',
		'answer_grid_entry_id' => 'int'
	];

	protected $dates = [
		'registered_at'
	];

	protected $fillable = [
		'respondent_id',
		'quiz_question_id',
		'response_text',
		'answer_type_id',
		'answer_grid_entry_id',
		'registered_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'respondent_id');
	}

	public function quiz_question()
	{
		return $this->belongsTo(QuizQuestion::class);
	}

	public function quiz_questions_answers_type_entry()
	{
		return $this->belongsTo(QuizQuestionsAnswersTypeEntry::class, 'answer_type_id');
	}

	public function quiz_questions_answer()
	{
		return $this->belongsTo(QuizQuestionsAnswer::class, 'answer_grid_entry_id');
	}
}
