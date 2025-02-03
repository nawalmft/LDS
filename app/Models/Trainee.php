<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'email',
    'phone',
    'password',
    'date_of_birth',
    'gender',
    'image',
    'email_verified_at',
    ];


    public function enrollment()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function enrollmentrequest(){
        return $this->hasMany(EnrollmentRequest::class);
        
    }
    
    public function test(){
        return $this->hasMany(Test::class);
    }

    public function test_result(){
        return $this->hasMany(TestResult::class);
    }

    public function lessonperformanceevaluation(){
        return $this->hasMany(LessonPerformanceEvaluation::class);
    }


    public function test_attempt(){
        return $this->hasMany(TestAttempt::class);
    }

    public function lesson(){
        return $this->hasMany(Lesson::class);
    }
}
