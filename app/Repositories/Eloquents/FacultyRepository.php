<?php

namespace App\Repositories\Eloquents;

use App\Models\Faculty;
use App\Repositories\Contracts\FacultyRepositoryInterface;

class FacultyRepository implements FacultyRepositoryInterface
{
    public function all()
    {
        return Faculty::all();
    }

    public function find($id)
    {
        return Faculty::find($id);
    }

    public function create($request)
    {
        $faculty = new Faculty;

        $faculty->name = $request->name;

        $faculty->save();
    }

    public function remove($id)
    {
        $faculty = Faculty::find($id);
        $faculty->delete();
    }

    public function update($request, $id)
    {
        $faculty = Faculty::find($id);

        $faculty->name = $request->name;

        $faculty->save();

        return $faculty;
    }
}