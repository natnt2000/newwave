<?php

namespace App\Repositories\Eloquents;

use App\Models\Faculty;
use App\Models\Subject;
use App\Repositories\Contracts\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function all()
    {
        return Subject::all();
    }

    public function getAllFaculty()
    {
        return Faculty::all();
    }

    public function create($request)
    {
        $subject = new Subject;

        $subject->name = $request->name;
        $subject->faculty_id = $request->faculty_id;

        $subject->save();
    }

    public function find($id)
    {
        return Subject::find($id);
    }

    public function update($request, $id)
    {
        $subject = Subject::find($id);
        $subject->name = $request->name;
        $subject->faculty_id = $request->faculty_id;
        $subject->save();
    }

    public function remove($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
    }
}