<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LearningStyle
 *
 * @property int $id
 * @property int|null $student_id
 * @property int|null $style1_name_id
 * @property int|null $style1_value
 * @property int|null $style2_name_id
 * @property int|null $style2_value
 * @property int|null $style3_name_id
 * @property int|null $style3_value
 * @property int|null $style4_name_id
 * @property int|null $style4_value
 * @property Carbon|null $created_at
 *
 * @property User|null $user
 * @property StudentModelProperty|null $student_model_property
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class LearningStyle extends Model
{
	protected $table = 'learning_styles';
	public $timestamps = false;

	protected $casts = [
		'student_id' => 'int',
		'style1_name_id' => 'int',
		'style1_value' => 'int',
		'style2_name_id' => 'int',
		'style2_value' => 'int',
		'style3_name_id' => 'int',
		'style3_value' => 'int',
		'style4_name_id' => 'int',
		'style4_value' => 'int'
	];

	protected $fillable = [
		'student_id',
		'style1_name_id',
		'style1_value',
		'style2_name_id',
		'style2_value',
		'style3_name_id',
		'style3_value',
		'style4_name_id',
		'style4_value'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'student_id');
	}

	public function student_model_property()
	{
		return $this->belongsTo(StudentModelProperty::class, 'style4_name_id');
	}
}
