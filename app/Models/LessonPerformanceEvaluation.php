<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonPerformanceEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'grade',
        'course_criteria_id',
    ];


public function lesson(){
    return $this->belongsTo(Lesson::class);
}    
}
