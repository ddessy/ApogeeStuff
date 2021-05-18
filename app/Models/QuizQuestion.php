<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quiz_questions';

    public static $key = 'id';

    public function quiz_id() {
        $this->belongsTo(Quiz::class);
    }

    public function q_type_id() {
        $this->belongsTo(QuestionType::class);
    }

    public function q_student_model_property_id() {
        $this->belongsTo(StudentModelProperty::class);
    }

}