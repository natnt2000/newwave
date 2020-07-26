<?php

namespace App\Repositories\Contracts;

interface FacultyRepositoryInterface 
{
    public function all();

    public function create($request);

    public function remove($id);

    public function find($id);

    public function update($request, $id);
}