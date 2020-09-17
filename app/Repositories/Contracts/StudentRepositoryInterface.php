<?php

namespace App\Repositories\Contracts;

interface StudentRepositoryInterface
{
    public function createNewStudent($data = [], $user_id);

    public function updateStudent($data = [], $id);

    public function filter($data = []);

    public function updateScore($data = [], $id);

    public function getEmailOfStudentsHaveStudied();
}
