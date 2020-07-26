<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculties';

    protected $fillable = [
        'name'
    ];

    public function students()
    {
        return $this->hasMany('App\Models\Student', 'faculty_id');
    }

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject', 'faculty_id');
    }
}
