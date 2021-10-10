<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class MazeGameResult
 *
 * @property int $id
 * @property int|null $player_id
 * @property int|null $maze_game_id
 * @property int|null $total_playing_time
 * @property int|null $total_points
 * @property float|null $total_game_goals_exec
 * @property float|null $general_score
 * @property float|null $general_effectiveness
 * @property float|null $general_efficiency
 * @property Carbon|null $registered_at
 *
 * @property User|null $user
 * @property Game|null $game
 * @property Collection|PuzzleGamesResult[] $puzzle_games_results
 *
 * @package App\Models
 */

/**
 * @mixin Builder
 */

/**
 * @mixin Builder
 */
class MazeGameResult extends Model
{
    protected $table = 'maze_game_results';
    public $timestamps = false;

    protected $casts = [
        'player_id' => 'int',
        'maze_game_id' => 'int',
        'total_playing_time' => 'int',
        'total_points' => 'int',
        'total_game_goals_exec' => 'float',
        'general_score' => 'float',
        'general_effectiveness' => 'float',
        'general_efficiency' => 'float'
    ];

    protected $dates = [
        'registered_at'
    ];

    protected $fillable = [
        'player_id',
        'maze_game_id',
        'total_playing_time',
        'total_points',
        'total_game_goals_exec',
        'general_score',
        'general_effectiveness',
        'general_efficiency',
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

    public function puzzle_games_results()
    {
        return $this->hasMany(PuzzleGamesResult::class, 'maze_game_results_id');
    }
}