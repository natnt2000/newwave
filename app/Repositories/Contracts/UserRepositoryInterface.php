<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function createNewUser($data=[]);
}
