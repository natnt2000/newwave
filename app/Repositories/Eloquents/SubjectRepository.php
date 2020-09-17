<?php

namespace App\Repositories\Eloquents;

use App\Models\Subject;
use App\Repositories\Contracts\SubjectRepositoryInterface;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    public function getModel()
    {
        return Subject::class;
    }

    public function list()
    {
        return $this->model->paginate(10);
    }

    public function getSubjectsNotLearned($student)
    {
        $subject_id = [];

        foreach ($student->subjects as $key => $subject) {
            $subject_id[$key] = $subject->id;
        }

        $subjectOfFaculty = $this->model->where('faculty_id', '=', $student->faculty_id)->get();
        return $subjectOfFaculty->diff($this->model->whereIn('id', $subject_id)->get());
    }

}
