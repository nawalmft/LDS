<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
   protected $fillable = [
    'title',
    'description',
    'fee',
    'hour_price',
    'course_duration',
    'hours_per_day',
    'transmission_type',];

   public function user(){
    return $this->belongsTo(User::class);
   }

   public function lessons(){
    return $this->hasMany(Lesson::class);
   }

   public function tests(){
    return $this->hasMany(Test::class);
   }


   public function enrollments(){
    return $this->hasMany(Enrollment::class);
   }

   public function enrollmentsRequests(){
    return $this->hasMany(EnrollmentRequest::class);
   }
   
   public function courseperformancecriterias(){
    return $this->hasMany(CoursePerformanceCriteria::class);
   }
}
