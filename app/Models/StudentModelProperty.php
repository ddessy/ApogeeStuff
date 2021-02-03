<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class StudentModelProperty
 *
 * @property int $id
 * @property string|null $property_name
 * @property string|null $property_type
 * @property string|null $property_quantity
 *
 * @property Collection|LearningStyle[] $learning_styles
 * @property Collection|OtherStudentDatum[] $other_student_data
 * @property Collection|PlayingStyle[] $playing_styles
 * @property Collection|QuizQuestion[] $quiz_questions
 * @property Collection|QuizQuestionsAnswersGridEntry[] $quiz_questions_answers_grid_entries
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class StudentModelProperty extends Model
{
	protected $table = 'student_model_properties';
	public $timestamps = false;

	protected $fillable = [
		'property_name',
		'property_type',
		'property_quantity'
	];

	public function learning_styles()
	{
		return $this->hasMany(LearningStyle::class, 'style4_name_id');
	}

	public function other_student_data()
	{
		return $this->hasMany(OtherStudentDatum::class, 'property_id');
	}

	public function playing_styles()
	{
		return $this->hasMany(PlayingStyle::class, 'style4_name_id');
	}

	public function quiz_questions()
	{
		return $this->hasMany(QuizQuestion::class, 'q_student_model_property_id');
	}

	public function quiz_questions_answers_grid_entries()
	{
		return $this->hasMany(QuizQuestionsAnswersGridEntry::class, 'entry_student_model_property_id');
	}
}
