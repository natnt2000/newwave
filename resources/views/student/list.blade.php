@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Student List</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <a href="{{ route('students.create') }}" class="btn btn-primary float-right mb-3">Create</a>
            <div class="col-6">
              @include('message')
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>#</th>
                    <th>Avatar</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Avatar</th>
                  <th>Fullname</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($students as $key => $student)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>
                        <img src="{{ asset('storage/images/avatars/'.$student->avatar) }}" width="100" class="img-thumbnail" alt="">
                      </td>
                      <td>{{$student->fullname}}</td>
                      <td>{{$student->user->email}}</td>
                      <td>{{$student->phone_number}}</td>
                      <td>
                        @if ($student->status == 0)
                          <span class="badge badge-success">Studying</span>
                        @else
                          <span class="badge badge-danger">Absent</span>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Update Student Infomation</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Update Score</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Update Subject</a>
                            
                          </div>
                        </div>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
@endsection