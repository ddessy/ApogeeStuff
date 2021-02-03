<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class QuizQuestionsAnswersGridEntry
 *
 * @property int $id
 * @property int|null $quiz_question_id
 * @property int $answer_grid_id
 * @property int|null $answer_grid_entry_value
 * @property string|null $answer_grid_entry_name
 * @property string|null $answer_grid_entry_descr
 * @property int|null $entry_student_model_property_id
 *
 * @property QuizQuestion|null $quiz_question
 * @property QuizQuestionsAnswersGrid $quiz_questions_answers_grid
 * @property StudentModelProperty|null $student_model_property
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class QuizQuestionsAnswersGridEntry extends Model
{
	protected $table = 'quiz_questions_answers_grid_entries';
	public $timestamps = false;

	protected $casts = [
		'quiz_question_id' => 'int',
		'answer_grid_id' => 'int',
		'answer_grid_entry_value' => 'int',
		'entry_student_model_property_id' => 'int'
	];

	protected $fillable = [
		'quiz_question_id',
		'answer_grid_id',
		'answer_grid_entry_value',
		'answer_grid_entry_name',
		'answer_grid_entry_descr',
		'entry_student_model_property_id'
	];

	public function quiz_question()
	{
		return $this->belongsTo(QuizQuestion::class);
	}

	public function quiz_questions_answers_grid()
	{
		return $this->belongsTo(QuizQuestionsAnswersGrid::class, 'answer_grid_id');
	}

	public function student_model_property()
	{
		return $this->belongsTo(StudentModelProperty::class, 'entry_student_model_property_id');
	}
}
