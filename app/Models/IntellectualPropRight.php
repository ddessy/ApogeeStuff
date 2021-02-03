<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class IntellectualPropRight
 *
 * @property int $id
 * @property string|null $ipr_name
 * @property string|null $ipr_descr
 *
 * @property Collection|GameAsset[] $game_assets
 * @property Collection|LearningContent[] $learning_contents
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class IntellectualPropRight extends Model
{
	protected $table = 'intellectual_prop_rights';
	public $timestamps = false;

	protected $fillable = [
		'ipr_name',
		'ipr_descr'
	];

	public function game_assets()
	{
		return $this->hasMany(GameAsset::class, 'ipr_id');
	}

	public function learning_contents()
	{
		return $this->hasMany(LearningContent::class, 'ipr_id');
	}
}
