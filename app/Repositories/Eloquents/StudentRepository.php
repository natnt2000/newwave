<?php

namespace App\Repositories\Eloquents;

use App\Models\Faculty;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Contracts\StudentRepositoryInterface;
use DateTime;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface
{
    public function all()
    {
        return Student::all();
    }

    public function getAllFaculty()
    {
        return Faculty::all();
    }

    public function create($request)
    {
        $user = new User;
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make('123@newwave');
        $user->save();

        $lastUserId = $user->id;

        $student = new Student;
        if($request->hasFile('avatar')){
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('avatar')->extension();
            $filenameFinal = $filename.'-'.time().'.'.$extension;
            $request->file('avatar')->storeAs('public/images/avatars', $filenameFinal);
            $student->avatar = $filenameFinal;
        }
        $student->fullname = $request->fullname;
        $student->gender = $request->gender;
        $student->birthday = date_format(new DateTime($request->birthday), "Y-m-d");
        $student->address = $request->address;
        $student->phone_number = $request->phone_number;
        $student->faculty_id = $request->faculty_id;
        $student->user_id = $lastUserId;
        $student->save();
    }
}