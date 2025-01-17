<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Phpunit\TestResult;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_grade',
        'course_id',
        'user_id',
        'test_type',
        'start_date',
        'duration',
        'passing_score',
        'total_questions',
        'datetime_start'
    ];


    public function test_result(){
        return $this->hasMany(TestResult::class);
        }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function test_attempt(){
        return $this->hasMany(TestAttempt::class);
    }

    public function test_questions(){
        return $this->hasMany(TestQuestion::class);
        }
}
