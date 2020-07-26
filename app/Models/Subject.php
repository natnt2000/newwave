<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = "subjects";

    protected $fillable = [
        'name',
        'faculty_id'
    ];

    public function faculty()
    {
        return $this->belongsTo('App\Models\Faculty', 'faculty_id');
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\Student', 'student_subject')->withPivot('avg_score')->withTimestamps();
    }
}
