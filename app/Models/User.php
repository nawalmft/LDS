<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'date_of_birth',
        'image',
    ];

    public function course(){
        return $this->hasMany(Course::class);
    }

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }


    public function enrollmentsRequests(){
        return $this->hasMany(EnrollmentRequest::class);
    }

    public function tests(){
        return $this->hasMany(Test::class);
    }

    public function testattempt(){
        return $this->hasMany(TestAttempt::class);
    }

    public function testresult(){
        return $this->hasMany(TestResult::class);
    }

    public function courseperformancecriterias(){
        return $this->hasMany(CoursePerformanceCriteria::class);
    }

    public function lessonperformanceevaluations(){
        return $this->hasMany(LessonPerformanceEvaluation::class);
    }

   

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
