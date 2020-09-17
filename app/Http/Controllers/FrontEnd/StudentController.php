<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\UpdateProfile;
use App\Http\Requests\StudentSubject\StoreSubject;
use App\Http\Requests\User\ChangePassword;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Repositories\Contracts\StudentSubjectRepositoryInterface;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    protected $studentRepository;
    protected $userRepository;
    protected $subjectRepository;
    protected $studentSubjectRepository;

    public function __construct(StudentRepositoryInterface $studentRepository, UserRepositoryInterface $userRepository, SubjectRepositoryInterface $subjectRepository, StudentSubjectRepositoryInterface $studentSubjectRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
        $this->studentSubjectRepository = $studentSubjectRepository;
    }

    public function profile()
    {
        $student = auth()->user()->student;
        return view('students.profile', compact('student'));
    }

    public function update_profile(UpdateProfile $request)
    {
        $updateUser = ['name' => $request->fullname, 'email' => $request->email];
        $this->userRepository->updateUser($updateUser, auth()->user()->id);
        $student = $this->studentRepository->updateStudent($request->all(), auth()->user()->student->id);
        return response()->json(compact('student'));
    }

    public function change_password()
    {
        return view('students.change_password');
    }

    public function save_new_password(ChangePassword $request)
    {
        $this->userRepository->updateUser(['password' => Hash::make($request->password)], auth()->user()->id);
        return response()->json();
    }

    public function getSubjectsNotLearned()
    {
        $subjectsNotLearned = $this->subjectRepository->getSubjectsNotLearned(auth()->user()->student);
        return response()->json(compact('subjectsNotLearned'));
    }

    public function subject_list()
    {
        $student = auth()->user()->student;
        return view('students.fe_subject_list', compact('student'));
    }

    public function storeNewSubjects(StoreSubject $request)
    {
        $this->studentSubjectRepository->storeNewSubjects($request->all(), auth()->user()->student->id);
        return redirect()->route('student.subject_list')->with('success', 'Updated Successfully');
    }

    public function lang($locale)
    {
        App::setlocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
