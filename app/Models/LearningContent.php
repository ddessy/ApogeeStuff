<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LearningContent
 *
 * @property int $id
 * @property string|null $content_name
 * @property string|null $content_description
 * @property boolean|null $content_body
 * @property string|null $content_presentation_style
 * @property string|null $content_complexity_level
 * @property string|null $content_status
 * @property int|null $ipr_id
 * @property int|null $file_ext_id
 * @property int|null $file_size_kb
 * @property string|null $author_name
 * @property int|null $creator_id
 * @property Carbon|null $created_at
 *
 * @property IntellectualPropRight|null $intellectual_prop_right
 * @property FileExtestion|null $file_extestion
 * @property User|null $user
 * @property Collection|LearningContent2taxonomy[] $learning_content2taxonomies
 *
 * @package App\Models
 */

/**
 * @mixin Builder
 */
class LearningContent extends Model
{
    protected $table = 'learning_contents';
    public $timestamps = false;

    protected $casts = [
        'content_body' => 'boolean',
        'ipr_id' => 'int',
        'file_ext_id' => 'int',
        'file_size_kb' => 'int',
        'creator_id' => 'int'
    ];

    protected $fillable = [
        'content_name',
        'content_description',
        'content_body',
        'content_presentation_style',
        'content_complexity_level',
        'content_status',
        'ipr_id',
        'file_ext_id',
        'file_size_kb',
        'author_name',
        'creator_id'
    ];

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

    public function learning_content2taxonomies()
    {
        return $this->hasMany(LearningContent2taxonomy::class);
    }
}