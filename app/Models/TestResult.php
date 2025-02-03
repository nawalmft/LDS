<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'user_id',
        'score',
        'time',
        'status',
        'trainee_id',
    ];



    public function test(){
        return $this->belongsTo(Test::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function trainee(){
        return $this->belongsTo(Trainee::class);
    }
}
