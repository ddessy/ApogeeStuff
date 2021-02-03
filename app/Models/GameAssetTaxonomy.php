<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class GameAssetTaxonomy
 *
 * @property int $id
 * @property string|null $asset_type_name
 * @property int|null $parent_id
 * @property Carbon|null $created_at
 * @property string|null $resource_description
 *
 * @property GameAssetTaxonomy|null $game_asset_taxonomy
 * @property Collection|GameAssetTaxonomy[] $game_asset_taxonomies
 * @property Collection|GameAsset[] $game_assets
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class GameAssetTaxonomy extends Model
{
	protected $table = 'game_asset_taxonomy';
	public $timestamps = false;

	protected $casts = [
		'parent_id' => 'int'
	];

	protected $fillable = [
		'asset_type_name',
		'parent_id',
		'resource_description'
	];

	public function game_asset_taxonomy()
	{
		return $this->belongsTo(GameAssetTaxonomy::class, 'parent_id');
	}

	public function game_asset_taxonomies()
	{
		return $this->hasMany(GameAssetTaxonomy::class, 'parent_id');
	}

	public function game_assets()
	{
		return $this->hasMany(GameAsset::class, 'asset_taxonomy_id');
	}
}
