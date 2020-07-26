<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";

    protected $fillable = [
        'fullname',
        'gender',
        'birthday',
        'address',
        'phone_number',
        'status',
        'faculty_id'
    ];

    public function faculty(){
        return $this->belongsTo('App\Models\Faculty', 'faculty_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'student_subject')->withPivot('avg_score')->withTimestamps();
    }
}
