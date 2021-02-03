<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class QuizQuestionsAnswersType
 *
 * @property int $id
 * @property string|null $answer_type_name
 *
 * @property Collection|QuizQuestionsAnswer[] $quiz_questions_answers
 * @property Collection|QuizQuestionsAnswersTypeEntry[] $quiz_questions_answers_type_entries
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class QuizQuestionsAnswersType extends Model
{
	protected $table = 'quiz_questions_answers_types';
	public $timestamps = false;

	protected $fillable = [
		'answer_type_name'
	];

	public function quiz_questions_answers()
	{
		return $this->hasMany(QuizQuestionsAnswer::class);
	}

	public function quiz_questions_answers_type_entries()
	{
		return $this->hasMany(QuizQuestionsAnswersTypeEntry::class);
	}
}
