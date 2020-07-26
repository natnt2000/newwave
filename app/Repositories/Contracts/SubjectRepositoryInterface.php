<?php

namespace App\Repositories\Contracts;

interface SubjectRepositoryInterface 
{
    public function all();

    public function getAllFaculty();

    public function create($request);

    public function find($id);

    public function update($request, $id);
    
    public function remove($id);

}