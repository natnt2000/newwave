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


}
