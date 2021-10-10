<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Game
 *
 * @property int $id
 * @property string|null $game_name
 * @property int|null $creator_id
 * @property Carbon|null $created_at
 * @property string|null $game_description
 * @property string|null $game_body
 * @property string|null $game_version
 * @property int|null $XSD_id
 * @property int|null $learning_content_taxonomy_id
 *
 * @property User|null $user
 * @property Xsdschema|null $xsdschema
 * @property LearningContentTaxonomy|null $learning_content_taxonomy
 * @property Collection|MazeGameResult[] $maze_game_results
 * @property Collection|PuzzleGamesResult[] $puzzle_games_results
 *
 * @package App\Models
 */

/**
 * @mixin Builder
 */
class Game extends Model
{
    protected $table = 'games';
    public $timestamps = false;

    protected $casts = [
        'creator_id' => 'int',
        'XSD_id' => 'int',
        'learning_content_taxonomy_id' => 'int'
    ];

    protected $fillable = [
        'game_name',
        'creator_id',
        'game_description',
        'game_body',
        'game_version',
        'XSD_id',
        'learning_content_taxonomy_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function xsdschema()
    {
        return $this->belongsTo(Xsdschema::class, 'XSD_id');
    }

    public function learning_content_taxonomy()
    {
        return $this->belongsTo(LearningContentTaxonomy::class);
    }

    public function maze_game_results()
    {
        return $this->hasMany(MazeGameResult::class, 'maze_game_id');
    }

    public function puzzle_games_results()
    {
        return $this->hasMany(PuzzleGamesResult::class, 'maze_game_id');
    }
}