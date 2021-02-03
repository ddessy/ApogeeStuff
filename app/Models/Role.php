<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Role
 *
 * @property int $id
 * @property string|null $full_name
 *
 * @property Collection|User[] $users
 *
* @package App\Models
 */

/**
 * @mixin Builder
 */
class Role extends Model
{
	protected $table = 'roles';
	public $timestamps = false;

	protected $fillable = [
		'full_name'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
