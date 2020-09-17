<?php
namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function createNewUser($data=[])
    {
        $user = $this->model->create([
            'name' => $data['fullname'],
            'email' => $data['email'],
            'password' => Hash::make('123@newwave')
        ]);
        return $user->id;
    }
}
