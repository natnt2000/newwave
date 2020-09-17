<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faculty\StoreFaculty;
use App\Models\Faculty;
use App\Repositories\Contracts\FacultyRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Resources\Faculty as FacultyResource;

class FacultyController extends Controller
{
    protected $facultyRepository;

    public function __construct(FacultyRepositoryInterface $facultyRepository)
    {
        $this->facultyRepository = $facultyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = $this->facultyRepository->all();

        return view('faculties.list', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaculty $request)
    {
//        dd($request->all());
        $this->facultyRepository->create($request->all());
//
//        return redirect()->route('faculties.index')->with('success', 'Faculty Created Successfully');
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
        $faculty = $this->facultyRepository->find($id);

        return view('faculties.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFaculty $request, $id)
    {
        $faculty = $this->facultyRepository->update($request->all(), $id);
        return redirect()->route('faculties.index')->with('success', 'Faculty Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->facultyRepository->delete($id);

        return redirect()->route('faculties.index')->with('success', 'Faculty Deleted Successfully');
    }

    public function list()
    {
        $faculties = $this->facultyRepository->all();
        return FacultyResource::collection($faculties);
    }

    public function find($id)
    {
        $faculty = $this->facultyRepository->find($id);
        return new FacultyResource($faculty);
    }
}
