<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class QuestionType
 *
 * @property int $id
 * @property string|null $q_type
 *
 * @property Collection|QuizQuestion[] $quiz_questions
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class QuestionType extends Model
{
	protected $table = 'question_types';
	public $timestamps = false;

	protected $fillable = [
		'q_type'
	];

	public function quiz_questions()
	{
		return $this->hasMany(QuizQuestion::class, 'q_type_id');
	}
}
