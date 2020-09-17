<?php

namespace App\Repositories\Eloquents;

use App\Helper\Helper;
use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;
use DateTime;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function getModel()
    {
        return Student::class;
    }

    public function createNewStudent($data = [], $user_id)
    {
        $data['user_id'] = $user_id;
        $data['birthday'] = date_format(new DateTime($data['birthday']), "Y-m-d");

        if ($data['avatar']) {
            $data['avatar'] = Helper::uploadImagesToStorage($data['avatar'], "images/avatars");
        }

        return $this->create($data);
    }

    public function updateStudent($data = [], $id)
    {
        $student = $this->find($id);
        $data['birthday'] = date_format(new DateTime($data['birthday']), "Y-m-d");

        $student->user->update([
            'name' => $data['fullname'],
            'email' => $data['email']
        ]);

        if (isset($data['avatar'])) {
            $data['avatar'] = Helper::uploadImagesToStorage($data['avatar'], 'images/avatars', true, $student->avatar);
        }

        $student->update($data);
        return $student;
    }

    public function updateScore($data = [], $id)
    {
        $student = $this->find($id);

        $scores = $data['score'];
        $subject_ids = $data['subject_id'];
        $subjects = [];

        foreach ($scores as $key => $score) {
            $subjects[] = [
                "subject_id" => $subject_ids[$key],
                "score" => $scores[$key],
            ];
        }

        $student->subjects()->sync($subjects);
    }

    public function filter($data = [])
    {
        $students = $this->model->newQuery();

        if (isset($data['age_min'])) {
            $students->whereRaw('TIMESTAMPDIFF(YEAR, DATE(birthday), current_date) >= ?', [$data['age_min']]);
        }

        if (isset($data['age_max'])) {
            $students->whereRaw('TIMESTAMPDIFF(YEAR, DATE(birthday), current_date) <= ?', [$data['age_max']]);
        }

        if (isset($data['score_min'])) {
            $students->whereHas('subjects', function ($query) use ($data) {
                $query->selectRaw('AVG(student_subject.score)')
                    ->groupBy('student_subject.student_id')
                    ->havingRaw('AVG(student_subject.score) >= ?', [$data['score_min']]);
            });
        }

        if (isset($data['score_max'])) {
            $students->whereHas('subjects', function ($query) use ($data) {
                $query->selectRaw('AVG(student_subject.score)')
                    ->groupBy('student_subject.student_id')
                    ->havingRaw('AVG(student_subject.score) <= ?', [$data['score_max']]);
            });
        }

        if (isset($data['type_of_phone_number'])) {
            $students->where(function ($query) use ($data) {
                if (in_array(VIETTEL, $data['type_of_phone_number'])) {
                    $query->orWhere('phone_number', 'REGEXP', '^(03|09)[0-9]{8}$');
                }
                if (in_array(MOBIPHONE, $data['type_of_phone_number'])) {
                    $query->orWhere('phone_number', 'REGEXP', '^07[0-9]{8}$');
                }
                if (in_array(VINAPHONE, $data['type_of_phone_number'])) {
                    $query->orWhere('phone_number', 'REGEXP', '^08[0-9]{8}$');
                }
            });
        }

        return $students;
    }

    public function getEmailOfStudentsHaveStudied()
    {
        $students = Student::all();
        $emails = [];

        foreach (Student::all() as $key => $student) {
            if (count($student->subjects) > 0) {
                $emails[$key] = $student->user->email;
            }
        }
        return $emails;
    }
}
