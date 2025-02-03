<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'question_level',
        'points',
    ];

    public function test(){
        return $this->belongsTo(Test::class);
    }

    public function question_answer(){
        return $this->hasOne(QuestionAnswer::class);
    }

    public function test_question(){
        return $this->hasMany(TestQuestion::class);
    }
}
