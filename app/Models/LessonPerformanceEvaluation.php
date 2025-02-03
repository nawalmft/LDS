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
        'trainee_id',
    ];


public function lesson(){
    return $this->belongsTo(Lesson::class);
}    
public function course_criteria(){
    return $this->belongsTo(CoursePerformanceCriteria::class,'course_criteria_id');
}
public function trainee(){
    return $this->belongsTo(Trainee::class,'trainee_id');
}
}