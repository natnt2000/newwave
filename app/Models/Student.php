<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Student extends Model
{
    protected $appends = ['age', 'avg_score'];

    protected $fillable = [
        'fullname',
        'gender',
        'birthday',
        'address',
        'phone_number',
        'avatar',
        'status',
        'faculty_id',
        'user_id',
    ];

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject')->withPivot('score')->withTimestamps();
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthday)->age > 0  ? Carbon::parse($this->birthday)->age : 1;
    }

    public function getAvgScoreAttribute()
    {
        return $this->subjects()->avg('score') ?: 0;
    }
}
