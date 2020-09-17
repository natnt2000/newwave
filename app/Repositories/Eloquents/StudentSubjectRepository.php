<?php

namespace App\Repositories\Eloquents;

use App\Models\StudentSubject;
use App\Repositories\Contracts\StudentSubjectRepositoryInterface;

class StudentSubjectRepository extends BaseRepository implements StudentSubjectRepositoryInterface
{
    public function getModel()
    {
        return StudentSubject::class;
    }

    public function removeSubject($student_id, $subject_id)
    {
        $this->model->where([
            ['student_id', '=', $student_id],
            ['subject_id', '=', $subject_id]
        ])->delete();
    }

    public function updateScore($data = [], $student_id)
    {
        $score = $data['score'];
        $subject_id = $data['subject_id'];
        for ($i = 0; $i < count($score); $i++) {
            if ($score[$i] != "" && $subject_id [$i] != "") {
                $this->model->updateOrCreate([
                    "student_id" => $student_id,
                    "subject_id" => $subject_id[$i]
                ],
                    [
                        "score" => $score[$i]
                    ]
                );
            }
        }
    }
    public function storeNewSubjects($data = [], $student_id)
    {
        $subject_id  = $data['subject_id'];
        if (count($subject_id) > 0) {
            for ($i = 0; $i < count($subject_id); $i++) {
                $this->create([
                    'student_id' => $student_id,
                    'subject_id' => $subject_id[$i]
                ]);
            }
        }
    }
}
