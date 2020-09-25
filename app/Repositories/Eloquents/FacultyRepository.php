<?php

namespace App\Repositories\Eloquents;

use App\Models\Faculty;
use App\Repositories\Contracts\FacultyRepositoryInterface;

class FacultyRepository extends BaseRepository implements FacultyRepositoryInterface
{
    public function getModel()
    {
        return Faculty::class;
    }

    public function remove($id)
    {
        $faculty = $this->find($id);

        foreach ($faculty->students as $key => $student) {
            $student->subjects()->detach();
        }

        $faculty->students()->delete();
        $faculty->subjects()->delete();
        $faculty->delete();
    }

}
