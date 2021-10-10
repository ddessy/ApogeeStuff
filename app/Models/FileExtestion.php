<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FileExtestion
 *
 * @property int $id
 * @property string|null $file_extestion
 * @property string|null $file_type
 *
 * @property Collection|GameAsset[] $game_assets
 * @property Collection|LearningContent[] $learning_contents
 *
 * @package App\Models
 */

/**
 * @mixin Builder
 */
class FileExtestion extends Model
{
    protected $table = 'file_extestions';
    public $timestamps = false;

    protected $fillable = [
        'file_extestion',
        'file_type'
    ];

    public function game_assets()
    {
        return $this->hasMany(GameAsset::class, 'file_ext_id');
    }

    public function learning_contents()
    {
        return $this->hasMany(LearningContent::class, 'file_ext_id');
    }
}