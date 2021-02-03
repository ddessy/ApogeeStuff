<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class QuizQuestion
 *
 * @property int $id
 * @property int|null $quiz_id
 * @property int|null $q_type_id
 * @property string|null $q_name
 * @property string|null $q_descr
 * @property int|null $q_student_model_property_id
 *
 * @property Quiz|null $quiz
 * @property QuestionType|null $question_type
 * @property StudentModelProperty|null $student_model_property
 * @property Collection|QuizQuestionsAnswer[] $quiz_questions_answers
 * @property Collection|QuizQuestionsAnswersGrid[] $quiz_questions_answers_grids
 * @property Collection|QuizQuestionsAnswersGridEntry[] $quiz_questions_answers_grid_entries
 * @property Collection|QuizQuestionsResponse[] $quiz_questions_responses
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class QuizQuestion extends Model
{
	protected $table = 'quiz_questions';
	public $timestamps = false;

	protected $casts = [
		'quiz_id' => 'int',
		'q_type_id' => 'int',
		'q_student_model_property_id' => 'int'
	];

	protected $fillable = [
		'quiz_id',
		'q_type_id',
		'q_name',
		'q_descr',
		'q_student_model_property_id'
	];

	public function quiz()
	{
		return $this->belongsTo(Quiz::class);
	}

	public function question_type()
	{
		return $this->belongsTo(QuestionType::class, 'q_type_id');
	}

	public function student_model_property()
	{
		return $this->belongsTo(StudentModelProperty::class, 'q_student_model_property_id');
	}

	public function quiz_questions_answers()
	{
		return $this->hasMany(QuizQuestionsAnswer::class);
	}

	public function quiz_questions_answers_grids()
	{
		return $this->hasMany(QuizQuestionsAnswersGrid::class);
	}

	public function quiz_questions_answers_grid_entries()
	{
		return $this->hasMany(QuizQuestionsAnswersGridEntry::class);
	}

	public function quiz_questions_responses()
	{
		return $this->hasMany(QuizQuestionsResponse::class);
	}
}
