<?php

namespace App\Repositories\Contracts;

interface FacultyRepositoryInterface
{
    public function remove($id);

    public function create_faculty($data = []);

    public function find_by_slug($slug);

    public function update_faculty($data=[], $id);

}
