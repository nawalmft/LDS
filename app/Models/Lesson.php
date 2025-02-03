<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [ 
        
        'title',
        'description',
        'video',
        'video_type',
        'img',
        'document',
        'enrollment_id',
        'status',
        'start_date',
        'lesson_time',      
        'notes',
        'trainer_id'
    ];


    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function enrollments(){
        return $this->belongsTo(Enrollment::class);
    }

    public function lessonperformanceevaluations(){
     return $this->hasMany(LessonPerformanceEvaluation::class);
    }

    public function trainer(){
        return $this->belongsTo(Trainee::class);
    }

}
