<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class OtherStudentDatum
 *
 * @property int $id
 * @property int|null $student_id
 * @property int|null $property_id
 * @property Carbon|null $created_at
 *
 * @property User|null $user
 * @property StudentModelProperty|null $student_model_property
 *
 * @package App\Models
 */

/**
 * @mixin Builder
 */
class OtherStudentDatum extends Model
{
    protected $table = 'other_student_data';
    public $timestamps = false;

    protected $casts = [
        'student_id' => 'int',
        'property_id' => 'int'
    ];

    protected $fillable = [
        'student_id',
        'property_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function student_model_property()
    {
        return $this->belongsTo(StudentModelProperty::class, 'property_id');
    }
}