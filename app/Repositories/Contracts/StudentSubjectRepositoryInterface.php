<?php

namespace App\Repositories\Contracts;

interface StudentSubjectRepositoryInterface
{
    public function removeSubject($student_id, $subject_id);

    public function updateScore($data=[], $student_id);

    public function storeNewSubjects($data = [], $student_id);
}
