<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Quiz
 *
 * @property int $id
 * @property int|null $creator_id
 * @property string|null $quiz_name
 * @property string|null $quiz_descr
 * @property Carbon|null $created_at
 *
 * @property User|null $user
 * @property Collection|QuizQuestion[] $quiz_questions
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class Quiz extends Model
{
	protected $table = 'quizzes';
	public $timestamps = false;

	protected $casts = [
		'creator_id' => 'int'
	];

	protected $fillable = [
		'creator_id',
		'quiz_name',
		'quiz_descr'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'creator_id');
	}

	public function quiz_questions()
	{
		return $this->hasMany(QuizQuestion::class);
	}
}
