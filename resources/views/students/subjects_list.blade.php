@extends('layouts.main')

@section('content')
{{--        {{dd(old())}}--}}
    <h1 class="h3 mb-2 text-gray-800">Subject List</h1>
    <h2 class="h3 mb-2 text-gray-800">Fullname: <span style="color: #000">{{$student->fullname}}</span></h2>
    <h2 class="h3 mb-2 text-gray-800">Faculty: <span style="color: #000">{{$student->faculty->name}}</span></h2>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Subjects being study </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="javascript:;" class="btn btn-primary float-right mb-3" id="handleClickAddSubject"
                   data-removed="">
                    Add new subject
                </a>
                <div class="col-6" id="mess-updated-success">
                    @include('message')
                </div>
                <form action="{{ route('students.updateScore', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="table table-bordered" id="subjectTableList" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Score</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="subject_list_tbody" subject-length={{count($student->subjects)}}
                            student-id={{$student->id}}>

                        @if (count($student->subjects) > 0)
                            @foreach ($student->subjects as $key => $subject)
                                <tr id="subject-{{$subject->id}}-tr" name="tr-subject-table">
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$subject->name}}
                                        <input type="hidden" name="subject_id[]" value={{$subject->id}}>
                                    </td>
                                    <td>
                                        <input type="text" name="score[]"
                                               value="{{old('score.'.$key, $subject->pivot->score)}}"
                                               class="form-control col-4 @error('score.'.$key) is-invalid @enderror">
                                        @error('score.'.$key)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" type="button" href="javascript:;"
                                           onclick="removeSubjectOfStudent({{$student->id}}, {{$subject->id}})">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        @if(old('subject_id') && count(old('subject_id')) > count($student->subjects))
                            @for($index = count($student->subjects); $index < count(old('subject_id')); $index++)
                                <tr id="tr-addSubject-{{$index+1}}" name="tr-subject-table">
                                    <td>{{$index+1}}</td>
                                    <td>
                                        <select class="form-control @error('subject_id.'.$index) is-invalid @enderror" name="subject_id[]" id="select-{{$index+1}}"
                                                style="width: 300px">
                                            <option value="">Choose subject</option>
                                            @foreach($subjectsNotLearned as $key => $subjectNotLearned)
                                                <option {{ old('subject_id')[$index] == $subjectNotLearned->id ? "selected" : "" }} value={{$subjectNotLearned->id}}>{{$subjectNotLearned->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('subject_id.'.($index))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="score[]" class="form-control col-4 @error('score.'.$index) is-invalid @enderror" value="{{old('score')[$index]}}">
                                        @error('score.'.$index)
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-secondary" onclick="removeBeforeAddSubject({{$index+1}})">Remove</a>
                                    </td>
                                </tr>
                            @endfor
                        @endif
                        </tbody>
                        <tr>
                            <td colspan="3"></td>
                            <td>
                                <button class="btn btn-success">Update</button>
                            </td>
                        </tr>
                    </table>
{{--                    {{dd($errors)}}--}}
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{asset('js/handle_subjects_not_learned.js')}}"></script>
        <script src="{{asset('js/remove_subject_of_student.js')}}"></script>
    @endpush
@endsection
