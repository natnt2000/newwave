<?php

namespace App\Repositories\Contracts;

interface StudentRepositoryInterface
{
    public function all();

    public function getAllFaculty();

    public function create($request);
}