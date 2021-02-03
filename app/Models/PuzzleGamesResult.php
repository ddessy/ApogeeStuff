<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PuzzleGamesResult
 *
 * @property int $id
 * @property int|null $player_id
 * @property int|null $maze_game_id
 * @property int|null $maze_game_results_id
 * @property string|null $puzzle_game_name
 * @property int|null $playing_time
 * @property int|null $points
 * @property float|null $grade
 * @property float|null $game_goals_exec
 * @property float|null $general_score
 * @property float|null $efficiency
 * @property Carbon|null $registered_at
 *
 * @property User|null $user
 * @property Game|null $game
 * @property MazeGameResult|null $maze_game_result
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class PuzzleGamesResult extends Model
{
	protected $table = 'puzzle_games_results';
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'maze_game_id' => 'int',
		'maze_game_results_id' => 'int',
		'playing_time' => 'int',
		'points' => 'int',
		'grade' => 'float',
		'game_goals_exec' => 'float',
		'general_score' => 'float',
		'efficiency' => 'float'
	];

	protected $dates = [
		'registered_at'
	];

	protected $fillable = [
		'player_id',
		'maze_game_id',
		'maze_game_results_id',
		'puzzle_game_name',
		'playing_time',
		'points',
		'grade',
		'game_goals_exec',
		'general_score',
		'efficiency',
		'registered_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'player_id');
	}

	public function game()
	{
		return $this->belongsTo(Game::class, 'maze_game_id');
	}

	public function maze_game_result()
	{
		return $this->belongsTo(MazeGameResult::class, 'maze_game_results_id');
	}
}
