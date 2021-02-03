<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class User
 *
 * @property int $id
 * @property string|null $full_name
 * @property string|null $user_name
 * @property string|null $password
 * @property Carbon $created_at
 * @property int|null $age
 * @property int|null $gender
 * @property int|null $grade
 * @property string|null $email
 * @property string|null $nick_name
 * @property int|null $fungame_skills
 * @property int|null $edugame_skills
 * @property int|null $status
 * @property int|null $role_id
 *
 * @property Role|null $role
 * @property Collection|GameAsset[] $game_assets
 * @property Collection|Game[] $games
 * @property Collection|LearningContent[] $learning_contents
 * @property Collection|LearningStyle[] $learning_styles
 * @property Collection|MazeGameResult[] $maze_game_results
 * @property Collection|OtherStudentDatum[] $other_student_data
 * @property Collection|PlayingStyle[] $playing_styles
 * @property Collection|PuzzleGamesResult[] $puzzle_games_results
 * @property Collection|QuizQuestionsResponse[] $quiz_questions_responses
 * @property Collection|Quiz[] $quizzes
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class User extends Model
{
	protected $table = 'users';
	public $timestamps = false;

	protected $casts = [
		'age' => 'int',
		'gender' => 'int',
		'grade' => 'int',
		'fungame_skills' => 'int',
		'edugame_skills' => 'int',
		'status' => 'int',
		'role_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'full_name',
		'user_name',
		'password',
		'age',
		'gender',
		'grade',
		'email',
		'nick_name',
		'fungame_skills',
		'edugame_skills',
		'status',
		'role_id'
	];

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function game_assets()
	{
		return $this->hasMany(GameAsset::class, 'creator_id');
	}

	public function games()
	{
		return $this->hasMany(Game::class, 'creator_id');
	}

	public function learning_contents()
	{
		return $this->hasMany(LearningContent::class, 'creator_id');
	}

	public function learning_styles()
	{
		return $this->hasMany(LearningStyle::class, 'student_id');
	}

	public function maze_game_results()
	{
		return $this->hasMany(MazeGameResult::class, 'player_id');
	}

	public function other_student_data()
	{
		return $this->hasMany(OtherStudentDatum::class, 'student_id');
	}

	public function playing_styles()
	{
		return $this->hasMany(PlayingStyle::class, 'student_id');
	}

	public function puzzle_games_results()
	{
		return $this->hasMany(PuzzleGamesResult::class, 'player_id');
	}

	public function quiz_questions_responses()
	{
		return $this->hasMany(QuizQuestionsResponse::class, 'respondent_id');
	}

	public function quizzes()
	{
		return $this->hasMany(Quiz::class, 'creator_id');
	}
}
