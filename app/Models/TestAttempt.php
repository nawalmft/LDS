<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'user_id',
        'question_answer_id',
        'trainee_id',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }   

    public function test(){
        return $this->belongsTo(Test::class);
    }

    public function test_question(){
        return $this->hasMany(TestQuestion::class);
    }

    public function question_answer(){
        return $this->belongsTo(QuestionAnswer::class);
    }
    public function trainee(){
        return $this->belongsTo(Trainee::class);
    }
}
