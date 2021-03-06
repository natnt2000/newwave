@extends('layouts.main')

@section('content')
    {{--    {{dd(count($students))}}--}}
    <h1 class="h3 mb-2 text-gray-800">{{ __('messages.student_list') }}</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.student_list') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <div class="mb-5 ml-1">
                    <p class="font-weight-bold">{{ __('messages.filter_by') }}</p>
                    <form action="{{ route('students.index') }}" method="get">
                        <div class="form-row">
                            <div class="col-sm-2 mb-3">
                                <label for="">{{ __('messages.age') }}</label>
                                <input type="text" name="age_min" value="{{request()->age_min}}"
                                       class=" form-control"
                                       placeholder="Age Min">
                            </div>
                            <div class="col-sm-2 mb-3">
                                <label>&nbsp;</label>
                                <input type="text" name="age_max" value="{{request()->age_max}}"
                                       class="form-control float-left"
                                       placeholder="Age Max">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-2 mb-3">
                                <label for="">{{ __('messages.score') }}</label>
                                <input type="text" name="score_min" value="{{request()->score_min}}"
                                       class=" form-control" placeholder="Score Min">
                            </div>
                            <div class="col-sm-2 mb-3">
                                <label>&nbsp;</label>
                                <input type="text" name="score_max" value="{{request()->score_max}}"
                                       class=" form-control" placeholder="Score Max">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-2 mb-3">
                                <label for="">{{ __('messages.phone_number') }}</label>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" name="type_of_phone_number[]"
                                           value={{VIETTEL}} id="viettel"
                                        {{ request()->type_of_phone_number && in_array(VIETTEL, request()->type_of_phone_number) ? "checked" : ""}}>
                                    <label class="form-check-label" for="viettel">
                                        Viettel
                                    </label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" name="type_of_phone_number[]"
                                           value={{MOBIPHONE}} id="mobiphone"
                                        {{ request()->type_of_phone_number && in_array(MOBIPHONE, request()->type_of_phone_number) ? "checked" : ""}}>
                                    <label class="form-check-label" for="mobiphone">
                                        Mobiphone
                                    </label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" name="type_of_phone_number[]"
                                           value={{VINAPHONE}} id="vinaphone"
                                        {{ request()->type_of_phone_number && in_array(VINAPHONE, request()->type_of_phone_number) ? "checked" : ""}}>
                                    <label class="form-check-label" for="vinaphone">
                                        Vinaphone
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-success">{{ __('messages.search') }}</button>
                        </div>
                    </form>
                    <a href="{{ route('students.create') }}"
                       class="btn btn-primary float-right mb-3">{{ __('messages.create') }}</a>
                    <button onclick="send_mail()"
                            class="btn btn-primary float-right mr-3">{{ __('messages.send_mail') }}</button>
                </div>
                <div class="col-6">
                    @include('message')
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('messages.avatar') }}</th>
                        <th>{{ __('messages.fullname') }}</th>
                        <th>{{ __('messages.age') }}</th>
                        <th>{{ __('messages.email') }}</th>
                        <th>{{ __('messages.phone_number') }}</th>
                        <th>{{ __('messages.faculty') }}</th>
                        <th>{{ __('messages.avg_score') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($students) > 0)
                        @foreach ($students as $key => $student)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <img id="main-avatar-{{$student->id}}"
                                         src="{{ asset('storage/images/avatars/'.$student->avatar) }}" width="100"
                                         class="img-thumbnail" alt="">
                                </td>
                                <td id="student-{{$student->id}}-fullname">{{$student->fullname}}</td>
                                <td id="student-{{$student->id}}-age">{{$student->age}}</td>
                                <td id="student-{{$student->id}}-email">{{$student->user->email}}</td>
                                <td id="student-{{$student->id}}-phone_number">{{$student->phone_number}}</td>
                                <td>{{$student->faculty->name}}</td>
                                <td>
                                    @if (count($student->subjects) > 0)
                                        {{ number_format($student->avg_score, 1) }}
                                    @else
                                        0.0
                                    @endif
                                </td>
                                <td id="student-{{$student->id}}-status">
                                    @if ($student->status == 0)
                                        <span class="badge badge-success">{{ __('messages.studying') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('messages.absent') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            {{ __('messages.action') }}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:;" data-student_id={{$student->id}}
                                                data-toggle="modal"
                                               data-target="#updateStudentInfo">{{ __('messages.update_information') }}</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item"
                                               href="{{ route('students.subjectList', $student->id) }}">{{ __('messages.subject_list') }}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center text-danger">
                                <strong>No data</strong>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="float-right">
                    {{ $students->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{asset('js/get_student_infomation_data.js')}}"></script>
        <script src="{{asset('js/update_student_infomation.js')}}"></script>
        <script src="{{ asset('js/send_mail.js') }}"></script>
    @endpush

@endsection
