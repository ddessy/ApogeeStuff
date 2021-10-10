<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LearningContent2taxonomy
 *
 * @property int $id
 * @property int|null $learning_content_id
 * @property int|null $learning_content_taxonomy_id
 *
 * @property LearningContent|null $learning_content
 * @property LearningContentTaxonomy|null $learning_content_taxonomy
 *
 * @package App\Models
 */

/**
 * @mixin Builder
 */
class LearningContent2taxonomy extends Model
{
    protected $table = 'learning_content2taxonomy';
    public $timestamps = false;

    protected $casts = [
        'learning_content_id' => 'int',
        'learning_content_taxonomy_id' => 'int'
    ];

    protected $fillable = [
        'learning_content_id',
        'learning_content_taxonomy_id'
    ];

    public function learning_content()
    {
        return $this->belongsTo(LearningContent::class);
    }

    public function learning_content_taxonomy()
    {
        return $this->belongsTo(LearningContentTaxonomy::class);
    }
}