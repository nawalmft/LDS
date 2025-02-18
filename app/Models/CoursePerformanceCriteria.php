<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePerformanceCriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'criteria',
        'total_grade',
        'criteria_description',
        'minimum_score',
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function lessonperformanceevaluations(){
        return $this->hasMany(LessonPerformanceEvaluation::class);
    }
}
