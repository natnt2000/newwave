@extends('layouts.main')

@section('content')

    <h1 class="h3 mb-2 text-gray-800">Subject List</h1>
    <h2 class="h3 mb-2 text-gray-800">Fullname: <span style="color: #000">{{$student->fullname}}</span></h2>
    <h2 class="h3 mb-2 text-gray-800">Faculty: <span style="color: #000">{{$student->faculty->name}}</span></h2>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Subjects being study </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="javascript:;" class="btn btn-primary float-right mb-3" id="handleClickAddSubject">
                    Add new subject
                </a>
                <div class="col-6" id="mess-updated-success">
                    @include('message')
                </div>
                <form action="{{ route('student.storeNewSubjects') }}" method="POST">
                    @csrf
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Score</th>
                        </tr>
                        </thead>
                        <tbody id="subject_list_tbody"
                               subject-length={{count($student->subjects)}}>
                        @if (count($student->subjects) > 0)
                            @foreach ($student->subjects as $key => $subject)
                                <tr id="subject-{{$subject->id}}-tr">
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$subject->name}}
                                    </td>
                                    <td>
                                        {{$subject->pivot->score}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tr>
                            <td colspan="2" class="border-right-0"></td>
                            <td class="border-left-0">
                                <button class="btn btn-success">Update</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('js/handle_subjects_not_learned_in_student_desk.js')}}"></script>
    @endpush
@endsection
