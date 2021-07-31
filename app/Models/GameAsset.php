<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class GameAsset
 *
 * @property int $id
 * @property string|null $asset_name
 * @property string|null $asset_description
 * @property boolean|null $asset_body
 * @property int|null $asset_for_game
 * @property int|null $asset_status
 * @property int|null $asset_taxonomy_id
 * @property int|null $ipr_id
 * @property int|null $file_ext_id
 * @property int|null $file_size_kb
 * @property string|null $author_name
 * @property int|null $creator_id
 * @property Carbon|null $created_at
 *
 * @property GameAssetTaxonomy|null $game_asset_taxonomy
 * @property IntellectualPropRight|null $intellectual_prop_right
 * @property FileExtestion|null $file_extestion
 * @property User|null $user
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class GameAsset extends Model
{
	protected $table = 'game_assets';
	public $timestamps = false;

	protected $casts = [
		'asset_body' => 'boolean',
		'asset_for_game' => 'int',
		'asset_status' => 'int',
		'asset_taxonomy_id' => 'int',
		'ipr_id' => 'int',
		'file_ext_id' => 'int',
		'file_size_kb' => 'int',
		'creator_id' => 'int'
	];

	protected $fillable = [
		'asset_name',
		'asset_description',
		'asset_body',
		'asset_for_game',
		'asset_status',
		'asset_taxonomy_id',
		'ipr_id',
		'file_ext_id',
		'file_size_kb',
		'author_name',
		'creator_id'
	];

	public function game_asset_taxonomy()
	{
		return $this->belongsTo(GameAssetTaxonomy::class, 'asset_taxonomy_id');
	}

	public function intellectual_prop_right()
	{
		return $this->belongsTo(IntellectualPropRight::class, 'ipr_id');
	}

	public function file_extestion()
	{
		return $this->belongsTo(FileExtestion::class, 'file_ext_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'creator_id');
	}
}
