<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayingStyle extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'playing_styles';

    const PLAYING_STYLES = array("COMPETITOR" => "5", "DREAMER" => "6", "LOGICIAN" => "7", "STRATEGIST" => "8");

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
