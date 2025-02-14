<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;


class Trainee extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isTrainee();
    }

    public function isTrainee(): bool
    {
        return true;
    }

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
