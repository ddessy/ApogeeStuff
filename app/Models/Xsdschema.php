<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Xsdschema
 *
 * @property int $id
 * @property string|null $xsd_content
 * @property string|null $xsd_version
 * @property Carbon|null $created_at
 *
 * @property Collection|Game[] $games
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class Xsdschema extends Model
{
	protected $table = 'xsdschemas';
	public $timestamps = false;

	protected $fillable = [
		'xsd_content',
		'xsd_version'
	];

	public function games()
	{
		return $this->hasMany(Game::class, 'XSD_id');
	}
}
