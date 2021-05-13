<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningStyle extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'learning_styles';

    const LEARNING_STYLES = array("VISUAL" => "1", "AUDITORY" => "2", "RW" => "3", "KINESTHETIC" => "4");

    public static $key = 'id';

    public $timestamps = false;

    public function student_id(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function style1_name_id(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(StudentModelProperty::class);
    }

    public function style2_name_id(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(StudentModelProperty::class);
    }

    public function style3_name_id(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(StudentModelProperty::class);
    }

    public function style4_name_id(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(StudentModelProperty::class);
    }
}
