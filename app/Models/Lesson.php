<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'course_id',
        'status',
        'start_date',      
        'notes',
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

}
