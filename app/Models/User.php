<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public static $key = 'id';

    public $timestamps = false;

    protected $attributes = [
        'role_id' => Role::student,
    ];

    public function role_id() {
        $this->belongsTo(Role::class);
    }

    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }
}
