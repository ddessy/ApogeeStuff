<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModelProperty extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_model_properties';

    public static $key = 'id';

    public function quizQuestions() {
        return $this->hasMany(QuizQuestion::class);
    }

}