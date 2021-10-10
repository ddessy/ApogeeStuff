<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LearningContentTaxonomy
 *
 * @property int $id
 * @property string|null $learning_concept_name
 * @property int|null $parent_id
 * @property Carbon|null $created_at
 * @property string|null $learning_concept_description
 *
 * @property LearningContentTaxonomy|null $learning_content_taxonomy
 * @property Collection|Game[] $games
 * @property Collection|LearningContent2taxonomy[] $learning_content2taxonomies
 * @property Collection|LearningContentTaxonomy[] $learning_content_taxonomies
 *
 * @package App\Models
 */

/**
 * @mixin Builder
 */
class LearningContentTaxonomy extends Model
{
    protected $table = 'learning_content_taxonomy';
    public $timestamps = false;

    protected $casts = [
        'parent_id' => 'int'
    ];

    protected $fillable = [
        'learning_concept_name',
        'parent_id',
        'learning_concept_description'
    ];

    public function learning_content_taxonomy()
    {
        return $this->belongsTo(LearningContentTaxonomy::class, 'parent_id');
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function learning_content2taxonomies()
    {
        return $this->hasMany(LearningContent2taxonomy::class);
    }

    public function learning_content_taxonomies()
    {
        return $this->hasMany(LearningContentTaxonomy::class, 'parent_id');
    }
}