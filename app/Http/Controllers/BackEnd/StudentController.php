<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\FilterStudent;
use App\Http\Requests\Student\StoreScore;
use App\Http\Requests\Student\StoreStudent;
use App\Http\Requests\Student\UpdateStudent;
use App\Mail\SendMailExpel;
use App\Repositories\Contracts\FacultyRepositoryInterface;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Repositories\Contracts\StudentSubjectRepositoryInterface;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    protected $studentRepository;
    protected $facultyRepository;
    protected $userRepository;
    protected $subjectRepository;
    protected $studentSubjectRepository;

    public function __construct(StudentRepositoryInterface $studentRepository, FacultyRepositoryInterface $facultyRepository, UserRepositoryInterface $userRepository, SubjectRepositoryInterface $subjectRepository, StudentSubjectRepositoryInterface $studentSubjectRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->facultyRepository = $facultyRepository;
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
        $this->studentSubjectRepository = $studentSubjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = $this->studentRepository->filter($request->all())->with(['user', 'subjects', 'faculty'])->paginate(20);
        return view('students.list', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = $this->facultyRepository->all();
        return view('students.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudent $request)
    {

        $user_id = $this->userRepository->createNewUser($request->all());
        $this->studentRepository->createNewStudent($request->all(), $user_id);
        return redirect()->route('students.index')->with('success', 'Student Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->studentRepository->find($id);
        $email = $student->user->email;
        return response()->json(compact('student', 'email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStudent $request, $id)
    {
        $student = $this->studentRepository->updateStudent($request->all(), $id);
        return response()->json(compact('student'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function subjectList($id)
    {
        $student = $this->studentRepository->find($id);
        $subjectsNotLearned = $this->subjectRepository->getSubjectsNotLearned($student);
        return view('students.subjects_list', compact('student', 'subjectsNotLearned'));
    }

    public function addNewSubject($id)
    {
        $student = $this->studentRepository->find($id);
        $subjectsNotLearned = $this->subjectRepository->getSubjectsNotLearned($student);
        return response()->json(compact('subjectsNotLearned'));
    }

    public function updateScore(StoreScore $request, $id)
    {
        $this->studentSubjectRepository->updateScore($request->all(), $id);
        return redirect()->route('students.subjectList', $id)->with('success', 'Updated Successfully');
    }

    public function removeSubject($student_id, $subject_id)
    {
        $removedSubject = $this->subjectRepository->find($subject_id);
        $this->studentSubjectRepository->removeSubject($student_id, $subject_id);
        $message = "Subject Removed Successfully";
        return response()->json(compact('message', 'removedSubject'));
    }

    public function send_mail()
    {
        $emails = $this->studentRepository->getEmailOfStudentsHaveStudied();
        Mail::to($emails)->send(new SendMailExpel);
        if (Mail::failures()) {
            return response()->json(['errors' => new Error(Mail::failures())]);
        }
        return response()->json(['success' => 'Sent Mail Successfully']);
    }
}
