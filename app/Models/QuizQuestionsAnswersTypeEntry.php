<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class QuizQuestionsAnswersTypeEntry
 *
 * @property int $id
 * @property int|null $quiz_questions_answers_type_id
 * @property string|null $answer_name
 * @property int|null $answer_value
 *
 * @property QuizQuestionsAnswersType|null $quiz_questions_answers_type
 * @property Collection|QuizQuestionsResponse[] $quiz_questions_responses
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class QuizQuestionsAnswersTypeEntry extends Model
{
	protected $table = 'quiz_questions_answers_type_entries';
	public $timestamps = false;

	protected $casts = [
		'quiz_questions_answers_type_id' => 'int',
		'answer_value' => 'int'
	];

	protected $fillable = [
		'quiz_questions_answers_type_id',
		'answer_name',
		'answer_value'
	];

	public function quiz_questions_answers_type()
	{
		return $this->belongsTo(QuizQuestionsAnswersType::class);
	}

	public function quiz_questions_responses()
	{
		return $this->hasMany(QuizQuestionsResponse::class, 'answer_type_id');
	}
}
