<?php

namespace App\Repositories\Contracts;

interface SubjectRepositoryInterface 
{

    public function list();

    public function getSubjectsNotLearned($student);

}