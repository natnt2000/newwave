<?php

namespace App\Repositories\Eloquents;

use App\Models\Faculty;
use App\Repositories\Contracts\FacultyRepositoryInterface;
use Illuminate\Support\Str;

class FacultyRepository extends BaseRepository implements FacultyRepositoryInterface
{
    public function getModel()
    {
        return Faculty::class;
    }

    public function create_faculty($data = [])
    {
        $data['slug'] = Str::slug($data['name'], '-') . '-' . uniqid('faculty');
        return $this->create($data);
    }

    public function find_by_slug($slug)
    {
        return Faculty::where('slug', '=', $slug)->firstOrFail();
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

    public function update_faculty($data=[], $id)
    {
        $faculty = $this->find($id);

        if ($data['name'] != $faculty->name) {
            $data['slug'] = Str::slug($data['name'], '-') . '-' . uniqid('faculty');
            $faculty->update($data);
        }
        return $faculty;
    }

}
